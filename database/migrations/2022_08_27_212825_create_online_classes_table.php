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
        Schema::create('online_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grade_id')->references('id')->on('grades')->cascadeOnDelete();
            $table->foreignId('class_room_id')->references('id')->on('class_rooms')->cascadeOnDelete();
            $table->foreignId('section_id')->references('id')->on('sections')->cascadeOnDelete();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('meeting_id');
            $table->string('topic');
            $table->integer('duration')->comment('Minute');
            $table->string('password')->comment('meeting password');
            $table->string('start_time');
            $table->string('join_url');
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
        Schema::dropIfExists('online_classes');
    }
};
