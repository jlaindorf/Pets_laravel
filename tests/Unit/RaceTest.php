<?php

namespace Tests\Feature;

use App\Models\Race;
use App\Models\User;
use Database\Seeders\InitialUser;
use Database\Seeders\Profiles;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RaceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_add_new_race(){


        $user = User::factory()->create(['profile_id'=>2, 'password'=>'12345678']);
        $response = $this->actingAs($user)->post('/api/races',['name'=>'cão']);
        $response->assertStatus(201);
        $response->assertJson([
            'name'=>'cão',
            'id'=>true,
            'created_at'=>true,
            'updated_at'=>true,
        ]);
    }
    public function test_list_races()
    {

        Race::factory(5)->create();
        $user = User::factory()->create(['profile_id' => 2,'password'=>'12345678']);

        $response = $this->actingAs($user)->get('/api/races');

        $response->assertStatus(200)->assertJsonStructure([
            '*' => [
                'created_at',
                'updated_at',
                'name',
                'id'
            ]
        ]);
    }
}
