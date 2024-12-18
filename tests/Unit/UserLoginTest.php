<?php

namespace Tests\Unit;

use App\Constants\Role;
use App\Constants\WebRouteName;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }

    public function test_login_successful()
    {
        // Step 1: Create a test user
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
            'role' => '2'
        ]);

        // Step 2: Simulate the login request
        $response = $this->post(route(WebRouteName::WEB_ROUTE_LOGIN), [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        // Step 3: Assert the login was successful
        $response->assertRedirect(route(WebRouteName::WEB_ROUTE_TICKET_INDEX)) // Redirect to the dashboard
        ->assertSessionDoesntHaveErrors();

        // Step 4: Verify the user is authenticated
        $this->assertAuthenticatedAs($user);
    }

    public function test_login_failed()
    {
        // Step 1: Create a test user
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
            'role' => '2'
        ]);

        // Step 2: Simulate a login request with wrong credentials
        $response = $this->post(route(WebRouteName::WEB_ROUTE_LOGIN), [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        // Step 3: Assert the login failed
        $response->assertRedirect(route(WebRouteName::WEB_ROUTE_LOGIN))
            ->assertSessionHas('failed', 'Login Failed. Account does not exist.');

        // Step 4: Verify the user is NOT authenticated
        $this->assertGuest();
    }
}

