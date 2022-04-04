<?php

namespace App\Providers;

use App\Modules\Addresses\Repositories\AddressRepository;
use App\Modules\Addresses\Repositories\AddressRepositoryImplementation;
use App\Modules\Animals\Repositories\AnimalRepository;
use App\Modules\Animals\Repositories\AnimalRepositoryImplementation;
use App\Modules\Notices\Repositories\NoticeRepository;
use App\Modules\Notices\Repositories\NoticeRepositoryImplementation;
use App\Modules\PagePosts\Repositories\PagePostRepository;
use App\Modules\PagePosts\Repositories\PagePostRepositoryImplementation;
use App\Modules\Roles\Repositories\RoleRepository;
use App\Modules\Roles\Repositories\RoleRepositoryImplementation;
use App\Modules\Users\Repositories\SocialLoginRepository;
use App\Modules\Users\Repositories\SocialLoginRepositoryImplementation;
use App\Modules\Users\Repositories\UserRepository;
use App\Modules\Users\Repositories\UserRepositoryImplementation;

use App\Modules\Permissions\Repositories\PermissionRepository;
use App\Modules\Permissions\Repositories\PermissionRepositoryImplementation;
use Illuminate\Support\ServiceProvider;


class DependencyInjectionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * User Dependency
         */
        $this->app->bind(
            UserRepository::class,
            UserRepositoryImplementation::class
        );

        /**
         * Permission Dependency
         */
        $this->app->bind(
            PermissionRepository::class,
            PermissionRepositoryImplementation::class
        );

        /**
         * Role Dependency
         */
        $this->app->bind(
            RoleRepository::class,
            RoleRepositoryImplementation::class
        );

        /**
         * Social Login Dependency
         */
        $this->app->bind(
            SocialLoginRepository::class,
            SocialLoginRepositoryImplementation::class
        );

        /**
         * Page Post Dependency
         */
        $this->app->bind(
            PagePostRepository::class,
            PagePostRepositoryImplementation::class
        );

        /**
         * Animal Dependency
         */
        $this->app->bind(
            AnimalRepository::class,
            AnimalRepositoryImplementation::class
        );

        /**
         * Address Dependency
         */
        $this->app->bind(
            AddressRepository::class,
            AddressRepositoryImplementation::class
        );

        /**
         * Address Dependency
         */
        $this->app->bind(
            NoticeRepository::class,
            NoticeRepositoryImplementation::class
        );
    }
}
