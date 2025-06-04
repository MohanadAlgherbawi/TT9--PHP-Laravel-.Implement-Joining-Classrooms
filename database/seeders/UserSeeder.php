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
        // no rollback , and can create if exist
        // Query Builder
        DB::table('users')->insert([
            'name'=> 'Muhannad Algherbawi',
            'email'=> 'm@gherbawi.ps',
            'password'=> Hash::make('password'),//sha.md5,rsa
        ]);
    }
}
