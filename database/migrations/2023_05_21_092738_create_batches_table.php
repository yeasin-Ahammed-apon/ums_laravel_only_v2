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
            $table->integer('semester')->default(0);//delete -> already in another file
            $table->date('admission_start');
            $table->date('admission_end');
            $table->integer('status')->default(0);// 0 admission open, 1  active , 2 completed
            // total_admit -> in other file
            // total_semester -> in other file
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
