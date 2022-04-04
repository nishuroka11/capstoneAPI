<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id('animal_id');
            $table->uuid('uuid');
            $table->unsignedInteger('fk_owner_id');
            $table->string('animal_name');
            $table->string('animal_image_url')->nullable();
            $table->string('animal_slug');
            $table->date('date_of_birth');
            $table->string('breed_type');
            $table->boolean('is_walking')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animals');
    }
}
