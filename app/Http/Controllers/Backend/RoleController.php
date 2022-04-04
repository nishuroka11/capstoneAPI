<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\BackendController;
use App\Models\Role;
use App\Modules\Permissions\Repositories\PermissionRepository;
use App\Modules\Roles\Repositories\RoleRepository;
use App\Modules\Roles\Requests\RoleCreateRequest;
use App\Modules\Roles\Requests\RoleUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleController extends BackendController
{
    protected $additionalViewPrefix = "roles";

    /**
     * @var RoleRepository
     */
    private $roleRepository;
    /**
     * @var PermissionRepository
     */
    private $permissionRepository;

    /**
     * RoleController constructor.
     * @param RoleRepository $roleRepository
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(
        RoleRepository $roleRepository,
        PermissionRepository $permissionRepository
    )
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function index(Request $request)
    {
        $this->authorize('read', $this->roleRepository->getModel());
        $roles = $this->roleRepository->getQuery();


        $roles = $this->roleRepository->filterQuery($roles, [
            'name_like' => $request->name,
        ]);

        $roleCount = $roles->count();

        $roles = $roles->paginate(config('constants.records_per_page'));

        return $this->view('index', [
            'roles' => $roles,
            'roleCount' => $roleCount,
            'title' => 'Role Listing',
        ]);
    }

    public function create()
    {
        $this->authorize('create', $this->roleRepository->getModel());
        $permissions = $this->permissionRepository->getCrudLists();

        return $this->view('create', [
            'title' => 'Create Role',
            'permissions' => $permissions,
            'isEdit' => false,
            'previousPermissionIds' => []
        ]);
    }

    public function store(RoleCreateRequest $request)
    {
        $this->authorize('create', $this->roleRepository->getModel());
        try {
            DB::beginTransaction();
            $formData = sanitize($request->all());

            $role = $this->roleRepository->create($formData);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();

            if (app()->env == 'local') {
                dd($exception);
            } else {
                Log::error('Role store: ' . $exception->getMessage() . ' Trace : ' . $exception->getTraceAsString());
            }
        }

        return redirect()->route('backend.roles.index')->with('success', 'Role Created Successfully!');
    }

    public function show(Role $role)
    {
        $this->authorize('read', $this->roleRepository->getModel());

        return $this->view('show', [
            'title' => "Show Role",
            'role' => $role,
        ]);
    }

    public function edit(Role $role)
    {
        $this->authorize('update', $this->roleRepository->getModel());

        $permissions = $this->permissionRepository->getCrudLists();
        $permissionArray = $role->permissions->pluck('id')->toArray();

        return $this->view('edit', [
            'title' => 'Update Role',
            'role' => $role,
            'permissions' => $permissions,
            'isEdit' => true,
            'permissionArray' => $permissionArray,
        ]);
    }

    public function update(RoleUpdateRequest $request, Role $role)
    {
        $this->authorize('update', $this->roleRepository->getModel());

        try {
            DB::beginTransaction();

            $formData = sanitize($request->all());

            $role = $this->roleRepository->update($formData, $role->id);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();


            if (app()->env == 'local') {
                dd($exception);
            } else {
                Log::error('Role update: ' . $exception->getMessage() . ' Trace : ' . $exception->getTraceAsString());

                return redirect()->back()->withErrors(ResponseHelper::STATUS_MESSAGE_FOR_INTERNAL_SERVER_ERROR);
            }
        }

        return redirect()->route('backend.roles.index')->with('success', 'Role Updated Successfully!');
    }

    public function destroy(Role $role)
    {
        $this->authorize('delete', $this->roleRepository->getModel());

        try {
            DB::beginTransaction();

            $this->roleRepository->delete($role->id);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();


            if (app()->env == 'local') {
                dd($exception);
            } else {
                Log::error('Role delete: ' . $exception->getMessage() . ' Trace : ' . $exception->getTraceAsString());

                return jsonresServerError();
            }
        }

        return jsonresSuccess();
    }
}
