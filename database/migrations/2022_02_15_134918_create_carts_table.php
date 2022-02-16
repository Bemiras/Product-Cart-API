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
            $table->unsignedBigInteger('idCart');
            $table->unsignedBigInteger('idProduct');
            $table->integer('quantity');
            $table->decimal('total',10,2);
            $table->timestamps();

            $table->foreign('idProduct')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');

            $table->foreign('idCart')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
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
