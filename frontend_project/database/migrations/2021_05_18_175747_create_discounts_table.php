<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->string('code')->unique();
            $table->integer('percent');
            $table->date('begin_sale');
            $table->date('end_sale');
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade'); 
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discounts');
    }
}
