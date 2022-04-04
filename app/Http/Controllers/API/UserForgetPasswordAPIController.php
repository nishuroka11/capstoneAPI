<?php

namespace App\Http\Controllers\API;

use App\Helpers\MiddlewareHelper;
use App\Http\Controllers\APIController;
use App\Modules\Roles\Repositories\RoleRepository;
use App\Modules\Users\Repositories\UserRepository;
use App\Modules\Users\Rules\VerifiedEmailAddressRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class UserForgetPasswordAPIController extends APIController
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
        $this->middleware([MiddlewareHelper::NAME_FOR_LOGGED_IN_USER])->only(['me', 'addEmailAddress', 'editProfile', 'logout', 'addPassword']);
        $this->middleware([MiddlewareHelper::NAME_FOR_VERIFIED_USER])->only(['me', 'editProfile', 'addPassword']);
        $this->middleware([MiddlewareHelper::NAME_FOR_NON_VERIFIED_USER])->only(['addEmailAddress']);
        $this->middleware(['throttle:5,1'])->only('login');
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public function postForgetPassword(Request $request)
    {
        $rules = [
            'email' => ["required",new VerifiedEmailAddressRule()]
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return jsonresValidation($validator->messages());
        }
        try {
            $user = auth('api')->user();
            $linkSent = Password::sendResetLink([
                'email' => $request->email
            ]);

            if (!$linkSent) {
                return jsonresServerError();
            }

            return jsonresSuccess();
        } catch (\Exception $exception) {

            if (app()->env == 'local') {
                dd($exception);
            } else {
                Log::error('UserForgetPasswordAPI postForgetPassword ' . $exception->getMessage() . ' Trace : ' . $exception->getTraceAsString());

                return jsonresServerError();
            }
        }
    }
}

