<?php

use App\Enums\UserRole;
use App\Models\Tour;
use App\Models\Travel;
use App\Models\User;

beforeEach(function () {
    $this->adminUser = User::factory()->create(['role' => UserRole::ADMIN]);
    $this->editorUser = User::factory()->create(['role' => UserRole::EDITOR]);

    $this->travel = Travel::factory()->has(Tour::factory()->count(10))->create();
});

test('can see travels show page', function () {
    $travel = Travel::factory()->create();
    $this->get('/travels/' . $travel->slug)->assertStatus(200);
});

test('can not see travel show page with no existing travel', function () {
    $travel = Travel::factory()->create();
    $slug = $travel->slug;
    $travel->delete();
    $this->get('/travels/' . $slug)->assertStatus(404);
});

test('can see no-tour-text if travel do not have tours', function () {
    $travel = Travel::factory()->create();
    $this->get('/travels/' . $travel->slug)
        ->assertStatus(200)->assertViewHas('tours', function ($collection) {
            return $collection->count() == 0;
        })->assertSee('no-tour-text');
});

test('can not see no-tour-text if travel have tours', function () {
    $this->get('/travels/' . $this->travel->slug)
        ->assertStatus(200)->assertViewHas('tours', function ($collection) {
            return $collection->count() != 0;
        })->assertDontSee('no-tour-text');
});

test('travel with tours show page can see search filters', function () {
    $this->get('/travels/' . $this->travel->slug)
        ->assertStatus(200)->assertSee('tours-filters');
});

test('unauthenticated user can not see add a new tour link', function () {
    $this->get('/travels/' . $this->travel->slug)
        ->assertStatus(200)->assertDontSee('add-tour-link');
});

test('unauthenticated user can not see delete tour link', function () {
    $this->get('/travels/' . $this->travel->slug)
        ->assertStatus(200)->assertDontSee('delete-travel-form');
});

test('unauthenticated user can not see edit tour link', function () {
    $this->get('/travels/' . $this->travel->slug)
        ->assertStatus(200)->assertDontSee('edit-travel-link');
});

test('admin user can not see edit tour link', function () {
    $this->actingAs($this->adminUser)
        ->get('/travels/' . $this->travel->slug)
        ->assertOk()
        ->assertDontSee('edit-travel-link');
});

test('editor user can not see add tour and delete tour links', function () {
    $this->actingAs($this->editorUser)
        ->get('/travels/' . $this->travel->slug)
        ->assertStatus(200)->assertDontSee('add-tour-link')
        ->assertDontSee('delete-tour-form');
});
