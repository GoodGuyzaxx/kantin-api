<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    /**
     * id_menu 1-4 = kantin 1
     * id_menu 5-8 = Kantin 2
     * id_menu 9-12 = kantin 3
     *
     * id_konsumen hanya sampai 6
     */
    public function run(): void
    {
        //Kantin A
        //Ando id Konsmuen = 1
        DB::table('ratings')->insert([
            'id_konsumen' => 1 ,
            'id_menu' => 1,
            'rating' => 4,
            'created_at' => Carbon::now()
        ]);


        DB::table('ratings')->insert([
            'id_konsumen' => 1 ,
            'id_menu' => 2,
            'rating' => 3,
            'created_at' => Carbon::now()
        ]);

        DB::table('ratings')->insert([
            'id_konsumen' => 1 ,
            'id_menu' => 4,
            'rating' => 3,
            'created_at' => Carbon::now()
        ]);

        //Alfi id = 2
        DB::table('ratings')->insert([
            'id_konsumen' => 2 ,
            'id_menu' => 1,
            'rating' => 3,
            'created_at' => Carbon::now()
        ]);

        DB::table('ratings')->insert([
            'id_konsumen' => 2 ,
            'id_menu' => 2,
            'rating' => 4,
            'created_at' => Carbon::now()
        ]);

        //Malki id = 3
        DB::table('ratings')->insert([
            'id_konsumen' => 3 ,
            'id_menu' => 1,
            'rating' => 5,
            'created_at' => Carbon::now()
        ]);

        DB::table('ratings')->insert([
            'id_konsumen' => 3 ,
            'id_menu' => 2,
            'rating' => 3,
            'created_at' => Carbon::now()
        ]);

        DB::table('ratings')->insert([
            'id_konsumen' => 3 ,
            'id_menu' => 4,
            'rating' => 4,
            'created_at' => Carbon::now()
        ]);

        //Sherly id = 4
        DB::table('ratings')->insert([
            'id_konsumen' => 4 ,
            'id_menu' => 2,
            'rating' => 3,
            'created_at' => Carbon::now()
        ]);

        //Viko id = 5
        DB::table('ratings')->insert([
            'id_konsumen' => 5 ,
            'id_menu' => 1,
            'rating' => 3,
            'created_at' => Carbon::now()
        ]);

        DB::table('ratings')->insert([
            'id_konsumen' => 5 ,
            'id_menu' => 2,
            'rating' => 4,
            'created_at' => Carbon::now()
        ]);

        DB::table('ratings')->insert([
            'id_konsumen' => 5 ,
            'id_menu' => 3,
            'rating' => 5,
            'created_at' => Carbon::now()
        ]);

        DB::table('ratings')->insert([
            'id_konsumen' => 5 ,
            'id_menu' => 4,
            'rating' => 4,
            'created_at' => Carbon::now()
        ]);

        //Fenia id = 6
        DB::table('ratings')->insert([
            'id_konsumen' => 6 ,
            'id_menu' => 1,
            'rating' => 3,
            'created_at' => Carbon::now()
        ]);

        DB::table('ratings')->insert([
            'id_konsumen' => 6 ,
            'id_menu' => 2,
            'rating' => 4,
            'created_at' => Carbon::now()
        ]);

        DB::table('ratings')->insert([
            'id_konsumen' => 6 ,
            'id_menu' => 3,
            'rating' => 5,
            'created_at' => Carbon::now()
        ]);

        DB::table('ratings')->insert([
            'id_konsumen' => 6 ,
            'id_menu' => 4,
            'rating' => 4,
            'created_at' => Carbon::now()
        ]);

        /*
         * Kantin B
         * */

        /*
         * Kantin C
         * */

    }
}
