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
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'message' => $this->faker->paragraph,
            'terms' => true,
        ];
    }

    public function testContactUsPageIsAccessible()
    {
        $response = $this->get(route('contact.create'));

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Contact/Create')
        );
    }

    public function testContactFormSubmission()
    {
        $requestData = $this->getFakeUserData();

        $response = $this->post(route('contact.create'), $requestData);

        $response->assertStatus(302);
        $response->assertRedirect(route('contact.create'));

        $this->assertDatabaseHas('contacts', Arr::except($requestData, 'terms'));
    }

    public function testNameIsRequired()
    {
        $userData = $this->getFakeUserData();
        unset($userData['name']);

        $response = $this->post(route('contact.create'), $userData);

        $response->assertSessionHasErrors('name');
    }

    public function testEmailIsRequired()
    {
        $userData = $this->getFakeUserData();
        unset($userData['email']);

        $response = $this->post(route('contact.create'), $userData);

        $response->assertSessionHasErrors('email');
    }

    public function testMessageIsRequired()
    {
        $userData = $this->getFakeUserData();
        unset($userData['message']);

        $response = $this->post(route('contact.create'), $userData);

        $response->assertSessionHasErrors('message');
    }

    public function testTermsIsRequired()
    {
        $userData = $this->getFakeUserData();
        unset($userData['terms']);

        $response = $this->post(route('contact.create'), $userData);

        $response->assertSessionHasErrors('terms');
    }
}
