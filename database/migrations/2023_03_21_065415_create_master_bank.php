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
        Schema::create('mst_bank', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100)->unique(true)->nullable(false);
            $table->string('name', 255)->nullable(false);
            $table->string('city', 255)->nullable(true);

            // $table->string('Area_Code', 255)->nullable(true);
            $table->string('Area_Code');
            $table->foreign('Area_Code')->nullable(true)->references('code')->on('bank_areas')->onUpdate('cascade');

            // $table->string('KC_Code', 255)->nullable(true);
            $table->string('KC_Code');
            $table->foreign('KC_Code')->nullable(true)->references('code')->on('bank_branches')->onUpdate('cascade');

            $table->text('address')->nullable(false);
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
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
        Schema::dropIfExists('mst_bank');
    }
};
