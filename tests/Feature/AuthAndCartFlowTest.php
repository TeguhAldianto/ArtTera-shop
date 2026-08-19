<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthAndCartFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_and_then_login(): void
    {
        // 1. Register
        $registerResponse = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $registerResponse->assertSessionHasNoErrors();
        $registerResponse->assertRedirect('/login');

        // 2. Login with registered credentials
        $loginResponse = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);
        $this->assertAuthenticated();
        $loginResponse->assertRedirect('/');
    }

    public function test_guest_cannot_access_cart_directly_or_redirects(): void
    {
        $response = $this->get('/cart');
        // Tergantung middleware, biasanya redirect ke login atau return status tertentu
        $response->assertStatus(302);
    }
}
