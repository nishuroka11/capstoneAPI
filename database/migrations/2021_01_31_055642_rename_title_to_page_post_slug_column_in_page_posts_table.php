<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTitleToPagePostSlugColumnInPagePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('page_posts', function (Blueprint $table) {
            $table->renameColumn('type', 'page_post_slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('page_posts', function (Blueprint $table) {
            $table->renameColumn('page_post_slug', 'type');
        });
    }
}
