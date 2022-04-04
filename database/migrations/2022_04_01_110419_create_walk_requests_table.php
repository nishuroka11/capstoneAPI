<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalkRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('walk_requests', function (Blueprint $table) {
            $table->id('request_id');

            $table->uuid('uuid');

            $table->foreignId('fk_notice_id');
            $table->foreignId('fk_owner_id');
            $table->foreignId('fk_animal_id');
            $table->foreignId('fk_walker_id');

            $table->string('request_status');

            $table->dateTime('owner_requested_at')->nullable();
            $table->dateTime('owner_rejected_at')->nullable();

            $table->dateTime('walker_approved_at')->nullable();
            $table->dateTime('walker_rejected_at')->nullable();

            $table->dateTime('completed_at')->nullable();

            $table->string('comment');

            $table->timestamps();

            $table->foreign('fk_notice_id')->references('notice_id')->on('notices');
            $table->foreign('fk_owner_id')->references('user_id')->on('users');
            $table->foreign('fk_animal_id')->references('animal_id')->on('animals');
            $table->foreign('fk_walker_id')->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('walk_requests');
    }
}
