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
        Schema::create('transaction_params', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('unit_code_id');

            $table->foreign('unit_code_id')->references('id')->on('unit_codes');
            $table->string('code')->nullable(false)->unique();
            $table->string('name')->nullable(false);
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
        Schema::dropIfExists('transaction_params');
    }
};
