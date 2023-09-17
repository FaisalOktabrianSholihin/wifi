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
        Schema::table('odp_port', function (Blueprint $table) {
            $table->unsignedBigInteger('odp_id')->after('id');
            $table->foreign('odp_id')->references('id')->on('odp')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('odp_port', function (Blueprint $table) {
            $table->dropForeign(['odp_id']);
            $table->dropColumn('odp_id');
        });
    }
};
