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
         DB::table('users')->updateOrInsert(
            ['email' => 'm@gherbawi.ps'], // شرط وجود المستخدم
            [
                'name' => 'Muhannad Algherbawi',
                'password' => Hash::make('1234'),
            ]
        );
    }
}
