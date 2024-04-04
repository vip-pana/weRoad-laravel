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

test('unauthenticated user can not access travels.create')
    ->get('/travels/create')->assertStatus(302)->assertRedirect('login');

test('unauthenticated user can not access tours.create', function () {
    $this->get('/travels/' . $this->travel->slug . '/tours/create')->assertStatus(302)->assertRedirect('login');
});

test('unauthenticated user can not access tours.edit', function () {
    $tour = $this->travel->tours[0];
    $this->get('/tours/' . $tour . '/edit')->assertStatus(302)->assertRedirect('login');
});

test('unauthenticated user can not access travels.edit', function () {
    $this->get('/tours/' . $this->travel->slug . '/edit')->assertStatus(302)->assertRedirect('login');
});

test('admin user can not access travels.edit', function () {
    $this->actingAs($this->adminUser)->get('/travels/' . $this->travel->slug . '/edit')
        ->assertStatus(403);
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
