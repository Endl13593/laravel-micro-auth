<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function test_validations_register()
    {
        $response = $this->postJson('/register', []);

        $response->assertStatus(422);
    }

    public function test_register()
    {
        $response = $this->postJson('/register', [
            'name' => 'Eduardo Nunes',
            'email' => 'nunes.eduardo1993@gmail.com',
            'password' => '123456789',
            'device_name' => 'test'
        ]);

        $response->assertJsonStructure([
            'data' => [
                'identify',
                'name',
                'email',
                'permissions' => []
            ],
            'token'
        ]);

        $response->assertStatus(201);
    }
}
