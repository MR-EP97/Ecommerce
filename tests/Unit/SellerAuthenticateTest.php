<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class SellerAuthenticateTest extends TestCase
{
    use RefreshDatabase;
    public function test_register(): void
    {

        $params = [
            'email' => fake()->email,
            'password' => 12345678,
            'password_confirmation' => 12345678,
            'phone_number' => fake()->phoneNumber,
            'shop_name' => fake()->text(35),
        ];

        $response = $this->postJson('/api/seller/register', $params);

        $response->assertStatus(HttpResponse::HTTP_CREATED)
            ->assertJsonStructure([
                'status',
                'message',
                'access_token',
                'token_type'
            ]);

        $this->assertDatabaseHas('sellers', [
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
            'shop_name' => fake()->text(35),
        ];

        $this->postJson('/api/seller/register', $params);

        $response = $this->postJson('/api/seller/login', [
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
