<?php

namespace App\Http\Controllers\API;

use App\Helpers\MiddlewareHelper;
use App\Http\Controllers\APIController;
use App\Models\User;
use App\Modules\Roles\Repositories\RoleRepository;
use App\Modules\Users\Repositories\UserRepository;
use App\Modules\Users\Resources\UserResource;
use App\Modules\Users\Rules\NonVerifiedEmailAddressRule;
use App\Modules\Users\Rules\VerifiedEmailAddressRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserAPIController extends APIController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var RoleRepository
     */
    private $roleRepository;

    public function __construct(
        UserRepository $userRepository,
        RoleRepository $roleRepository
    )
    {
        $this->middleware([MiddlewareHelper::NAME_FOR_LOGGED_IN_USER])->only(['me', 'addEmailAddress', 'editProfile', 'logout']);
        $this->middleware([MiddlewareHelper::NAME_FOR_VERIFIED_USER])->only(['me', 'editProfile']);
        $this->middleware([MiddlewareHelper::NAME_FOR_NON_VERIFIED_USER])->only(['addEmailAddress']);
        $this->middleware(['throttle:5,1'])->only('login');
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public function store(Request $request)
    {
        $rules = [
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email' => ['required', new NonVerifiedEmailAddressRule],
            'password' => ['required', 'min:6'],
            'user_type_id' => ['required', Rule::in([User::USER_TYPE_FOR_OWNER, User::USER_TYPE_FOR_WALKER])],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return jsonresValidation($validator->messages());
        }

        try {
            DB::beginTransaction();

            $this->userRepository->emptyNonVerifiedEmail($request->email);

            $request->request->add(['roles' => $this->roleRepository->getNormalUserRole()->id]);

            $user = $this->userRepository->create($request->all());

            $user = $this->userRepository->changePassword($request->password, $user->user_id);

            DB::commit();

            return jsonresWithToken($user);
        } catch (\Exception $exception) {
            DB::rollback();

            if (app()->env == 'local') {
                dd($exception);
            } else {
                Log::error('UserAPI store ' . $exception->getMessage() . ' Trace : ' . $exception->getTraceAsString());

                return jsonresServerError();
            }
        }
    }

    /**
     * @param Request $request
     */
    public function login(Request $request)
    {
        $rules = [
            'email' => ['required', new VerifiedEmailAddressRule],
            'password' => 'required|min:6'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return jsonresValidation($validator->messages());
        }

        $user = $this->userRepository->findBy('email', $request->email);

        $isAuthenticate = auth('api')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if (!$isAuthenticate) {
            return jsonresValidation([
                'user' => ['Invalid credentials']
            ]);
        }

        return jsonresWithToken($user);
    }

    public function addEmailAddress(Request $request)
    {
        $rules = [
            'email' => ['required', new NonVerifiedEmailAddressRule]
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return jsonresValidation($validator->messages());
        }

        try {
            $user = auth('api')->user();

            DB::beginTransaction();

            $this->userRepository->emptyNonVerifiedEmail($request->email);


            $user = $this->userRepository->update([
                'email' => $request->email
            ], $user->user_id);

            DB::commit();

            return jsonresWithToken($user);
        } catch (\Exception $exception) {
            DB::rollback();

            if (app()->env == 'local') {
                dd($exception);
            } else {
                Log::error('UserAPI addEmailAddress ' . $exception->getMessage() . ' Trace : ' . $exception->getTraceAsString());

                return jsonresServerError();
            }
        }
    }

    public function me()
    {
        try {
            DB::beginTransaction();

            $user = User::find(auth('api')->id());

            $data = new UserResource($user, 'detail');

            DB::commit();

            return jsonresSuccess($data);
        } catch (\Exception $exception) {
            DB::rollback();

            if (app()->env == 'local') {
                dd($exception);
            } else {
                Log::error('UserAPI me ' . $exception->getMessage() . ' Trace : ' . $exception->getTraceAsString());

                return jsonresServerError();
            }
        }
    }

    public function editProfile(Request $request)
    {
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'encoded_image_url' => 'nullable',
            'years_of_experience' => 'required|numeric|gt:0',
            'is_available' => 'required|boolean',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return jsonresValidation($validator->messages());
        }

        try {
            DB::beginTransaction();

            $user = $this->userRepository->updateProfile($request->all(), auth('api')->user());

            DB::commit();

            return jsonresSuccess([
                'user' => new UserResource($user)
            ]);
        } catch (\Exception $exception) {
            DB::rollback();

            if (app()->env == 'local') {
                dd($exception);
            } else {
                Log::error('UserAPI editProfile ' . $exception->getMessage() . ' Trace : ' . $exception->getTraceAsString());

                return jsonresServerError();
            }
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            auth('api')->logout();

            return jsonresSuccess();
        } catch (\Exception $exception) {
            if (app()->env == 'local') {
                dd($exception);
            } else {
                Log::error('UserAPI logout ' . $exception->getMessage() . ' Trace : ' . $exception->getTraceAsString());

                return jsonresServerError();
            }
        }
    }
}

