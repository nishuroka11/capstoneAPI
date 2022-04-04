<?php

namespace Database\Seeders;

use App\Modules\Roles\Constants\RoleConstant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RolesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('roles')->delete();

        \DB::table('roles')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'uuid' => Str::uuid(),
                    'name' => RoleConstant::ROLE_NAME_FOR_ADMIN,
                    'guard_name' => '*',
                    'can_access_web' => 1,
                    'created_at' => '2020-12-30 09:14:30',
                    'updated_at' => '2020-12-30 09:14:30',
                ),
            1 =>
                array(
                    'id' => 2,
                    'uuid' => Str::uuid(),
                    'name' => RoleConstant::ROLE_NAME_FOR_NORMAL_USER,
                    'guard_name' => '*',
                    'can_access_web' => 0,
                    'created_at' => '2020-12-30 11:01:16',
                    'updated_at' => '2020-12-31 05:09:03',
                ),
        ));


    }
}
