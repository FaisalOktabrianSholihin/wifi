<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('paket')->insert([
            'paket' => '4M',
            'iuran' => '120000',
            'instalasi' => '350000',
        ]);

        DB::table('paket')->insert([
            'paket' => '5M',
            'iuran' => '150000',
            'instalasi' => '350000',
        ]);

        DB::table('paket')->insert([
            'paket' => '10M',
            'iuran' => '200000',
            'instalasi' => '350000',
        ]);

        DB::table('paket')->insert([
            'paket' => '20M',
            'iuran' => '250000',
            'instalasi' => '350000',
        ]);

        DB::table('paket')->insert([
            'paket' => '30M',
            'iuran' => '300000',
            'instalasi' => '350000',
        ]);

        DB::table('paket')->insert([
            'paket' => '40M',
            'iuran' => '350000',
            'instalasi' => '350000',
        ]);

        DB::table('paket')->insert([
            'paket' => '50M',
            'iuran' => '400000',
            'instalasi' => '350000',
        ]);
    }
}
