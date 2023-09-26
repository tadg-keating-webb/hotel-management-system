<?php

namespace Tests\Feature\Filament;

use App\Filament\Resources\ContactResource;
use App\Models\Contact;
use App\Models\User;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create(['is_admin' => true]));
    }

    public function test_requires_authentication()
    {
        // Authentication is successful for an admin user
        $this->get(ContactResource::getUrl())->assertSuccessful();

        // Non-admin user should receive a 403 Forbidden status
        $this->actingAs(User::factory()->create())->get(ContactResource::getUrl())->assertStatus(403);
    }

    public function test_can_list()
    {
        // Create 10 contact instances
        $contacts = Contact::factory()->count(10)->create();

        // Assert that the Livewire component can see the table records
        Livewire::test(ContactResource\Pages\ListContacts::class)
            ->assertCanSeeTableRecords($contacts);
    }

    public function test_can_delete()
    {
        $contact = Contact::factory()->create();

        Livewire::test(ContactResource\Pages\ListContacts::class)
            ->callTableAction(DeleteAction::class, $contact);

        $this->assertModelMissing($contact);
    }
}
