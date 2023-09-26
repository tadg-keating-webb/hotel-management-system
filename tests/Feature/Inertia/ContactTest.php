<?php

namespace Tests\Feature\Inertia;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_us_page_is_accessible()
    {
        $response = $this->get(route('contact.create'));

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Contact/Create')
        );
    }

    public function test_contact_form_submission()
    {
        $contactData = Contact::factory()->withTerms()->make()->toArray();

        $response = $this->post(route('contact.create'), $contactData);

        $response->assertStatus(302);
        $response->assertRedirect(route('contact.create'));

        $this->assertDatabaseHas('contacts', Arr::except($contactData, 'terms'));
    }

    public function test_validation()
    {
        $response = $this->post(route('contact.create'), []);

        $response->assertSessionHasErrors(['name', 'email', 'message', 'terms']);
    }
}
