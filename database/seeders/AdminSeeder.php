<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'nama_admin' => 'Kantin 1',
            'email' => 'kantin1@admin.com',
            'no_telp' => '082212345678',
            'password' => hash::make('123'),
            'created_at' => Carbon::now()
        ]);
        DB::table('admins')->insert([
            'nama_admin' => 'Kantin 2',
            'email' => 'kantin2@admin.com',
            'no_telp' => '082212345678',
            'password' => hash::make('123'),
            'created_at' => Carbon::now()
        ]);
        DB::table('admins')->insert([
            'nama_admin' => 'Kantin 3',
            'email' => 'kantin3@admin.com',
            'no_telp' => '082212345678',
            'password' => hash::make('123'),
            'created_at' => Carbon::now()
        ]);
    }
}
