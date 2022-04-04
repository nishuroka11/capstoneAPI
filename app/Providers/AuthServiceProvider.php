<?php

namespace App\Providers;

use App\Models\PagePost;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Modules\PagePosts\Policies\PagePostPolicy;
use App\Modules\Permissions\Policies\PermissionPolicy;
use App\Modules\Roles\Policies\RolePolicy;
use App\Modules\Users\Policies\UserPolicy;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Role::class => RolePolicy::class,
        Permission::class => PermissionPolicy::class,
        PagePost::class => PagePostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies();

        $gate->before(function ($user, $ability) {
            if ($user->isSuperAdministrator()) {
                return true;
            }
        });
    }
}
