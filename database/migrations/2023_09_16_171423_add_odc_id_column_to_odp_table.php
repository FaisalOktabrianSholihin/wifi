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
        Schema::table('odp', function (Blueprint $table) {
            $table->unsignedBigInteger('odc_id')->after('kode_odp');
            $table->foreign('odc_id')->references('id')->on('odc')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('odp', function (Blueprint $table) {
            $table->dropForeign(['odc_id']);
            $table->dropColumn('odc_id');
        });
    }
};
