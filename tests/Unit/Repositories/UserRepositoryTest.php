<?php

test('it returns a new User model', function () {
    $repository = new \App\Repositories\UserRepository();
    $model = $repository->getModel();
    expect($model)->toBeInstanceOf(\App\Models\User::class);
});

test('it creates a User model record', function () {
    $repository = new \App\Repositories\UserRepository();
    $model = $repository->getModel();
    expect($model)->toBeInstanceOf(\App\Models\User::class);
    $user = $model->factory()->create();
    $this->assertDatabaseHas('users', ['id' => $user->id]);
});

test('it creates and finds a User model record', function () {
    $repository = new \App\Repositories\UserRepository();
    $model = $repository->getModel();
    expect($model)->toBeInstanceOf(\App\Models\User::class);
    $user = $model->factory()->create();
    $this->assertDatabaseHas('users', ['id' => $user->id]);
    $foundUser = $repository->find($user->id);
    expect($foundUser)->toBeInstanceOf(\App\Models\User::class);
    expect($foundUser->id)->toEqual($user->id);
});

test('it creates and updates a User model record', function () {
    $repository = new \App\Repositories\UserRepository();
    $model = $repository->getModel();
    expect($model)->toBeInstanceOf(\App\Models\User::class);
    $user = $model->factory()->create();
    $this->assertDatabaseHas('users', ['id' => $user->id]);
    $updatedUser = $repository->update($user->id, ['username' => 'new_username']);
    expect($updatedUser)->toBeInstanceOf(\App\Models\User::class);
    expect($updatedUser->id)->toEqual($user->id);
    expect($updatedUser->username)->toEqual('new_username'); 
});

test('it creates and deletes a User model record', function () {
    $repository = new \App\Repositories\UserRepository();
    $model = $repository->getModel();
    expect($model)->toBeInstanceOf(\App\Models\User::class);
    $user = $model->factory()->create();
    $this->assertDatabaseHas('users', ['id' => $user->id]);
    $isDeleted = $repository->delete($user->id);
    expect($isDeleted)->toBeTrue();
});