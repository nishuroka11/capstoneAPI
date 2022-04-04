<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('permissions')->delete();

        \DB::table('permissions')->insert(array (
            0 =>
            array (
                'id' => 3,
                'uuid' => Str::uuid(),
                'name' => 'users-create',
                'guard_name' => '*',
                'created_at' => '2020-12-30 08:57:51',
                'updated_at' => '2020-12-30 08:57:51',
            ),
            1 =>
            array (
                'id' => 4,
                'uuid' => Str::uuid(),
                'name' => 'users-read',
                'guard_name' => '*',
                'created_at' => '2020-12-30 08:57:51',
                'updated_at' => '2020-12-30 08:57:51',
            ),
            2 =>
            array (
                'id' => 5,
                'uuid' => Str::uuid(),
                'name' => 'users-update',
                'guard_name' => '*',
                'created_at' => '2020-12-30 08:57:51',
                'updated_at' => '2020-12-30 08:57:51',
            ),
            3 =>
            array (
                'id' => 6,
                'uuid' => Str::uuid(),
                'name' => 'users-delete',
                'guard_name' => '*',
                'created_at' => '2020-12-30 08:57:51',
                'updated_at' => '2020-12-30 08:57:51',
            ),
            4 =>
            array (
                'id' => 11,
                'uuid' => Str::uuid(),
                'name' => 'tested',
                'guard_name' => '*',
                'created_at' => '2020-12-30 08:57:51',
                'updated_at' => '2020-12-30 08:57:51',
            ),
            5 =>
            array (
                'id' => 12,
                'uuid' => Str::uuid(),
                'name' => 'roles-create',
                'guard_name' => '*',
                'created_at' => '2020-12-31 05:06:03',
                'updated_at' => '2020-12-31 05:06:03',
            ),
            6 =>
            array (
                'id' => 13,
                'uuid' => Str::uuid(),
                'name' => 'roles-read',
                'guard_name' => '*',
                'created_at' => '2020-12-31 05:06:03',
                'updated_at' => '2020-12-31 05:06:03',
            ),
            7 =>
            array (
                'id' => 14,
                'uuid' => Str::uuid(),
                'name' => 'roles-update',
                'guard_name' => '*',
                'created_at' => '2020-12-31 05:06:03',
                'updated_at' => '2020-12-31 05:06:03',
            ),
            8 =>
            array (
                'id' => 15,
                'uuid' => Str::uuid(),
                'name' => 'roles-delete',
                'guard_name' => '*',
                'created_at' => '2020-12-31 05:06:03',
                'updated_at' => '2020-12-31 05:06:03',
            ),
            9 =>
            array (
                'id' => 16,
                'uuid' => Str::uuid(),
                'name' => 'permissions-create',
                'guard_name' => '*',
                'created_at' => '2020-12-31 05:06:10',
                'updated_at' => '2020-12-31 05:06:10',
            ),
            10 =>
            array (
                'id' => 17,
                'uuid' => Str::uuid(),
                'name' => 'permissions-read',
                'guard_name' => '*',
                'created_at' => '2020-12-31 05:06:10',
                'updated_at' => '2020-12-31 05:06:10',
            ),
            11 =>
            array (
                'id' => 18,
                'uuid' => Str::uuid(),
                'name' => 'permissions-update',
                'guard_name' => '*',
                'created_at' => '2020-12-31 05:06:10',
                'updated_at' => '2020-12-31 05:06:10',
            ),
            12 =>
            array (
                'id' => 19,
                'uuid' => Str::uuid(),
                'name' => 'permissions-delete',
                'guard_name' => '*',
                'created_at' => '2020-12-31 05:06:10',
                'updated_at' => '2020-12-31 05:06:10',
            ),
            13 =>
            array (
                'id' => 20,
                'uuid' => Str::uuid(),
                'name' => 'page-posts-create',
                'guard_name' => '*',
                'created_at' => '2020-12-31 05:06:10',
                'updated_at' => '2020-12-31 05:06:10',
            ),
            14 =>
            array (
                'id' => 21,
                'uuid' => Str::uuid(),
                'name' => 'page-posts-read',
                'guard_name' => '*',
                'created_at' => '2020-12-31 05:06:10',
                'updated_at' => '2020-12-31 05:06:10',
            ),
            15 =>
            array (
                'id' => 22,
                'uuid' => Str::uuid(),
                'name' => 'page-posts-update',
                'guard_name' => '*',
                'created_at' => '2020-12-31 05:06:10',
                'updated_at' => '2020-12-31 05:06:10',
            ),
            16 =>
            array (
                'id' => 23,
                'uuid' => Str::uuid(),
                'name' => 'page-posts-delete',
                'guard_name' => '*',
                'created_at' => '2020-12-31 05:06:10',
                'updated_at' => '2020-12-31 05:06:10',
            ),
        ));


    }
}
