<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibraryBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('library_books', function (Blueprint $table) {
            $table->id();
            $table->longText('image')->nullable();
            $table->string('name');
            $table->string('code')->nullable();
            $table->string('description')->nullable();
            $table->bigInteger('library_categorie_id')->nullable();
            $table->bigInteger('department_id')->nullable();
            $table->bigInteger('user_id');
            $table->string('author')->nullable();
            $table->integer('stock1_in')->default(0);
            $table->integer('stock_out')->default(0);
            $table->string('publisher')->nullable();
            $table->string('isbn')->nullable();
            $table->integer('reck')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('library_books');
    }
}
