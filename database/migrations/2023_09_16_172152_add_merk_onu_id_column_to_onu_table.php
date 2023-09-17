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
        Schema::table('onu', function (Blueprint $table) {
            $table->unsignedBigInteger('merk_onu_id')->after('sn_onu');
            $table->unsignedBigInteger('type_onu_id')->after('merk_onu_id');
            $table->foreign('merk_onu_id')->references('id')->on('merk_onu')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('type_onu_id')->references('id')->on('type_onu')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('onu', function (Blueprint $table) {
            $table->dropForeign(['merk_onu_id']);
            $table->dropColumn('merk_onu_id');
            $table->dropForeign(['type_onu_id']);
            $table->dropColumn('type_onu_id');
        });
    }
};
