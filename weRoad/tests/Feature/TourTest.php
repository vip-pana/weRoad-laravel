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
