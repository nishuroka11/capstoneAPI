<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnsNameDescriptionForPagePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('page_posts', function (Blueprint $table) {
            $table->renameColumn('name', 'page_post_name');
            $table->renameColumn('description', 'page_post_description');
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
            $table->renameColumn('page_post_name', 'name');
            $table->renameColumn('page_post_description', 'description');
        });
    }
}
