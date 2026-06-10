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
        if (!Schema::hasColumn('video_adds', 'type')) {
            Schema::table('video_adds', function (Blueprint $table) {
                $table->string('type')->default('all')->after('url');
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
        if (Schema::hasColumn('video_adds', 'type')) {
            Schema::table('video_adds', function (Blueprint $table) {
                $table->dropColumn('type');
            });
        }
    }
};
