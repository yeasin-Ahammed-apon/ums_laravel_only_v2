<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemporaryStudentPaymentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporary_student_payment_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('temporary_student_id');
            $table->integer('account_id');
            $table->bigInteger('amount');
            $table->string('account_name');
            $table->boolean('type')->nullable();
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
        Schema::dropIfExists('temporary_student_payment_histories');
    }
}
