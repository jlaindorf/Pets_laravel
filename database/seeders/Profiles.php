<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Profiles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Profile::create(['id'=> 1,'name'=>'ADMIN']);
       Profile::create(['id'=> 2,'name'=>'VETERINARIO']);
       Profile::create(['id'=> 3,'name'=>'RECEPCIONISTA']);
    }
}
