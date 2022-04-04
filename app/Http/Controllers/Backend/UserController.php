<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\BackendController;
use App\Models\User;
use App\Modules\Users\Requests\UserCreateRequest;
use App\Modules\Roles\Repositories\RoleRepository;
use App\Modules\Users\Repositories\UserRepository;
use App\Modules\Users\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends BackendController
{
    protected $additionalViewPrefix = "users";

    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     * @param RoleRepository $roleRepository
     */
    public function __construct(
        UserRepository $userRepository,
        RoleRepository $roleRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public function index(Request $request)
    {
        $this->authorize('read', $this->userRepository->getModel());

        $users = $this->userRepository->getQueryWithoutSuperAdmin()->with('roles');

        $roles = $this->roleRepository->getAll()->pluck('name', 'id');

        $filterData = [
            'name_like' => $request->name,
            'email_like' => $request->email,
            'role_id' => $request->role_id
        ];

        $users = $this->userRepository->filterQuery($users, $filterData);

        $userCount = $users->count();

        $users = $users->paginate(config('constants.records_per_page'));

        return $this->view('index', [
            'users' => $users,
            'userCount' => $userCount,
            'title' => 'User Listing',
            'roles' => $roles
        ]);
    }

    public function create()
    {
        $this->authorize('create', $this->userRepository->getModel());

        $roles = $this->roleRepository->getAll()->pluck('name', 'id');

        return $this->view('create', [
            'title' => 'Create User',
            'isEdit' => false,
            'roles' => $roles,
            'selectedRoleId' => null
        ]);
    }

    public function store(UserCreateRequest $request)
    {
        $this->authorize('create', $this->userRepository->getModel());

        try {
            DB::beginTransaction();
            $formData = sanitize($request->all());

            $formData['password'] = bcrypt(extractFromArray($formData, 'password'));

            $user = $this->userRepository->create($formData);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();


            if (app()->env == 'local') {
                dd($exception);
            } else {
                Log::error('User store ' . $exception->getMessage() . ' Trace : ' . $exception->getTraceAsString());

                return redirect()->back()->withErrors(ResponseHelper::STATUS_MESSAGE_FOR_INTERNAL_SERVER_ERROR);
            }
        }

        return redirect()->route('backend.users.edit', $user)->with('success', 'User Created Successfully!');
    }


    public function show(User $user)
    {
        $this->authorize('read', $this->userRepository->getModel());

        if(!isAuthenticatedSuperAdmin() && $user->isSuperAdministrator()){
            abort(404);
        }

        return $this->view('show', [
            'title' => "Show User",
            'user' => $user,
        ]);
    }

    public function edit(User $user)
    {
        $this->authorize('update', $this->userRepository->getModel());

        $roles = $this->roleRepository->getAll()->pluck('name', 'id');

        if (empty($user)) {
            abort(404);
        }

        if(!isAuthenticatedSuperAdmin() && $user->isSuperAdministrator()){
            abort(404);
        }

        $selectedRoleId = $user->roles()->first()->id ?? null;

        return $this->view('edit', [
            'title' => 'Update User',
            'user' => $user,
            'isEdit' => true,
            'roles' => $roles,
            'selectedRoleId' => $selectedRoleId
        ]);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $this->authorize('update', $this->userRepository->getModel());

        if (empty($user)) {
            abort(404);
        }

        if(!isAuthenticatedSuperAdmin() && $user->isSuperAdministrator()){
            abort(404);
        }

        $id = $user->user_id;

        try {
            DB::beginTransaction();

            $formData = sanitize($request->all());

            if(canUpdatePassword($id) && !empty(request()->password)){
                $formData['password'] = bcrypt(request()->password);
            }else{
                unset($formData['password']);
            }

            $user = $this->userRepository->update($formData, $user->user_id);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();


            if (app()->env == 'local') {
                dd($exception);
            } else {
                Log::error('User update ' . $exception->getMessage() . ' Trace : ' . $exception->getTraceAsString());

                return redirect()->back()->withErrors(ResponseHelper::STATUS_MESSAGE_FOR_INTERNAL_SERVER_ERROR);
            }
        }

        return redirect()->route('backend.users.edit', $user)->with('success', 'User Updated Successfully!');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $this->userRepository->getModel());

        if(!isAuthenticatedSuperAdmin() && $user->isSuperAdministrator()){
            abort(404);
        }

        try {
            DB::beginTransaction();

            if($user->isSuperAdministrator()){
                return jsonresNotFound();
            }

            $this->userRepository->delete($user->user_id);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();


            if (app()->env == 'local') {
                dd($exception);
            } else {
                Log::error('User destroy ' . $exception->getMessage() . ' Trace : ' . $exception->getTraceAsString());

                return jsonresServerError();
            }
        }

        return jsonresSuccess();
    }

}
