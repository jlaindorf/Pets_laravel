<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Env;

class InitialUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Julio',
            'email'=> env('DEFAULT_EMAIL'),
            'password' => env('DEFAULT_PASSWORD'),
            'profile_id' => 1
        ]);
    }
}
