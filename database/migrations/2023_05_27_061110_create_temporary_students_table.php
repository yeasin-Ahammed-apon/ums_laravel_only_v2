<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemporaryStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporary_students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('created_by')->nullable();// user id  of admission
            $table->integer('admited_by')->nullable();// user id  of admission
            $table->bigInteger('temporary_id');
            $table->bigInteger('batch_id');
            $table->bigInteger('admission_discount')->default(0);
            $table->bigInteger('admission_fee');
            $table->bigInteger('admission_fee_given')->default(0);
            $table->bigInteger('advance_payment')->default(0);
            $table->boolean('status')->default(1);// 1 mean active , 0 mean deactive or complete
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
        Schema::dropIfExists('temporary_students');
    }
}
