<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tour', function (Blueprint $table) {
            //
             $table->date('ngay_bat_dau')->nullable()->after('noi_khoi_hanh');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tour', function (Blueprint $table) {
            //
            $table->dropColumn('ngay_bat_dau');
        });
    }
};
