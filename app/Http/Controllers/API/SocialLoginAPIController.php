<?php

namespace App\Http\Controllers\API;

use App\Helpers\DeviceHelper;
use App\Helpers\SocialMediaHelper;
use App\Http\Controllers\APIController;
use App\Modules\Roles\Repositories\RoleRepository;
use App\Modules\Users\Repositories\SocialLoginRepository;
use App\Modules\Users\Repositories\UserRepository;
use Illuminate\Http\Request;
use Google_Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginAPIController extends APIController
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var RoleRepository
     */
    private $roleRepository;
    /**
     * @var SocialLoginRepository
     */
    private $socialLoginRepository;

    public function __construct(
        UserRepository $userRepository,
        RoleRepository $roleRepository,
        SocialLoginRepository $socialLoginRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->socialLoginRepository = $socialLoginRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function google(Request $request)
    {
        $rules = [
            'access_token' => 'required',
            'device' => 'nullable',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return jsonresValidation($validator->messages());
        }

        try {
            DB::beginTransaction();

            if($request->device == 'ios'){
                $settingClientId = config('services.google.client_id_for_ios');
                $googleClient = new Google_Client(['client_id' => config('services.google.client_id_for_ios')]);  // Specify the CLIENT_ID of the app that accesses the backend
            }else{
                $settingClientId = config('services.google.client_id_for_android');
                $googleClient = new Google_Client(['client_id' => config('services.google.client_id_for_android')]);  // Specify the CLIENT_ID of the app that accesses the backend
            }
            $payload = $googleClient->verifyIdToken(request()->access_token);
            if (empty($payload)) {
                return jsonresValidation(['token' => ['Token is invalid']]);
            }

            if ($settingClientId != $payload['aud']) {
                return jsonresValidation(['token' => ['Token is invalid']]);
            }

            $data = [
                'social_id' => $payload['sub'],
                'name' => $payload['name'],
                'email' => $payload['email'],
                'image_url' => $payload['picture'],
                'social_media_id' => SocialMediaHelper::GOOGLE_ID,
                'device_id' => DeviceHelper::DEFAULT_DEVICE_ID
            ];

            $user = $this->socialLoginUser($data);

            DB::commit();

            return jsonresWithToken($user);
        } catch (\Exception $exception) {
            DB::rollback();

            if (app()->env == 'local') {
                dd($exception);
            } else {
                Log::error('SocialLoginAPI google ' . $exception->getMessage() . ' Trace : ' . $exception->getTraceAsString());

                return jsonresServerError();
            }
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function facebook(Request $request)
    {
        $rules = [
            'access_token' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return jsonresValidation($validator->messages());
        }

        try {
            DB::beginTransaction();
            $socialite = Socialite::driver('facebook')->userFromToken(request()->access_token);

            if (empty($socialite)) {
                return jsonresValidation([
                    'token' => ['Token Invalid']
                ]);
            }

            $data = [
                'social_id' => $socialite->getId(),
                'name' => $socialite->getName(),
                'email' => $socialite->getEmail(),
                'image_url' => $socialite->getAvatar(),
                'social_media_id' => SocialMediaHelper::FACEBOOK_ID,
                'device_id' => DeviceHelper::DEFAULT_DEVICE_ID
            ];

            $user = $this->socialLoginUser($data);

            DB::commit();

            return jsonresWithToken($user);
        } catch (\Exception $exception) {
            DB::rollback();
            if (app()->env == 'local') {
                dd($exception);
            } else {
                Log::error('SocialLoginAPI facebook ' . $exception->getMessage() . ' Trace : ' . $exception->getTraceAsString());

                return jsonresServerError([]);
            }
        }
    }

    /**
     * @param $data
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    private function socialLoginUser($data)
    {
        $previousSocialMedia = $this->socialLoginRepository->findByUniqueSocialId($data['social_id'], $data['social_media_id']);

        if (!empty($previousSocialMedia)) {
            $userHavingSocialId = $this->userRepository->find($previousSocialMedia->fk_user_id);

            if (!empty($userHavingSocialId)) {
                $data['fk_user_id'] = $userHavingSocialId->user_id;
                $this->socialLoginRepository->create($data);
                return $userHavingSocialId;
            }
        }

        $userWithPreviousEmail = $this->userRepository->findBy('email', $data['email']);

        if (!empty($userWithPreviousEmail)) {
            $data['fk_user_id'] = $userWithPreviousEmail->user_id;
            $this->socialLoginRepository->create($data);

            return $userWithPreviousEmail;
        }

        if (!empty($data['email'])) {
            $data['email_verified_at'] = now()->toDateTimeString();
        }

        $data['created_social_media_id'] = $data['social_media_id'];

        $data['roles'] = $this->roleRepository->getNormalUserRole()->user_id;

        $user = $this->userRepository->create($data);
        $uploadedImageUrl = uploadImageInSystem(Image::make($data['image_url']), getImageFileName('users'));
        $user = $this->userRepository->saveImageUrl($uploadedImageUrl, $user);

        $data['fk_user_id'] = $user->user_id;

        $this->socialLoginRepository->create($data);

        return $user;
    }
}

