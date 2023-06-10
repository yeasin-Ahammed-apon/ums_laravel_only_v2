<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('login_id')->unique();
            $table->string('password');
            $table->integer('gender_id')->nullable();
            $table->integer('blood_group_id')->nullable();
            $table->string('image');
            $table->integer('role_id');
            $table->integer('department_id')->default(0);// mean admin,account,admission
            $table->integer('permission_id')->nullable();
            $table->boolean('status')->default(1);//1 mean active , 0 mean deactive
            $table->bigInteger('created_by');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
