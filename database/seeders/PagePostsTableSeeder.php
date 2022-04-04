<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PagePostsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('page_posts')->delete();

        $nowDateTime = Carbon::now()->toDateTimeString();

        \DB::table('page_posts')->insert(array (
            0 =>
                array (
                    'page_post_id' => 1,
                    'uuid' => Str::uuid(),
                    'page_post_slug' => 'about-us',
                    'page_post_name' => 'About Us',
                    'page_post_description' => '<p>About Us</p>',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            1 =>
                array (
                    'page_post_id' => 2,
                    'uuid' => Str::uuid(),
                    'page_post_slug' => 'terms-and-condition',
                    'page_post_name' => 'Terms and Condition',
                    'page_post_description' => '<p>This is terms and condition</p>',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),
            2 =>
                array (
                    'page_post_id' => 3,
                    'uuid' => Str::uuid(),
                    'page_post_slug' => 'privacy-policy',
                    'page_post_name' => 'Privacy Policy',
                    'page_post_description' => '<p>This is privacy policy</p>',
                    'created_at' => $nowDateTime,
                    'updated_at' => $nowDateTime,
                ),


        ));


    }
}
