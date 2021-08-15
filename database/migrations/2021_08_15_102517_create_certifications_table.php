<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('bcrypt_id')->nullable();
            $table->string('registration_no')->nullable();
            $table->string('certification_no')->nullable();
            $table->string('candidate_name')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('class_name')->nullable();
            $table->string('started_year')->nullable();
            $table->string('ended_year')->nullable();
            $table->string('total_marks')->nullable();
            $table->string('obtain_marks')->nullable();
            $table->string('cgpq')->nullable();
            $table->string('pdf_path',500)->nullable();
            $table->string('pdf_image_path',500)->nullable();
            $table->string('qr_code_path',500)->nullable();
            $table->string('result_notification_no')->nullable();
            $table->bigInteger('admin_id')->unsigned()->index();
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
        Schema::dropIfExists('certifications');
    }
}
