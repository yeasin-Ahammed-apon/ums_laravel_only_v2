<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentWaiversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_waivers', function (Blueprint $table) {
            $table->id();
            $table->integer('department_id');
            $table->integer('level1')->default(0); // GPA -3.50 to 3.99
            $table->integer('level2')->default(0); // GPA- 4.00 to 4.49
            $table->integer('level3')->default(0); // GPA- 4.50 to 4.99
            $table->integer('level4')->default(0); // GPA- 5.00
            $table->integer('level5')->default(0); // Golden 5.00
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
        Schema::dropIfExists('department_waivers');
    }
}
