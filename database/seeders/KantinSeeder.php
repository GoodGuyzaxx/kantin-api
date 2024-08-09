<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KantinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kantins')->insert([
           'id_admin' =>  1,
            'nama_kantin' => 'Kantin 1',
            'created_at' => Carbon::now()
        ]);

        DB::table('kantins')->insert([
            'id_admin' =>  2,
            'nama_kantin' => 'Kantin 2',
            'created_at' => Carbon::now()
        ]);

        DB::table('kantins')->insert([
            'id_admin' =>  3,
            'nama_kantin' => 'Kantin 3',
            'created_at' => Carbon::now()
        ]);
    }
}
