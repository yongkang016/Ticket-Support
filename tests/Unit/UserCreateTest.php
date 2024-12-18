<?php

namespace Tests\Unit;

use App\Constants\Role;
use App\Constants\WebRouteName;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserCreateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_user_create_successfully()
    {
        // Valid user data
        $userData = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'Password@123', // Valid password format
            'repeat_password' => 'Password@123',
            'role' => 3, // Using Role constant
        ];

        $role_id = $userData['role'];
        $FindRole = \App\Models\Role::query()->find($role_id);
        $roleMapping = Role::selection();

        // Get the string name for the role
        $role = $roleMapping[$role_id];

        // Send POST request to store user
        $response = $this->post(route(WebRouteName::WEB_ROUTE_USER_STORE), $userData);
        // Assertions
        $response->assertRedirect(route(WebRouteName::WEB_ROUTE_USER_INDEX)) // Redirect on success
        ->assertSessionHas('success', 'User created successfully.');

        // Verify user exists in the database
        $this->assertDatabaseHas('users', [
            'email' => 'johndoe@example.com',
        ]);

        // Verify the role is assigned using Role constant
        $user = User::where('email', 'johndoe@example.com')->first();

        if ($FindRole) {
            $user->assignRole($FindRole);
        }

        $this->assertTrue($user->hasRole($FindRole));
    }

    public function test_user_creation_validation_fails()
    {
        // Invalid user data (missing name, invalid email, and mismatched passwords)
        $invalidData = [
            'name' => '', // Required field
            'email' => 'invalid-email', // Invalid email format
            'password' => 'Pass123', // Too short, missing special character
            'repeat_password' => 'Mismatch123', // Does not match
            'role' => 5, // Invalid role
        ];

        // Send POST request to store user
        $response = $this->post(route(WebRouteName::WEB_ROUTE_USER_STORE), $invalidData);

        // Assertions
        $response->assertSessionHasErrors([
            'name', 'email', 'password', 'repeat_password', 'role',
        ]);

        // Ensure no user was created
        $this->assertDatabaseMissing('users', ['email' => 'invalid-email']);
    }
}
