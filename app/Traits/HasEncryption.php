<?php

namespace App\Traits;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Throwable;

trait HasEncryption
{
    /**
     * Encrypts the given value
     * if it is in the encryptable array.
     * 
     * @return void
     */
    public function setAttribute($key, $value): void
    {
        parent::setAttribute($key, $value);
        $attribute = parent::getAttribute($key);
        $this->attributes[$key] = (in_array($key, $this->encryptable)) ? 
                                Crypt::encryptString($attribute) : 
                                $attribute;
    }

    /**
     * Decrypts the given value
     * if it is in the encryptable array.
     * 
     * @return mixed
     * @throws DecryptException|Throwable
     */
    public function getAttribute($key): mixed
    {
        $attribute = parent::getAttribute($key);
        try {
            return (in_array($key, $this->encryptable)) ? 
                    Crypt::decryptString($attribute) 
                    : $attribute;
        } catch (DecryptException|Throwable $e) {
            Log::error(
                __CLASS__ . '@' . __FUNCTION__ .
                ' :' . $e->getMessage(),
                compact('key')
            );
            return $attribute;
        }
    }
}