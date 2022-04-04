<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserInformationColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('user_type_id')->nullable()->after('user_id');
            $table->unsignedDecimal('years_of_experience')->default(0)->after('email');
            $table->unsignedDecimal('average_rating')->default(0)->after('years_of_experience');
            $table->boolean('is_available')->default(1)->after('average_rating');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user_type_id');
            $table->dropColumn('years_of_experience');
            $table->dropColumn('average_rating');
            $table->dropColumn('is_available');
        });
    }
}
