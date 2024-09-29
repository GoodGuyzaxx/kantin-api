<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategoris')->insert([
           'kategori' => 'makanan',
            'created_at' => Carbon::now()
        ]);

        DB::table('kategoris')->insert([
            'kategori' => 'minuman',
            'created_at' => Carbon::now()

        ]);
    }
}
