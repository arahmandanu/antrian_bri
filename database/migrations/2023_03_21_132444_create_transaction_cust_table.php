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
        Schema::create('transactioncust', function (Blueprint $table) {
            $table->id();
            $table->string('BaseDt')->nullable(true);

            // Bank Unit Code
            // $table->string('br_code')->nullable(true);
            $table->string('br_code');
            $table->foreign('br_code')->nullable(true)->references('code')->on('mst_bank')->onUpdate('cascade');

            $table->string('SeqNumber')->nullable(true);
            $table->string('TrxDesc')->nullable(true);
            $table->string('TimeTicket')->nullable(true);
            $table->string('TimeCall')->nullable(true);
            $table->string('CustWaitDuration')->nullable(true);
            $table->string('UnitServe')->nullable(true);
            $table->string('CounterNo')->nullable(true);
            $table->string('Absent')->nullable(true);

            // Button Actor code
            // $table->string('UserId')->nullable(true);
            $table->string('UserId');
            $table->foreign('UserId')->nullable(true)->references('code')->on('button_actors')->onUpdate('cascade');

            $table->string('Flag')->nullable(true);
            $table->string('TimeEnd')->nullable(true);
            $table->string('Tservice')->nullable(true);
            $table->string('TWservice')->nullable(true);
            $table->string('TSLAservice')->nullable(true);
            $table->string('TOverSLA')->nullable(true);
            $table->string('QrSeqNumber')->nullable(true);
            $table->string('OnlineQ')->nullable(true);
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
        Schema::dropIfExists('transactioncust');
    }
};
