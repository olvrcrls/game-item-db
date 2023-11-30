<?php

use App\Models\Game;

beforeEach(fn() => Game::factory()->create([
    'uuid' => 'test-game',
    'name' => 'Test',
    'description' => 'test description'
]));

it('should return a list of games', function () {
    $this->getJson('/api/games')
        ->assertOk()
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'uuid',
                    'name',
                    'description'
                ]
            ]
        ]);
});

it('should return a single game', function () {
    $this->getJson('/api/games/test-game')
        ->assertOk()
        ->assertJsonStructure([
            'data' => [
                    'uuid',
                    'name',
                    'description'
            ]
        ]);
});

it('should return a 404 if the game does not exist', function () {
    $this->getJson('/api/games/does-not-exist')
        ->assertNotFound();
});

it('should create a new game', function () {
    $this->postJson('/api/games', [
        'uuid' => 'test',
        'name' => 'New Game',
        'description' => 'New Game Description'
    ])
        ->assertCreated()
        ->assertJsonStructure([
            'data' => [
                'uuid',
                'name',
                'description'
            ]
        ])
        ->assertJson([
            'data' => [
                'uuid' => 'test',
                'name' => 'New Game',
                'description' => 'New Game Description'
            ]
        ]);
});

it('should update an existing game', function () {
    $this->putJson('/api/games/test-game', [
        'name' => 'Updated Game',
        'description' => 'Updated Game Description'
    ])
        ->assertOk()
        ->assertJsonStructure([
            'data' => [
                'uuid',
                'name',
                'description'
            ]
        ])
        ->assertJson([
            'data' => [
                'uuid' => 'test-game',
                'name' => 'Updated Game',
                'description' => 'Updated Game Description'
            ]
        ]);
});

it('should delete an existing game', function () {
    $this->deleteJson('/api/games/test-game')
        ->assertOk()
        ->assertJson([
            'message' => 'Game deleted successfully'
        ]);
});

it('should return a 404 if the game does not exist when updating', function () {
    $this->putJson('/api/games/does-not-exist', [
        'name' => 'Updated Game',
        'description' => 'Updated Game Description'
    ])
        ->assertNotFound();
});

it('should return a 404 if the game does not exist when deleting', function () {
    $this->deleteJson('/api/games/does-not-exist')
        ->assertNotFound();
});

it('should return a 422 if the game already exists when creating', function () {
    $this->postJson('/api/games', [
        'name' => 'Test',
        'description' => 'New Game Description'
    ])
    ->assertStatus(422);
});

it('should return a 422 if the game already exists when updating', function () {
    Game::factory()->create([
        'uuid' => 'test-game-2',
        'name' => 'Test 2',
        'description' => 'test description 2'
    ]);

    $this->putJson('/api/games/test-game', [
        'name' => 'Test 2',
        'description' => 'New Game Description'
    ])
    ->assertStatus(422);
});