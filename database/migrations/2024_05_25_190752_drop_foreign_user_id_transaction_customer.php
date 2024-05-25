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
        Schema::table('transactioncust', function (Blueprint $table) {
            $table->dropForeign(['UserId']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactioncust', function (Blueprint $table) {
            $table->foreign('UserId')->nullable(true)->references('code')->on('button_actors')->onUpdate('cascade');
        });
    }
};
