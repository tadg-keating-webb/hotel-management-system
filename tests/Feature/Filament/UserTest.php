<?php

namespace Tests\Feature\Filament;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create(['is_admin' => true]));
    }

    public function test_requires_authentication()
    {
        $this->get(UserResource::getUrl())->assertSuccessful();
        $this->actingAs(User::factory()->create())->get(UserResource::getUrl())->assertStatus(403);
    }

    public function test_can_list()
    {
        $users = User::factory()->count(10)->create(['is_admin' => false]);

        Livewire::test(UserResource\Pages\ListUsers::class)
            ->set('tableRecordsPerPage', 'all')
            ->assertCanSeeTableRecords($users);
    }

    public function test_can_render_create_page()
    {
        $this->get(UserResource::getUrl('create'))->assertSuccessful();
    }

    public function test_can_create()
    {
        Livewire::test(UserResource\Pages\CreateUser::class)
            ->fillForm(User::factory()->make(['is_admin' => false])->toArray() + ['password' => 'secret'])
            ->call('create')
            ->assertHasNoFormErrors();
    }

    public function test_can_validate_input_on_create()
    {
        Livewire::test(UserResource\Pages\CreateUser::class)
            ->fillForm([])
            ->call('create')
            ->assertHasFormErrors([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'is_admin' => 'required',
            ]);
    }

    public function test_can_render_edit_page()
    {
        $this->get(UserResource::getUrl('edit', [
            'record' => User::factory()->create(),
        ]))->assertSuccessful();
    }

    public function test_can_retrieve_data_on_edit_page()
    {
        $user = User::factory()->create();

        Livewire::test(UserResource\Pages\EditUser::class, [
            'record' => $user->getRouteKey(),
        ])
            ->assertFormSet([
                'name' => $user->name,
                'email' => $user->email,
            ]);
    }

    public function test_can_update()
    {
        $user = User::factory()->create();
        $data = User::factory()->make();

        Livewire::test(UserResource\Pages\EditUser::class, [
            'record' => $user->getRouteKey(),
        ])
            ->fillForm($data->toArray()  + ['password' => 'secret'])
            ->call('save')
            ->assertHasNoFormErrors();

        $user->refresh();

        $this->assertEquals($user->name, $data->name);
        $this->assertEquals($user->email, $data->email);
    }

    public function test_can_validate_input_on_update()
    {
        $user = User::factory()->create();

        Livewire::test(UserResource\Pages\EditUser::class, [
            'record' => $user->getRouteKey(),
        ])
            ->fillForm([
                'name' => null,
                'email' => null,
            ])
            ->call('save')
            ->assertHasFormErrors([
                'name' => 'required',
                'email' => 'required',
            ]);
    }

    public function test_can_delete()
    {
        $user = User::factory()->create();

        Livewire::test(UserResource\Pages\ListUsers::class)
            ->callTableAction(DeleteAction::class, $user);

        $this->assertModelMissing($user);
    }
}
