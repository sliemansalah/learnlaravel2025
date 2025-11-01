<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserRegistrationValidationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that name is required
     */
    public function test_name_is_required(): void
    {
        $response = $this->post('/users', [
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'birth_date' => '1990-01-01',
            'agree_terms' => true,
        ]);

        $response->assertSessionHasErrors('name');
    }

    /**
     * Test that email is required
     */
    public function test_email_is_required(): void
    {
        $response = $this->post('/users', [
            'name' => 'John Doe',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'birth_date' => '1990-01-01',
            'agree_terms' => true,
        ]);

        $response->assertSessionHasErrors('email');
    }

    /**
     * Test that email must be valid format
     */
    public function test_email_must_be_valid(): void
    {
        $response = $this->post('/users', [
            'name' => 'John Doe',
            'email' => 'not-an-email',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'birth_date' => '1990-01-01',
            'agree_terms' => true,
        ]);

        $response->assertSessionHasErrors('email');
    }

    /**
     * Test that email must be unique
     */
    public function test_email_must_be_unique(): void
    {
        // Create a user first
        User::create([
            'name' => 'Existing User',
            'email' => 'existing@example.com',
            'password' => bcrypt('password123'),
            'birth_date' => '1990-01-01',
        ]);

        // Try to create another user with same email
        $response = $this->post('/users', [
            'name' => 'John Doe',
            'email' => 'existing@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'birth_date' => '1990-01-01',
            'agree_terms' => true,
        ]);

        $response->assertSessionHasErrors('email');
    }

    /**
     * Test that password is required
     */
    public function test_password_is_required(): void
    {
        $response = $this->post('/users', [
            'name' => 'John Doe',
            'email' => 'test@example.com',
            'birth_date' => '1990-01-01',
            'agree_terms' => true,
        ]);

        $response->assertSessionHasErrors('password');
    }

    /**
     * Test that password must be at least 8 characters
     */
    public function test_password_must_be_at_least_8_characters(): void
    {
        $response = $this->post('/users', [
            'name' => 'John Doe',
            'email' => 'test@example.com',
            'password' => '1234567', // Only 7 characters
            'password_confirmation' => '1234567',
            'birth_date' => '1990-01-01',
            'agree_terms' => true,
        ]);

        $response->assertSessionHasErrors('password');
    }

    /**
     * Test that password confirmation must match
     */
    public function test_password_confirmation_must_match(): void
    {
        $response = $this->post('/users', [
            'name' => 'John Doe',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'different123',
            'birth_date' => '1990-01-01',
            'agree_terms' => true,
        ]);

        $response->assertSessionHasErrors('password');
    }

    /**
     * Test that phone must be 10 digits if provided
     */
    public function test_phone_must_be_10_digits(): void
    {
        $response = $this->post('/users', [
            'name' => 'John Doe',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'phone' => '123', // Too short
            'birth_date' => '1990-01-01',
            'agree_terms' => true,
        ]);

        $response->assertSessionHasErrors('phone');
    }

    /**
     * Test that birth date is required
     */
    public function test_birth_date_is_required(): void
    {
        $response = $this->post('/users', [
            'name' => 'John Doe',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'agree_terms' => true,
        ]);

        $response->assertSessionHasErrors('birth_date');
    }

    /**
     * Test that birth date must be before today
     */
    public function test_birth_date_must_be_before_today(): void
    {
        $response = $this->post('/users', [
            'name' => 'John Doe',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'birth_date' => now()->addDay()->format('Y-m-d'), // Tomorrow
            'agree_terms' => true,
        ]);

        $response->assertSessionHasErrors('birth_date');
    }

    /**
     * Test that terms must be accepted
     */
    public function test_terms_must_be_accepted(): void
    {
        $response = $this->post('/users', [
            'name' => 'John Doe',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'birth_date' => '1990-01-01',
            // agree_terms not included
        ]);

        $response->assertSessionHasErrors('agree_terms');
    }

    /**
     * Test that avatar must be an image
     */
    public function test_avatar_must_be_image(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('document.pdf', 100);

        $response = $this->post('/users', [
            'name' => 'John Doe',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'birth_date' => '1990-01-01',
            'avatar' => $file,
            'agree_terms' => true,
        ]);

        $response->assertSessionHasErrors('avatar');
    }

    /**
     * Test that avatar must not exceed 2MB
     */
    public function test_avatar_must_not_exceed_2mb(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('avatar.jpg')->size(3000); // 3MB

        $response = $this->post('/users', [
            'name' => 'John Doe',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'birth_date' => '1990-01-01',
            'avatar' => $file,
            'agree_terms' => true,
        ]);

        $response->assertSessionHasErrors('avatar');
    }

    /**
     * Test successful user registration
     */
    public function test_successful_user_registration(): void
    {
        Storage::fake('public');

        $response = $this->post('/users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'phone' => '1234567890',
            'birth_date' => '1990-01-01',
            'avatar' => UploadedFile::fake()->image('avatar.jpg'),
            'agree_terms' => true,
        ]);

        $response->assertRedirect('/users');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
        ]);
    }

    /**
     * Test successful registration without optional fields
     */
    public function test_registration_without_optional_fields(): void
    {
        $response = $this->post('/users', [
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'birth_date' => '1995-05-15',
            'agree_terms' => true,
            // phone and avatar are optional
        ]);

        $response->assertRedirect('/users');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
        ]);
    }
}
