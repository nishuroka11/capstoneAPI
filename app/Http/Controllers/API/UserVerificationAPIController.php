<?php

namespace App\Http\Controllers\API;

use App\Helpers\MiddlewareHelper;
use App\Http\Controllers\APIController;
use App\Modules\Users\Repositories\SocialLoginRepository;
use App\Modules\Users\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserVerificationAPIController extends APIController
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var SocialLoginRepository
     */
    private $socialLoginRepository;

    /**
     * UserVerificationAPIController constructor.
     * @param UserRepository $userRepository
     * @param SocialLoginRepository $socialLoginRepository
     */
    public function __construct(
        UserRepository $userRepository,
        SocialLoginRepository $socialLoginRepository
    )
    {
        $this->middleware([MiddlewareHelper::NAME_FOR_LOGGED_IN_USER, MiddlewareHelper::NAME_FOR_NON_VERIFIED_USER])->only(['getEmailVerificationCode', 'postEmailVerificationCode']);
        $this->middleware(['throttle:5,1'])->only(['postEmailVerificationCode']);

        $this->userRepository = $userRepository;

        $this->socialLoginRepository = $socialLoginRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */


    public function getEmailVerificationCode()
    {
        $user = auth('api')->user();

        return jsonresWithToken($user);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postEmailVerificationCode(Request $request)
    {
        $rules = [
            'email_verification_code' => 'required|exists:users,email_verification_code',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return jsonresValidation($validator->messages());
        }

        $user = auth()->user();

        if (!$user->isEmptyVerified()) {
            return jsonresValidation(['email' => 'Email has already been verified']);
        }

        try {
            DB::beginTransaction();

            $isValid = $user->isEmailVerificationCodeCorrect($request->email_verification_code);

            if (!$isValid) {
                return jsonresValidation(['email_verification_code' => 'Email verification code has expired. Please create new']);
            }

            $user = $this->userRepository->verifyEmailVerificationCode($user);

            DB::commit();

            return jsonresWithToken($user);
        } catch (\Exception $exception) {
            DB::rollback();

            if (app()->env == 'local') {
                dd($exception);
            } else {
                Log::error('UserVerificationAPI postEmailVerificationCode ' . $exception->getMessage() . ' Trace : ' . $exception->getTraceAsString());

                return jsonresServerError();
            }
        }
    }
}
