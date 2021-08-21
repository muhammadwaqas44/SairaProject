<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('bcrypt_id')->nullable();
            $table->string('registration_no')->nullable();
            $table->string('candidate_name')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('department_name')->nullable();
            $table->string('class_name')->nullable();
            $table->date('started_date')->nullable();
            $table->date('ended_date')->nullable();
            $table->string('name_campus')->nullable();
            $table->string('batch_no')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('cnic')->nullable();
            $table->string('qr_code_path', 500)->nullable();
            $table->string('result_notification_no')->nullable();
            $table->bigInteger('admin_id')->unsigned()->index();
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::statement('ALTER Table students add student_unique_no INTEGER NOT NULL UNIQUE AUTO_INCREMENT;');
        \Illuminate\Support\Facades\DB::update("ALTER TABLE students AUTO_INCREMENT = 100000;");



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
