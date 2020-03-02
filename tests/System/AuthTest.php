<?php
namespace Tests\System;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Helpers\DummyRedisData;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @group auth
     */
    public function loginWithPassword(): void
    {
        $user = $this->createTheUser();
        $userCredentials = [
            'email'      => $user->email,
            'password'   => 'dijana1234',
            'grant_type' => 'password',
            'remember'   => false
        ];

        // When POST request is made
        $this->json(
                'POST',
                '/api/auth',
                $userCredentials,
                [
                    'Accept'       => 'application/json',
                    'Content-Type' => 'application/json'
                ]
            )
            ->assertJsonStructure([
                'data' => [
                    'access_token',
                    'refresh_token'
                ]
            ])
            ->assertStatus(200);
    }

    /**
     * @test
     * @group auth2
     */
    public function loginWithPasswordFailIncorrectPassword(): void
    {
        $user = $this->createTheUser();
        $userCredentials = [
            'email'      => $user->email,
            'password'   => 'dijana12345',
            'grant_type' => 'password',
            'remember'   => false
        ];

        // When POST request is made
        $this->json(
            'POST',
            '/api/auth',
            $userCredentials,
            [
                'Accept'       => 'application/json',
                'Content-Type' => 'application/json'
            ]
        )->assertStatus(401);
    }

    /**
     * @group auth
     * @test
     * @throws \Exception
     */
    public function authWithGrantTypeRefreshToken(): void
    {
        // Given we have a registered User
        $user = $this->createTheUser();

        // And his credentials
        $credentials = [
            'id_user' => $user->id,
            'grant_type' => 'refresh_token',
            'refresh_token' => $random_refresh_token = str_random(20),
            'remember' => true
        ];
        // Make a valid refresh token in redis
        resolve(DummyRedisData::class)->seedValidRefreshTokenDependOn($credentials);

        // When POST request is made to
        $response = $this->json(
                'POST',
                '/api/auth',
                $credentials,
                [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ]
            )
            ->assertStatus(200)
            ->decodeResponseJson();

        // Then new access_token is in the response
        $this->assertNotEmpty($response['data']['access_token']);
    }
}
