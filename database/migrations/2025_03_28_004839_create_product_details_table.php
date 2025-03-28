<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('master_product_id');
            $table->foreign('master_product_id')->references('id')->on('master_products')->onDelete('cascade');

            $table->string('value')->nullable(false);
            $table->string('suku_bunga')->nullable(false);
            $table->integer('display_number')->default(0)->nullable(false);
            $table->timestamps();

            $table->unique(['display_number', 'master_product_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_details');
    }
};
