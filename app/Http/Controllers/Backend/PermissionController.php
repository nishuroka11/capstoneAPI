<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\BackendController;
use App\Models\Permission;
use App\Modules\Permissions\Repositories\PermissionRepository;
use App\Modules\Permissions\Requests\PermissionCreateRequest;
use App\Modules\Permissions\Requests\PermissionUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PermissionController extends BackendController
{
    protected $additionalViewPrefix = "permissions";

    /**
     * @var PermissionRepository
     */
    private $permissionRepository;

    /**
     * PermissionController constructor.
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function index(Request $request)
    {
        $this->authorize('read', $this->permissionRepository->getModel());

        $permissions = $this->permissionRepository->getQuery();

        if (!empty($request->name)) {
            $permissions = $this->permissionRepository->filterLikeBy($permissions, 'name', $request->name);
        }

        $permissionCount = $permissions->count();

        $permissions = $permissions->paginate(config('constants.records_per_page'));

        return $this->view('index', [
            'permissions' => $permissions,
            'permissionCount' => $permissionCount,
            'title' => 'Permission Listing',
        ]);
    }

    public function create()
    {
        $this->authorize('create', $this->permissionRepository->getModel());

        return $this->view('create', [
            'title' => 'Create Permission',
            'isEdit' => false
        ]);
    }

    public function store(PermissionCreateRequest $request)
    {
        $this->authorize('create', $this->permissionRepository->getModel());

        try {
            DB::beginTransaction();
            $formData = sanitize($request->all());

            $permission = $this->permissionRepository->create($formData);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();


            if (app()->env == 'local') {
                dd($exception);
            } else {
                Log::error('Permission store: ' . $exception->getMessage() . ' Trace : ' . $exception->getTraceAsString());

                return redirect()->back()->withErrors(ResponseHelper::STATUS_MESSAGE_FOR_INTERNAL_SERVER_ERROR);
            }
        }

        return redirect()->route('backend.permissions.index')->with('success', 'Permission Created Successfully!');
    }


    public function show(Permission $permission)
    {
        $this->authorize('read', $this->permissionRepository->getModel());

        return $this->view('show', [
            'title' => "Show Permission",
            'permission' => $permission,
        ]);
    }

    public function edit(Permission $permission)
    {
        $this->authorize('update', $this->permissionRepository->getModel());

        return $this->view('edit', [
            'title' => 'Update Permission',
            'permission' => $permission,
            'isEdit' => true
        ]);
    }

    public function update(PermissionUpdateRequest $request, Permission $permission)
    {
        $this->authorize('update', $this->permissionRepository->getModel());

        try {
            DB::beginTransaction();

            $formData = sanitize($request->all());

            $permission = $this->permissionRepository->update($formData, $permission->id);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();


            if (app()->env == 'local') {
                dd($exception);
            } else {
                Log::error('Permission update: ' . $exception->getMessage() . ' Trace : ' . $exception->getTraceAsString());

                return redirect()->back()->withErrors(ResponseHelper::STATUS_MESSAGE_FOR_INTERNAL_SERVER_ERROR);
            }
        }

        return redirect()->route('backend.permissions.index')->with('success', 'Permission Updated Successfully!');
    }

    public function destroy(Permission $permission)
    {
        $this->authorize('delete', $this->permissionRepository->getModel());

        try {
            DB::beginTransaction();

            $this->permissionRepository->delete($permission->id);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();


            if (app()->env == 'local') {
                dd($exception);
            } else {
                Log::error('Permission delete: ' . $exception->getMessage() . ' Trace : ' . $exception->getTraceAsString());

                return jsonresServerError();
            }
        }

        return jsonresSuccess();
    }

    public function bulkStoreCreate()
    {
        $this->authorize('create', $this->permissionRepository->getModel());

        return $this->view('bulk-store', [
            'title' => 'Bulk Store Permission'
        ]);
    }

    public function bulkStore(PermissionCreateRequest $request)
    {
        $this->authorize('create', $this->permissionRepository->getModel());

        try {
            DB::beginTransaction();

            $this->permissionRepository->bulkStore($request->name);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();

            if (app()->env == 'local') {
                dd($exception);
            } else {
                Log::error('Permission bulkStore: ' . $exception->getMessage() . ' Trace : ' . $exception->getTraceAsString());

                return redirect()->back()->withErrors([ResponseHelper::STATUS_MESSAGE_FOR_INTERNAL_SERVER_ERROR]);
            }
        }

        return redirect()->route('backend.permissions.index')->with('success', 'Bulk Store created successfully!');
    }
}
