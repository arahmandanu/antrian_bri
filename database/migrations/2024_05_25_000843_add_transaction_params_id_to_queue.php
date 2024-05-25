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
        if (! Schema::hasColumn('queue', 'transaction_params_id')) {
            Schema::table('queue', function (Blueprint $table) {
                $table->string('transaction_params_id')->nullable(true);
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
        if (Schema::hasColumn('queue', 'transaction_params_id')) {
            Schema::table('queue', function (Blueprint $table) {
                $table->dropColumn('transaction_params_id');
            });
        }
    }
};
