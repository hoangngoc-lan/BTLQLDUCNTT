<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('book_name');
            $table->string('author');
            $table->string('image');
            $table->unsignedInteger('quantity');
            $table->string('description' , 1000);
            $table->unsignedInteger('price');
            $table->unsignedBigInteger('bookstore_id');
            $table->timestamps();
            
            $table->foreign('bookstore_id')
                ->references('id')->on('bookstores')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}