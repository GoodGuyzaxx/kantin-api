<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KonsumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('konsumens')->insert([
            'nama_konsumen' => 'Ando',
            'email' => 'ando@konsumen.com',
            'no_telp' => '082212345678',
            'password' => hash::make('123'),
            'created_at' => Carbon::now()
        ]);

        DB::table('konsumens')->insert([
            'nama_konsumen' => 'Alfi',
            'email' => 'alfi@konsumen.com',
            'no_telp' => '082212345678',
            'password' => hash::make('123'),
            'created_at' => Carbon::now()
        ]);

        DB::table('konsumens')->insert([
            'nama_konsumen' => 'Malki',
            'email' => 'malki@konsumen.com',
            'no_telp' => '082212345678',
            'password' => hash::make('123'),
            'created_at' => Carbon::now()
        ]);

        DB::table('konsumens')->insert([
            'nama_konsumen' => 'Sherly',
            'email' => 'sherly@konsumen.com',
            'no_telp' => '082212345678',
            'password' => hash::make('123'),
            'created_at' => Carbon::now()
        ]);

        DB::table('konsumens')->insert([
            'nama_konsumen' => 'Viko',
            'email' => 'viko@konsumen.com',
            'no_telp' => '082212345678',
            'password' => hash::make('123'),
            'created_at' => Carbon::now()
        ]);

        DB::table('konsumens')->insert([
            'nama_konsumen' => 'Fenia',
            'email' => 'fenia@konsumen.com',
            'no_telp' => '082212345678',
            'password' => hash::make('123'),
            'created_at' => Carbon::now()
        ]);

    }
}
