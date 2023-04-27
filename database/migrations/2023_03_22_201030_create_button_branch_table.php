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
        Schema::create('button_branch', function (Blueprint $table) {
            $table->id();

            $table->string('bank_code');
            $table->foreign('bank_code')->nullable(true)->references('code')->on('mst_bank')->onUpdate('cascade');

            $table->string('button');

            $table->string('actor_code')->nullable(true);
            $table->foreign('actor_code')->references('code')->on('button_actors')->onUpdate('cascade');

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
        Schema::dropIfExists('button_branch');
    }
};
