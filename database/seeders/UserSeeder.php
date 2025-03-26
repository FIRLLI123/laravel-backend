<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'firlli',
            'email' => 'firlliantonizi@gmail.com',
            'password' => Hash::make('112233'), // Hash password agar aman
        ]);
    }
}
