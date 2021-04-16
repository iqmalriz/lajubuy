<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('price');
            $table->integer('stock');
            $table->longText('image')->nullable();
            $table->binary('imagebinary')->nullable();
            $table->longText('video')->nullable();
            $table->binary('videobinary')->nullable();
            $table->longText('audio')->nullable();
            $table->binary('audiobinary')->nullable();
            $table->longText('document')->nullable();
            $table->binary('documentbinary')->nullable();
            $table->longText('comment')->nullable();
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
        Schema::dropIfExists('products');
    }
}
