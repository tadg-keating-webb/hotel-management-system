<?php

namespace Tests\Feature\Filament;

use App\Filament\Resources\TripResource;
use App\Models\Trip;
use App\Models\User;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TripTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create(['is_admin' => true]));
    }

    public function test_requires_authentication()
    {
        $this->get(TripResource::getUrl())->assertSuccessful();
        $this->actingAs(User::factory()->create())->get(TripResource::getUrl())->assertStatus(403);
    }

    public function test_can_list()
    {
        $trips = Trip::factory()->count(10)->create();

        Livewire::test(TripResource\Pages\ListTrips::class)
            ->set('tableRecordsPerPage', 'all')
            ->assertCanSeeTableRecords($trips);
    }

    public function test_can_render_create_page()
    {
        $this->get(TripResource::getUrl('create'))->assertSuccessful();
    }

    public function test_can_create()
    {
        $trip = Trip::factory()->make()->toArray();
        $trip['duration'] = 4;

        Livewire::test(TripResource\Pages\CreateTrip::class)
            ->fillForm($trip)
            ->call('create')
            ->assertHasNoFormErrors();
    }

    public function test_can_validate_input_on_create()
    {
        Livewire::test(TripResource\Pages\CreateTrip::class)
            ->fillForm([])
            ->call('create')
            ->assertHasFormErrors([
                'title' => 'required',
                'description' => 'required',
                'long_description' => 'required',
                'duration' => 'required',
            ]);
    }

    public function test_can_render_edit_page()
    {
        $this->get(TripResource::getUrl('edit', [
            'record' => Trip::factory()->create(),
        ]))->assertSuccessful();
    }

    public function test_can_retrieve_data_on_edit_page()
    {
        $trip = Trip::factory()->create(['duration' => 4]);

        Livewire::test(TripResource\Pages\EditTrip::class, [
            'record' => $trip->getRouteKey(),
        ])
            ->assertFormSet([
                'title' => $trip->title,
                'duration' => 4,
                'description' => $trip->description,
                'long_description' => $trip->long_description,
                'price' => $trip->price,
            ]);
    }

    public function test_can_update()
    {
        $trip = Trip::factory()->create();

        $data = Trip::factory()->make()->toArray();

        $data['duration'] = 4;

        Livewire::test(TripResource\Pages\EditTrip::class, [
            'record' => $trip->getRouteKey(),
        ])
            ->fillForm($data)
            ->call('save')
            ->assertHasNoFormErrors();

        $trip->refresh();

        $this->assertEquals($trip->title, $data['title']);
        $this->assertEquals($trip->description, $data['description']);
        $this->assertEquals($trip->long_description, $data['long_description']);
        $this->assertEquals($trip->price, $data['price']);
        $this->assertEquals($trip->duration, $data['duration'] . ' days');
    }

    public function test_can_validate_input_on_update()
    {
        $trip = Trip::factory()->create();

        Livewire::test(TripResource\Pages\EditTrip::class, [
            'record' => $trip->getRouteKey(),
        ])
            ->fillForm([
                'title' => null,
                'duration' => null,
                'description' => null,
                'long_description' => null,
            ])
            ->call('save')
            ->assertHasFormErrors([
                'title' => 'required',
                'duration' => 'required',
                'description' => 'required',
                'long_description' => 'required',
            ]);
    }

    public function test_can_delete()
    {
        $trip = Trip::factory()->create();

        Livewire::test(TripResource\Pages\ListTrips::class)
            ->callTableAction(DeleteAction::class, $trip);

        $this->assertModelMissing($trip);
    }
}
