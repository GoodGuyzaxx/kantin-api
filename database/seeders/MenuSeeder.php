<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menus')->insert([
            'id_kantin' => 1,
            'nama_menu' => 'Mie Goreng',
            'deskripsi' => 'Spesial Pake Telur',
            'harga' => 15000,
            'stock' => 1000,
            'kategori' => 'makanan',
            'created_at' => Carbon::now()
        ]);

        DB::table('menus')->insert([
            'id_kantin' => 1,
            'nama_menu' => 'Mie Kuah',
            'deskripsi' => 'Spesial Pake Telur',
            'harga' => 15000,
            'stock' => 1000,
            'kategori' => 'makanan',
            'created_at' => Carbon::now()
        ]);

        DB::table('menus')->insert([
            'id_kantin' => 1,
            'nama_menu' => 'Es Jeruk',
            'deskripsi' => 'dingin dan menyegarkan',
            'harga' => 10000,
            'stock' => 1000,
            'kategori' => 'minuman',
            'created_at' => Carbon::now()
        ]);

        DB::table('menus')->insert([
            'id_kantin' => 1,
            'nama_menu' => 'Es Teh',
            'deskripsi' => 'dingin dan menyegarkan',
            'harga' => 10000,
            'stock' => 1000,
            'kategori' => 'minuman',
            'created_at' => Carbon::now()
        ]);


        //id Kantin 2
        DB::table('menus')->insert([
            'id_kantin' => 2,
            'nama_menu' => 'Mie Goreng',
            'deskripsi' => 'Spesial Pake Telur',
            'harga' => 15000,
            'stock' => 1000,
            'kategori' => 'makanan',
            'created_at' => Carbon::now()
        ]);

        DB::table('menus')->insert([
            'id_kantin' => 2,
            'nama_menu' => 'Mie Kuah',
            'deskripsi' => 'Spesial Pake Telur',
            'harga' => 15000,
            'stock' => 1000,
            'kategori' => 'makanan',
            'created_at' => Carbon::now()
        ]);

        DB::table('menus')->insert([
            'id_kantin' => 2,
            'nama_menu' => 'Es Jeruk',
            'deskripsi' => 'dingin dan menyegarkan',
            'harga' => 10000,
            'stock' => 1000,
            'kategori' => 'minuman',
            'created_at' => Carbon::now()
        ]);

        DB::table('menus')->insert([
            'id_kantin' => 2,
            'nama_menu' => 'Es Teh',
            'deskripsi' => 'dingin dan menyegarkan',
            'harga' => 10000,
            'stock' => 1000,
            'kategori' => 'minuman',
            'created_at' => Carbon::now()
        ]);


        //Kantin 3
        DB::table('menus')->insert([
            'id_kantin' => 3,
            'nama_menu' => 'Mie Goreng',
            'deskripsi' => 'Spesial Pake Telur',
            'harga' => 15000,
            'stock' => 1000,
            'kategori' => 'makanan',
            'created_at' => Carbon::now()
        ]);

        DB::table('menus')->insert([
            'id_kantin' => 3,
            'nama_menu' => 'Mie Kuah',
            'deskripsi' => 'Spesial Pake Telur',
            'harga' => 15000,
            'stock' => 1000,
            'kategori' => 'makanan',
            'created_at' => Carbon::now()
        ]);

        DB::table('menus')->insert([
            'id_kantin' => 3,
            'nama_menu' => 'Es Jeruk',
            'deskripsi' => 'dingin dan menyegarkan',
            'harga' => 10000,
            'stock' => 1000,
            'kategori' => 'minuman',
            'created_at' => Carbon::now()
        ]);

        DB::table('menus')->insert([
            'id_kantin' => 3,
            'nama_menu' => 'Es Teh',
            'deskripsi' => 'dingin dan menyegarkan',
            'harga' => 10000,
            'stock' => 1000,
            'kategori' => 'minuman',
            'created_at' => Carbon::now()
        ]);
    }
}
