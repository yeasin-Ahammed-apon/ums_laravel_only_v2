<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDepartmentWaiverIdToDeparment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deparments', function (Blueprint $table) {
            $table->integer('department_waiver_id')->after('program_id')->default(1);// default will be 0
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deparments', function (Blueprint $table) {
            $table->dropColumn('department_waiver_id');
        });
    }
}
