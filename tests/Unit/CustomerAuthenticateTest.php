<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class CustomerAuthenticateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */

    public function test_register(): void
    {

        $params = [
            'email' => fake()->email,
            'password' => 12345678,
            'password_confirmation' => 12345678,
            'phone_number' => fake()->phoneNumber,
            'user_name' => fake()->userName,
        ];

        $response = $this->postJson('/api/customer/register', $params);

        $response->assertStatus(HttpResponse::HTTP_CREATED)
            ->assertJsonStructure([
                'status',
                'message',
                'access_token',
                'token_type'
            ]);

        $this->assertDatabaseHas('customers', [
            'email' => $params['email'],
        ]);

    }

    public function test_login(): void
    {

        $email = fake()->email;
        $password = 12345678;

        $params = [
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
            'phone_number' => fake()->phoneNumber,
            'user_name' => fake()->userName,
        ];

        $this->postJson('/api/customer/register', $params);

        $response = $this->postJson('/api/customer/login', [
            'email' => $email,
            'password' => $password
        ]);

        $response->assertStatus(HttpResponse::HTTP_OK)
            ->assertJsonStructure([
                'status',
                'message',
                'access_token',
                'token_type'
            ]);

    }


}
