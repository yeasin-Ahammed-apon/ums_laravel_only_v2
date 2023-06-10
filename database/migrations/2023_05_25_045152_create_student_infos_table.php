<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('present_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('emergency_phone')->nullable();
            $table->string('emergency_phone_name')->nullable();
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
        Schema::dropIfExists('student_infos');
    }
}
