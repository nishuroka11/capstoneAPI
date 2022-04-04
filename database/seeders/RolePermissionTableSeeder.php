<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RolePermissionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('role_has_permissions')->delete();

        \DB::unprepared("INSERT INTO role_has_permissions (permission_id,role_id) VALUES
	 (3,1),
	 (4,1),
	 (5,1),
	 (6,1),
	 (12,1),
	 (13,1),
	 (14,1),
	 (15,1),
	 (16,1),
	 (17,1);
INSERT INTO role_has_permissions (permission_id,role_id) VALUES
	 (18,1),
	 (19,1),
	 (20,1),
	 (20,2),
	 (21,1),
	 (21,2),
	 (22,1),
	 (22,2),
	 (23,1),
	 (23,2);");
    }
}
