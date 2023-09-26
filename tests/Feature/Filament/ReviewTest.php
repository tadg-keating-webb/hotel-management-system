<?php

namespace Tests\Feature\Filament;

use App\Filament\Resources\ReviewResource;
use App\Models\Review;
use App\Models\User;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create(['is_admin' => true]));
    }

    public function test_requires_authentication()
    {
        $this->get(ReviewResource::getUrl())->assertSuccessful();
        $this->actingAs(User::factory()->create())->get(ReviewResource::getUrl())->assertStatus(403);
    }

    public function test_can_list()
    {
        $reviews = Review::factory()->count(10)->create();

        Livewire::test(ReviewResource\Pages\ListReviews::class)
            ->assertCanSeeTableRecords($reviews);
    }

    public function test_can_render_create_page()
    {
        $this->get(ReviewResource::getUrl('create'))->assertSuccessful();
    }

    public function test_can_create()
    {
        Livewire::test(ReviewResource\Pages\CreateReview::class)
            ->fillForm(Review::factory()->make()->toArray())
            ->call('create')
            ->assertHasNoFormErrors();
    }

    public function test_can_validate_input_on_create()
    {
        Livewire::test(ReviewResource\Pages\CreateReview::class)
            ->fillForm([
                'review' => null,
                'name' => null,
                'rating' => null,
            ])
            ->call('create')
            ->assertHasFormErrors([
                'review' => 'required',
                'name' => 'required',
                'rating' => 'required',
            ]);

        Livewire::test(ReviewResource\Pages\CreateReview::class)
            ->fillForm([
                'rating' => 'some string data',
            ])
            ->call('create')
            ->assertHasFormErrors([
                'rating' => 'numeric',
            ]);

        Livewire::test(ReviewResource\Pages\CreateReview::class)
            ->fillForm([
                'rating' => 6,
            ])
            ->call('create')
            ->assertHasFormErrors([
                'rating' => 'lte',
            ]);

        Livewire::test(ReviewResource\Pages\CreateReview::class)
            ->fillForm([
                'rating' => 0,
            ])
            ->call('create')
            ->assertHasFormErrors([
                'rating' => 'gte',
            ]);
    }

    public function test_can_render_edit_page()
    {
        $this->get(ReviewResource::getUrl('edit', [
            'record' => Review::factory()->create(),
        ]))->assertSuccessful();
    }

    public function test_can_retrieve_data_on_edit_page()
    {
        $review = Review::factory()->create();

        Livewire::test(ReviewResource\Pages\EditReview::class, [
            'record' => $review->getRouteKey(),
        ])
            ->assertFormSet([
                'review' => $review->review,
                'rating' => $review->rating,
                'name' => $review->name,
                'approved' => $review->approved,
            ]);
    }

    public function test_can_update()
    {
        $review = Review::factory()->create();
        $data = Review::factory()->make();

        Livewire::test(ReviewResource\Pages\EditReview::class, [
            'record' => $review->getRouteKey(),
        ])
            ->fillForm($data->toArray())
            ->call('save')
            ->assertHasNoFormErrors();

        $review->refresh();

        $this->assertEquals($review->name, $data->name);
        $this->assertEquals($review->review, $data->review);
        $this->assertEquals($review->rating, $data->rating);
        $this->assertEquals($review->approved, $data->approved);
    }

    public function test_can_validate_input_on_update()
    {
        $review = Review::factory()->create();

        Livewire::test(ReviewResource\Pages\EditReview::class, [
            'record' => $review->getRouteKey(),
        ])
            ->fillForm([
                'review' => null,
                'name' => null,
                'rating' => null,
            ])
            ->call('save')
            ->assertHasFormErrors([
                'review' => 'required',
                'name' => 'required',
                'rating' => 'required',
            ]);

        Livewire::test(ReviewResource\Pages\EditReview::class, [
            'record' => $review->getRouteKey(),
        ])
            ->fillForm([
                'rating' => 'some string data',
            ])
            ->call('save')
            ->assertHasFormErrors([
                'rating' => 'numeric',
            ]);

        Livewire::test(ReviewResource\Pages\EditReview::class, [
            'record' => $review->getRouteKey(),
        ])
            ->fillForm([
                'rating' => 6,
            ])
            ->call('save')
            ->assertHasFormErrors([
                'rating' => 'lte',
            ]);

        Livewire::test(ReviewResource\Pages\EditReview::class, [
            'record' => $review->getRouteKey(),
        ])
            ->fillForm([
                'rating' => 0,
            ])
            ->call('save')
            ->assertHasFormErrors([
                'rating' => 'gte',
            ]);
    }

    public function test_can_delete()
    {
        $review = Review::factory()->create();

        Livewire::test(ReviewResource\Pages\ListReviews::class)
            ->callTableAction(DeleteAction::class, $review);

        $this->assertModelMissing($review);
    }
}
