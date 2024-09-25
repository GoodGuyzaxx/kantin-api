<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class test extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('recommendations')->insert([
            'id_menu'=> 5,
            'predicted_rating' => 3.96,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('recommendations')->insert([
            'id_menu'=> 6,
            'predicted_rating' => 3.65,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('recommendations')->insert([
            'id_menu'=> 7,
            'predicted_rating' => 4.02,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('recommendations')->insert([
            'id_menu'=> 12,
            'predicted_rating' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
