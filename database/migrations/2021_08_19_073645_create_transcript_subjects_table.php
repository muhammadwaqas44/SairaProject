<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranscriptSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transcript_subjects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('course_id')->nullable();
            $table->string('course_title')->nullable();
            $table->string('credit_hour')->nullable();
            $table->string('max_marks')->nullable();
            $table->string('obtained_marks')->nullable();
            $table->string('grade')->nullable();
            $table->string('quantity_points')->nullable();
            $table->text('remarks')->nullable();
            $table->string('transcript_id')->nullable();
            $table->foreign('transcript_id')->references('id')->on('transcripts')->onDelete ('cascade');
            $table->string('student_id')->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onDelete ('cascade');
            $table->bigInteger('admin_id')->unsigned()->nullable();
            $table->foreign('admin_id')->references('id')->on('users')->onDelete ('cascade');
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
        Schema::dropIfExists('transcript_subjects');
    }
}
