<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibraryBookIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('library_book_issues', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id");
            $table->bigInteger("taken_by_id");
            $table->bigInteger("library_book_id");
            $table->bigInteger("library_book_copy_id");
            $table->string("issue_in_what_condition")->nullable();
            $table->date("issue_date")->nullable();
            $table->date("expected_return_date")->nullable();
            $table->date("return_date")->nullable();
            $table->string("return_in_what_condition")->nullable();
            $table->bigInteger("fine")->default(0);
            $table->boolean("status")->default(1);
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
        Schema::dropIfExists('library_book_issues');
    }
}
