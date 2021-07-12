<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('orderid')->unsigned();
            $table->bigInteger('productid')->unsigned();
            $table->float('price')->nullable();
            $table->integer('quantity')->nullable();
            $table->float('subtotal')->nullable();
            $table->primary(['orderid', 'productid']);
            $table->foreign('orderid')->references('id')->on('orders');
            $table->foreign('productid')->references('id')->on('products');
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
        Schema::dropIfExists('carts');
    }
}
