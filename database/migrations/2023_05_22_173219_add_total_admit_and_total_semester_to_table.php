<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalAdmitAndTotalSemesterToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('batches', function (Blueprint $table) {
            $table->integer('batch_payment_info_id')->after('batch_number')->default(0);
            $table->integer('total_student')->after('batch_number')->default(0);
            $table->integer('total_semester')->after('batch_number')->default(12);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('batches', function (Blueprint $table) {
            $table->dropColumn('batch_payment_info_id');
            $table->dropColumn('total_student');
            $table->dropColumn('total_semester');
        });
    }
}
