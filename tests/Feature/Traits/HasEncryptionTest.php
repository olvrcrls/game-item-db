<?php

use App\Models\User;

it('encrypts the assigned encryptable attribute passed to the model', function () {
    $user = new User();
    $raw = 'secret@mail.com';
    
    $user->email = $raw;

    expect($user->getRawOriginal('email'))
        ->not->toBe('secret@mail.com');
        
});

it('does not encrypt username attribute passed to the model', function () {
    $user = new User();
    $raw = 'username';

    $user->username = $raw;

    expect($user)
        ->username->toBe($raw);
});

it('decrypts the encrypted attribute', function () {
    $user = new User();
    $raw = 'secret@mail.com';

    $user->email = $raw;
    
    expect($user)->email->toBe($raw);
});