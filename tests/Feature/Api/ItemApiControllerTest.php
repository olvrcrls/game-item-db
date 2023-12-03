<?php

use App\Models\{Game, Item};

beforeEach(fn() => Item::factory()
    ->for(Game::factory())
    ->create([
        'uuid' => 'test-item',
        'name' => 'Test',
        'description' => 'test description',
    ])

);

it('should return a list of items', function () {
    $this->getJson('/api/items')
        ->assertOk()
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'uuid',
                    'name',
                    'description',
                    'image',
                    'attributes',
                    'type',
                    'rarity',
                    'level',
                    'deprecated',
                    'game',
                ]
            ]
        ]);
});

it('should return a single item', function () {
    $this->getJson('/api/items/test-item')
        ->assertOk()
        ->assertJsonStructure([
            'data' => [
                    'uuid',
                    'name',
                    'description'
            ]
        ]);
});

it('should return a 404 if the item does not exist', function () {
    $this->getJson('/api/items/does-not-exist')
        ->assertNotFound();
});

it('should create a new item', function () {
    $this->postJson('/api/items', [
        'uuid' => 'test',
        'name' => 'New Item',
        'description' => 'New Item Description',
        'game_id' => (string)Game::first()->id
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
                'name' => 'New Item',
                'description' => 'New Item Description'
            ]
        ]);
});

it('should update an existing item', function () {
    $this->putJson('/api/items/test-item', [
        'name' => 'Updated Item',
        'description' => 'Updated Item Description'
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
                'uuid' => 'test-item',
                'name' => 'Updated Item',
                'description' => 'Updated Item Description'
            ]
        ]);
});

it('should delete an existing item', function () {
    $this->deleteJson('/api/items/test-item')
        ->assertOk()
        ->assertJson([
            'message' => 'Item deleted successfully'
        ]);
});

it('should return a 404 if the item does not exist when updating', function () {
    $this->putJson('/api/items/does-not-exist', [
        'name' => 'Updated Item',
        'description' => 'Updated Item Description'
    ])
        ->assertNotFound();
});

it('should return a 404 if the item does not exist when deleting', function () {
    $this->deleteJson('/api/items/does-not-exist')
        ->assertNotFound();
});

it('should return a 422 if the item already exists when creating', function () {
    $this->postJson('/api/items', [
        'name' => 'Test',
        'description' => 'New Item Description'
    ])
    ->assertStatus(422);
});

it('should return a 422 if the item already exists when updating', function () {
    Item::factory()->create([
        'uuid' => 'test-item-2',
        'name' => 'Test 2',
        'description' => 'test description 2'
    ]);

    $this->putJson('/api/items/test-item', [
        'name' => 'Test 2',
        'description' => 'New Item Description'
    ])
    ->assertStatus(422);
});

it('should return a 422 if the game id is not existing when updating an item', function () {
    $this->putJson('/api/items/test-item', [
        'game_id' => '12345'
    ])
    ->assertStatus(422);
});