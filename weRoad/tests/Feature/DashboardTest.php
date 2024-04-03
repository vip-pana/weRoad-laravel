<?php

use App\Models\Travel;

test('can access dashboard page', function () {
    $this->get('/')->assertStatus(200);
});

test('dashboard contains empty travels', function () {
    $this->get('/')->assertStatus(200)->assertSee('No travels found');
});

test('dashboard contain one travel', function () {
    $travel = Travel::factory()->create();

    $this->get('/')->assertStatus(200)->assertViewHas('travels', function ($collection) use ($travel) {
        return  $collection->contains($travel);
    });
});

test('dashboard have a second page with a travel', function () {
    $travels = Travel::factory(6)->create();
    $travel = $travels->last();
    $this->get('/?page=2')->assertStatus(200)->assertViewHas('travels', function ($collection) use ($travel) {
        return  $collection->contains($travel);
    });
});

test('dashboard can not contain six travels', function () {
    $travels = Travel::factory(6)->create();
    $travel = $travels->last();
    $this->get('/')->assertStatus(200)->assertViewHas('travels', function ($collection) use ($travel) {
        return  !$collection->contains($travel);
    });
});

test('viewer can not see edit and view links', function () {
    $travel = Travel::factory()->create();
    $this->get('/')->assertStatus(200)->assertDontSee('#edit-' . $travel->id)->assertDontSee('#view-' . $travel->id);
});

test('viewer can not see add tour link')->get('/')->assertStatus(200)->assertDontSee('#create-travel');
