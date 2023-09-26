<?php

namespace Tests\Feature\Filament;

use App\Filament\Resources\PageResource;
use App\Models\Page;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Livewire\Livewire;
use Tests\TestCase;

class PageTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create(['is_admin' => true]));
    }

    public function test_requires_authentication()
    {
        $this->get(PageResource::getUrl())->assertSuccessful();
        $this->actingAs(User::factory()->create())->get(PageResource::getUrl())->assertStatus(403);
    }

    public function test_can_list()
    {
        $pages = Page::factory()->count(10)->create();

        Livewire::test(PageResource\Pages\ListPages::class)
            ->set('tableRecordsPerPage', 'all')
            ->assertCanSeeTableRecords($pages);
    }

    public function test_can_render_create_page()
    {
        $this->get(PageResource::getUrl('create'))->assertSuccessful();
    }

    public function test_can_create()
    {
        $page = Page::factory()->make()->toArray();

        Livewire::test(PageResource\Pages\CreatePage::class)
            ->fillForm($page)
            ->call('create')
            ->assertHasNoFormErrors();
    }

    public function test_can_validate_input_on_create()
    {
        Livewire::test(PageResource\Pages\CreatePage::class)
            ->fillForm([])
            ->call('create')
            ->assertHasFormErrors([
                'title' => 'required',
                'content' => 'required',
                'images' => 'required',
            ]);
    }

    public function test_can_render_edit_page()
    {
        $this->get(PageResource::getUrl('edit', [
            'record' => Page::factory()->create(),
        ]))->assertSuccessful();
    }

    public function test_can_retrieve_data_on_edit_page()
    {
        $page = Page::factory()->create();

        Livewire::test(PageResource\Pages\EditPage::class, [
            'record' => $page->getRouteKey(),
        ])
            ->assertFormSet([
                'title' => $page->title,
                'slug' => $page->slug,
                'content' => $page->content,
            ]);
    }

    public function test_can_update()
    {
        $page = Page::factory()->create();

        $data = Page::factory()->make()->toArray();

        Livewire::test(PageResource\Pages\EditPage::class, [
            'record' => $page->getRouteKey(),
        ])
            ->fillForm($data)
            ->call('save')
            ->assertHasNoFormErrors();

        $page->refresh();

        $this->assertEquals($page->title, $data['title']);
        $this->assertEquals($page->slug, Str::slug($data['title']));
        $this->assertEquals($page->content, $data['content']);
    }


}
