<?php

namespace Tests\Feature;

use App\Models\Specie;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SpecieTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_can_list_all_species()
    {

        Specie::factory(5)->create();
        $user = User::factory()->create(['profile_id' => 2,'password'=>'12345678']);

        $response = $this->actingAs($user)->get('/api/species');
        $this->assertDatabaseCount('species',5);

        $response->assertStatus(200)->assertJsonStructure([
            '*' => [
                'created_at',
                'updated_at',
                'name',
                'id'
            ]
        ]);
    }
    public function test_user_can_add_new_specie(){


        $user = User::factory()->create(['profile_id'=>2, 'password'=>'12345678']);
        $response = $this->actingAs($user)->post('/api/species',['name'=>'cão']);
        $response->assertStatus(201);
        $response->assertJson([
            'name'=>'cão',
            'id'=>true,
            'created_at'=>true,
            'updated_at'=>true,
        ]);
    }
    public function test_user_cant_add_new_specie_with_invalid_data(){


        $user = User::factory()->create(['profile_id'=>2, 'password'=>'12345678']);
        $response = $this->actingAs($user)->post('/api/species',['name'=>1]);
        $response->assertStatus(400);
        $response->assertJson([
           'message'=> 'The name field must be a string.',
           'status'=> 400,
           'errors'=>[],
           'data'=>[]
        ]);
    }
    public function test_user_can_delete_specie(){

        $specieCreated = Specie::factory()->create();

        $user = User::factory()->create(['profile_id'=>1, 'password'=>'12345678']);
        $response = $this->actingAs($user)->delete("/api/species/$specieCreated->id");

        $response->assertStatus(204);
       $this->assertDatabaseMissing('species',['id'=>$specieCreated]);
    }
    public function test_user_can_delete_specie_with_many_species_in_database(){

        Specie::factory(10)->create();
        $specieCreated = Specie::factory()->create();

        $user = User::factory()->create(['profile_id'=>1, 'password'=>'12345678']);
        $response = $this->actingAs($user)->delete("/api/species/$specieCreated->id");

        $this->assertDatabaseCount('species',10);

       $this->assertDatabaseMissing('species',['id'=>$specieCreated]);
       $response->assertStatus(204);

    }
}
