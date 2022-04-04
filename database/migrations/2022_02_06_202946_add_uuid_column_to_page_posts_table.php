<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Webpatser\Uuid\Uuid;

class AddUuidColumnToPagePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('page_posts', function (Blueprint $table) {
            $table->uuid('uuid')->index()->after('page_post_id');
        });

        foreach (\App\Models\PagePost::get() as $pagePost) {
            $pagePost->uuid = (string) Uuid::generate(4);
            $pagePost->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('page_posts', function (Blueprint $table) {
            $table->dropIndex(['uuid']);
            $table->dropColumn('uuid');
        });
    }
}
