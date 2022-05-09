<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->string('email')->uniqid();
            $table->string('password');

            $table->string('father_name');
            $table->string('father_nation_id');
            $table->string('father_passport_id');
            $table->string('father_phone');
            $table->string('father_job');
            $table->string('father_address');
            $table->unsignedBigInteger('nationality_father_id');
            $table->foreign('nationality_father_id')->references('id')->on('nationalities')->onDelete('cascade');
            $table->unsignedBigInteger('boold_type_father_id');
            $table->foreign('boold_type_father_id')->references('id')->on('type_bloods')->onDelete('cascade');
            $table->unsignedBigInteger('religion_father_id');
            $table->foreign('religion_father_id')->references('id')->on('religions')->onDelete('cascade');



            $table->string('mother_name');
            $table->string('mother_nation_id');
            $table->string('mother_passport_id');
            $table->string('mother_phone');
            $table->string('mother_job');
            $table->string('mother_address');
            $table->unsignedBigInteger('nationality_mother_id');
            $table->foreign('nationality_mother_id')->references('id')->on('nationalities')->onDelete('cascade');
            $table->unsignedBigInteger('boold_type_mother_id');
            $table->foreign('boold_type_mother_id')->references('id')->on('type_bloods')->onDelete('cascade');
            $table->unsignedBigInteger('religion_mother_id');
            $table->foreign('religion_mother_id')->references('id')->on('religions')->onDelete('cascade');
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
        Schema::dropIfExists('parents');
    }
};
