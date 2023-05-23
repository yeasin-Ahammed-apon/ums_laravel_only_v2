<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchPaymentInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_payment_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('batch_id');
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
        Schema::dropIfExists('batch_payment_infos');
    }
}
