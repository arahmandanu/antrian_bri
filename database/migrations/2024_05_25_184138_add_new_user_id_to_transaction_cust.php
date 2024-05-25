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
        if (! Schema::hasColumn('transactioncust', 'newUserId')) {
            Schema::table('transactioncust', function (Blueprint $table) {
                $table->string('newUserId')->nullable(true);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactioncust', function (Blueprint $table) {
            $table->dropColumn('newUserId');
        });
    }
};
