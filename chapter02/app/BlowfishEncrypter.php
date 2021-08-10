<?php

declare(strict_types=1);

namespace App;

use phpseclib3\Crypt\Blowfish;
use Illuminate\Contracts\Encryption\Encrypter as EncrypterContract;

class BlowfishEncrypter implements EncrypterContract
{
    protected $encrypter;
    protected $key;

    public function __construct(string $key)
    {
        $this->key = $key;
        $this->encrypter = new Blowfish('ecb');
        $this->encrypter->setKey($this->key);
    }

    public function encrypt($value, $serialize = true)
    {
        return $this->encrypter->encrypt($value);
    }

    public function decrypt($payload, $unserialize = true)
    {
        return $this->encrypter->decrypt($payload);
    }

    public function getKey()
    {
        return $this->key;
    }
}
