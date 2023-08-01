<?php

namespace Tests\Feature;

use Illuminate\Support\Arr;
use Inertia\Testing\AssertableInertia as Assert;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private function getFakeUserData(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->safeEmail,
            'message' => $this->faker->paragraph,
            'terms' => true,
        ];
    }

    public function testContactUsPageIsAccessible()
    {
        $response = $this->get('/contact-us');

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Contact/Create')
        );
    }

    public function testContactFormSubmission()
    {
        $requestData = $this->getFakeUserData();

        $response = $this->post('/contact-us', $requestData);

        $response->assertStatus(302);
        $response->assertRedirect(route('home'));

        $this->assertDatabaseHas('contacts', Arr::except($requestData, 'terms'));
    }

    public function testFirstNameIsRequired()
    {
        $userData = $this->getFakeUserData();
        unset($userData['first_name']);

        $response = $this->post('/contact-us', $userData);

        $response->assertSessionHasErrors('first_name');
    }

    public function testLastNameIsRequired()
    {
        $userData = $this->getFakeUserData();
        unset($userData['last_name']);

        $response = $this->post('/contact-us', $userData);

        $response->assertSessionHasErrors('last_name');
    }

    public function testEmailIsRequired()
    {
        $userData = $this->getFakeUserData();
        unset($userData['email']);

        $response = $this->post('/contact-us', $userData);

        $response->assertSessionHasErrors('email');
    }

    public function testMessageIsRequired()
    {
        $userData = $this->getFakeUserData();
        unset($userData['message']);

        $response = $this->post('/contact-us', $userData);

        $response->assertSessionHasErrors('message');
    }

    public function testTermsIsRequired()
    {
        $userData = $this->getFakeUserData();
        unset($userData['terms']);

        $response = $this->post('/contact-us', $userData);

        $response->assertSessionHasErrors('terms');
    }
}
