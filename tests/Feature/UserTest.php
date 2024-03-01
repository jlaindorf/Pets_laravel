<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\InitialUser;
use Database\Seeders\Profiles;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public function test_user_admin_can_done_login()
    {

        $response = $this->post('/api/login', [
            'email' => env("DEFAULT_EMAIL"),
            'password' => env("DEFAULT_PASSWORD")
        ]);

        // Verificar se o status code está como esperado
        $response->assertStatus(201);

        $response->assertJson([
            "message" => "Autorizado",
            "status" => 201,
            'data' => [
                "token" => true,
                "permissions" => true,
                "name" => true,
                "profile" => "ADMIN"
            ]
        ]);
    }

    public function test_user_admin_permissions_load_correct()
    {

        $response = $this->post('/api/login', [
            'email' => env("DEFAULT_EMAIL"),
            'password' => env("DEFAULT_PASSWORD")
        ]);

        $response->assertStatus(201);

        $response->assertJson([
            'data' => [
                'permissions' => [
                    'create-races',
                    'get-races',
                    'create-species',
                    'get-species',
                    'delete-species',
                    'create-pets',
                    'get-pets',
                    'delete-pets',
                    'create-professionals',
                    'get-professionals',
                    'create-users',
                    'export-pdf-pets',
                    'create-vaccines'
                ]
            ]
        ]);
    }
  /*  public function test_logout()
    {
        $this->seed(Profiles::class);
        $this->seed(InitialUser::class);
        $user = User::factory()->create(['profile_id'=>1]);
        $response = $this->actingAs($user)->post('/api/logout');

        $response->assertStatus(204);
    }*/
}
