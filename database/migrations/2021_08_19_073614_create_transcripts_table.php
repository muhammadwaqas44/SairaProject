<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranscriptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transcripts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('certification_no')->nullable();
            $table->string('total_marks')->nullable();
            $table->string('obtain_marks')->nullable();
            $table->string('cgpq')->nullable();
            $table->enum('status',['Completed','UnCompleted']);
            $table->string('pdf_path',500)->nullable();
            $table->string('pdf_image_path',500)->nullable();
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
        Schema::dropIfExists('transcripts');
    }
}
