<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ubah_paket', function (Blueprint $table) {
            $table->unsignedBigInteger('paket_baru_id')->nullable()->after('paket_lama');
            $table->foreign('paket_baru_id')->references('id')->on('paket')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ubah_paket', function (Blueprint $table) {
            $table->dropForeign(['paket_baru_id']);
            $table->dropColumn('paket_baru_id');
        });
    }
};
