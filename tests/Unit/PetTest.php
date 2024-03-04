<?php

namespace Tests\Unit;

use App\Models\Pet;
use App\Models\Race;
use App\Models\Specie;
use App\Models\User;
use Tests\TestCase;

class PetTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_user_can_edit_one_pet(): void
    {

        $specie=Specie::factory()->create();
        $race= Race::factory()->create();
        $pet= Pet::factory()->create(['race_id'=>$race->id,'specie_id'=>$specie->id]);

        $body=['size'=>'LARGE','weight'=>'12.5'];

        $user = User::factory()->create(['profile_id'=>2, 'password'=>'12345678']);
        $response = $this->actingAs($user)->put("/api/pets/$pet->id",$body);
        $response->assertStatus(200);
    }
}
