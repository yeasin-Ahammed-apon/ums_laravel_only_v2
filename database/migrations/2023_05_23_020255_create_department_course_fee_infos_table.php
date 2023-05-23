<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentCourseFeeInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_course_fee_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('deparment_id');
            $table->integer('duration_year');
            $table->integer('duration_semester');
            $table->integer('credit');
            $table->bigInteger('admission_fee');
            $table->bigInteger('session_fee');
            $table->bigInteger('per_credit_fee');
            $table->bigInteger('total_fee');
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
        Schema::dropIfExists('department_course_fee_infos');
    }
}
