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
        Schema::create('question_answer_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_answer_id')->references('id')->on('question_answers');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->integer('validity')->comment('1=correct answer')->nullable(true);
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
        Schema::dropIfExists('question_answer_user');
    }
};
