<?php

use App\Enums\UserRole;
use App\Models\Tour;
use App\Models\Travel;
use App\Models\User;
use Illuminate\Support\Str;

beforeEach(function () {
    $this->adminUser = User::factory()->create(['role' => UserRole::ADMIN]);
    $this->editorUser = User::factory()->create(['role' => UserRole::EDITOR]);

    $this->travel = Travel::factory()->has(Tour::factory()->count(10))->create();
    $this->mockTravel = [
        'name' => 'Lorem Ipsum',
        'description' => 'Dolor sit amet',
        'numberOfDays' => rand(0, 100),
        'nature' => rand(0, 100),
        'relax' => rand(0, 100),
        'history' => rand(0, 100),
        'culture' => rand(0, 100),
        'party' => rand(0, 100),
    ];
    $this->mockTour = [
        'name' => 'Lorem Ipsum',
        'startingDate' => '2030-01-01',
        'endingDate' => '2030-01-02',
        'price' => '12345',
    ];

    $this->updatedMockTour = [
        'name' => 'Dolor sit amet',
        'startingDate' => '2031-01-01',
        'endingDate' => '2031-01-02',
        'price' => '123456789',
    ];
    $this->updateMockTravel = [
        'name' => 'Lorem Ipsum Dolor sit amet',
        'description' => 'New simple description',
        'numberOfDays' => rand(0, 100),
        'nature' => rand(0, 100),
        'relax' => rand(0, 100),
        'history' => rand(0, 100),
        'culture' => rand(0, 100),
        'party' => rand(0, 100),
    ];
});

test('unauthenticated user can not access travels.create')
    ->get('/travels/create')->assertStatus(302)->assertRedirect('login');

test('unauthenticated user can not access tours.create', function () {
    $this->get('/travels/'.$this->travel->slug.'/tours/create')->assertStatus(302)->assertRedirect('login');
});

test('unauthenticated user can not access tours.edit', function () {
    $tour = $this->travel->tours[0];
    $this->get('/tours/'.$tour.'/edit')->assertStatus(302)->assertRedirect('login');
});

test('unauthenticated user can not access travels.edit', function () {
    $this->get('/tours/'.$this->travel->slug.'/edit')->assertStatus(302)->assertRedirect('login');
});

test('admin user can not access travels.edit', function () {
    $this->actingAs($this->adminUser)->get('/travels/'.$this->travel->slug.'/edit')->assertStatus(403);
});

test('login access redirect to dashboard', function () {
    $this->post('/login', [
        'email' => $this->adminUser->email,
        'password' => 'password',
    ])->assertStatus(302)->assertRedirect('/');
});

test('admin user can access travels.create', function () {
    $this->actingAs($this->adminUser)->get('/travels/create')->assertStatus(200);
});

test('editor user can not access travels.create', function () {
    $this->actingAs($this->editorUser)->get('/travels/create')->assertStatus(403);
});

test('editor user can not access tours.create', function () {
    $this->actingAs($this->editorUser)->get('/travels/'.$this->travel->slug.'/tours/create')->assertStatus(403);
});

test('editor user can not access tours.edit', function () {
    $tour = $this->travel->tours[0];

    $this->actingAs($this->editorUser)->get('/tours/'.$tour->id.'/edit/')->assertStatus(403);
});

test('editor user can access travels.edit', function () {
    $this->actingAs($this->editorUser)->get('/travels/'.$this->travel->slug.'/edit/')->assertStatus(200);
});

test('admin user can invoke the POST travel.store method and will be redirect to dashboard', function () {
    $this->actingAs($this->adminUser)->post('/travels', $this->mockTravel)->assertStatus(302)->assertRedirect('/');
});

test('unauthenticated user can not invoke the POST travel.store method and will be redirect to login', function () {
    $this->post('/travels', $this->mockTravel)->assertStatus(302)->assertRedirect('/login');
});

test('editor user can not invoke the POST travel.store method and will be unauthorized', function () {
    $this->actingAs($this->editorUser)->post('/travels', $this->mockTravel)->assertStatus(403);
});

test('admin user can invoke the POST tours.store method and will be redirect to travel.show', function () {
    $this->actingAs($this->adminUser)
        ->post('/travels/'.$this->travel->id.'/tours', $this->mockTour)
        ->assertStatus(302)->assertRedirect('/travels/'.$this->travel->slug);
});

test('unauthenticated user can not invoke the POST tours.store method and will redirect to login', function () {
    $this->post('/travels/'.$this->travel->id.'/tours', $this->mockTour)
        ->assertStatus(302)->assertRedirect('/login');
});

test('editor user can not invoke the POST tours.store method and will receive 403', function () {
    $this->actingAs($this->editorUser)
        ->post('/travels/'.$this->travel->id.'/tours', $this->mockTour)
        ->assertStatus(403);
});

test('admin user can invoke the DELETE travels.destory method and will be redirect to dashboard', function () {
    $newTravel = Travel::factory()->create();
    $this->actingAs($this->adminUser)->delete('/travels/'.$newTravel->id)
        ->assertStatus(302)->assertRedirect('/');
});

test('unauthenticated user can not invoke the DELETE travels.destory method and will be redirect to login', function () {
    $newTravel = Travel::factory()->create();

    $this->delete('/travels/'.$newTravel->id)
        ->assertStatus(302)->assertRedirect('/login');
});

test('editor user can not invoke the DELETE travels.destory method and will be unauthorized', function () {
    $newTravel = Travel::factory()->create();

    $this->actingAs($this->editorUser)->delete('/travels/'.$newTravel->id)
        ->assertStatus(403);
});

test('admin user can invoke the PUT tours.update method and will be redirect to travels.show', function () {
    $tour = $this->travel->tours[0];

    $this->actingAs($this->adminUser)->put('/tours/'.$tour->id, $this->updatedMockTour)
        ->assertStatus(302)->assertRedirect('/travels/'.$this->travel->slug);
});

test('editor user can not invoke the PUT tours.update method and will receive 403', function () {
    $tour = $this->travel->tours[0];

    $this->actingAs($this->editorUser)->put('/tours/'.$tour->id, $this->updatedMockTour)
        ->assertStatus(403);
});

test('unauthenticated user can not invoke the PUT tours.update method and will be redirect to login', function () {
    $tour = $this->travel->tours[0];

    $this->put('/tours/'.$tour->id, $this->updatedMockTour)
        ->assertStatus(302)->assertRedirect('/login');
});

test('editor user can invoke the PUT travels.update method and will be redirect to travels.show using the new slug', function () {
    $slug = Str::slug($this->updateMockTravel['name']);
    $this->actingAs($this->editorUser)->put('/travels/'.$this->travel->id, $this->updateMockTravel)
        ->assertStatus(302)->assertRedirect('/travels/'.$slug);
});

test('admin user can not invoke the PUT travels.update method and will receive 403', function () {
    $this->actingAs($this->adminUser)->put('/travels/'.$this->travel->id, $this->updateMockTravel)
        ->assertStatus(403);
});

test('unauthenticated user can not invoke the PUT travels.update method and will be redirect to login', function () {
    $this->put('/travels/'.$this->travel->id, $this->updateMockTravel)
        ->assertStatus(302)->assertRedirect('/login');
});
