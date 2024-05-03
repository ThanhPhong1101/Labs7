<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => '1',
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456')
        ]);

        DB::table('users')->insert([
            'id' => '2',
            'name' => 'Phong',
            'email' => 'Phong@admin.com',
            'password' => Hash::make('123456')
        ]);

        DB::table('users')->insert([
            'id' => '3',
            'name' => 'A',
            'email' => 'A@admin.com',
            'password' => Hash::make('123456')
        ]);

        DB::table('users')->insert([
            'id' => '4',
            'name' => 'B',
            'email' => 'B   @admin.com',
            'password' => Hash::make('123456')
        ]);
    }
}
