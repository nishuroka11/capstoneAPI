<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->id('notice_id');
            $table->uuid('uuid');
            $table->foreignId('fk_owner_id');
            $table->foreignId('fk_animal_id');
            $table->foreignId('fk_walker_id')->nullable();
            $table->foreignId('fk_from_address_id');

            $table->longText('notice_title');
            $table->longText('notice_description');
            $table->dateTime('requested_date_time');
            $table->unsignedDecimal('rating')->nullable();

            $table->foreign('fk_owner_id')->references('user_id')->on('users');
            $table->foreign('fk_walker_id')->references('user_id')->on('users');
            $table->foreign('fk_animal_id')->references('animal_id')->on('animals');
            $table->foreign('fk_from_address_id')->references('address_id')->on('addresses');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notices');
    }
}
