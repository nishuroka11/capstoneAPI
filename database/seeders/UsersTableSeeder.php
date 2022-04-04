<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('users')->delete();

        \DB::table('users')->insert(array(
            0 =>
                array(
                    'user_id' => 1,
                    'name' => 'Lizesh Shakya',
                    'uuid' => Str::uuid(),
                    'is_super_administrator' => 1,
                    'email' => 'lizeshakya@gmail.com',
                    'email_verified_at' => '2020-12-29 08:15:46',
                    'password' => '$2y$10$XQYAyHzMe02jTD.rADtHVuP2Im8dLL9VI9WfWGGNw0yu8.i62/KXu',
                    'two_factor_secret' => NULL,
                    'two_factor_recovery_codes' => NULL,
                    'remember_token' => 'rfnsfTXTKYTAcQ1UiiLvMejQQiePPxbdFd1r5Lqs8OoCjfHYJYmaYAEg5uYq',
                    'current_team_id' => NULL,
                    'profile_photo_path' => NULL,
                    'created_at' => '2020-12-29 08:15:46',
                    'updated_at' => '2020-12-29 11:19:32',
                    'deleted_at' => NULL,
                ),
            1 =>
                array(
                    'user_id' => 2,
                    'name' => 'Lizesh Shakya',
                    'uuid' => Str::uuid(),
                    'is_super_administrator' => 0,
                    'email' => 'lizeshakya1@gmail.com',
                    'email_verified_at' => '2020-12-29 08:15:46',
                    'password' => '$2y$10$m4KRAdW.lvIy.TiybgCX5eja0bZys3sobU8HPIR6bk1SlQWEGbnky',
                    'two_factor_secret' => NULL,
                    'two_factor_recovery_codes' => NULL,
                    'remember_token' => 'rfnsfTXTKYTAcQ1UiiLvMejQQiePPxbdFd1r5Lqs8OoCjfHYJYmaYAEg5uYq',
                    'current_team_id' => NULL,
                    'profile_photo_path' => NULL,
                    'created_at' => '2020-12-29 08:15:46',
                    'updated_at' => '2020-12-29 11:19:32',
                    'deleted_at' => NULL,
                ),
        ));
    }
}
