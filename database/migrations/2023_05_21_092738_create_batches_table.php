<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->integer('department_id');
            $table->integer('batch_number');
            $table->integer('batch_payment_info_id')->default(0);
            $table->integer('total_student')->default(0);
            $table->integer('total_semester')->default(12);
            $table->date('admission_start');
            $table->date('admission_end');
            $table->boolean('admission_close')->default(0);
            $table->integer('status')->default(0);// 0 admission open, 1  active , 2 completed
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
        Schema::dropIfExists('batches');
    }
}
