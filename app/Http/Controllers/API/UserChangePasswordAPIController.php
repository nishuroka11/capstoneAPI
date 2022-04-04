<?php

namespace App\Http\Controllers\API;

use App\Helpers\MiddlewareHelper;
use App\Http\Controllers\APIController;
use App\Modules\Roles\Repositories\RoleRepository;
use App\Modules\Users\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserChangePasswordAPIController extends APIController
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
        UserRepository $userRepository
    )
    {
        $this->middleware([MiddlewareHelper::NAME_FOR_LOGGED_IN_USER])->only(['changePassword']);
        $this->middleware([MiddlewareHelper::NAME_FOR_VERIFIED_USER])->only(['changePassword']);
        $this->middleware(['throttle:5,1'])->only('changePassword');
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(Request $request)
    {
        $rules = [
            'old_password' => 'required|min:2',
            'new_password' => 'required|min:6|different:old_password',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return jsonresValidation($validator->messages());
        }

        try {
            DB::beginTransaction();

            if(!Hash::check($request->old_password, auth('api')->user()->password)){
                return jsonresValidation([
                    'old_password' => 'Old password does not match with current password'
                ]);
            }

            $user = $this->userRepository->update([
                'password' => bcrypt($request->new_password)
            ], auth('api')->id());

            DB::commit();

            return jsonresWithToken($user, 'Password changed successfully!');
        } catch (\Exception $exception) {
            DB::rollback();

            if (app()->env == 'local') {
                dd($exception);
            } else {
                Log::error('UserAPI changePassword ' . $exception->getMessage() . ' Trace : ' . $exception->getTraceAsString());

                return jsonresServerError();
            }
        }
    }
}

