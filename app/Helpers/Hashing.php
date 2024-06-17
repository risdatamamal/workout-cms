<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Hash;

trait Hashing
{
    public static function makeHash($string)
    {
        return Hash::make($string);
    }

    public static function checkHash($plain, $hash)
    {
        return Hash::check($plain, $hash);
    }

    public static function encode64($string)
    {
        return base64_encode($string);
    }

    public static function decode64($string)
    {
        return base64_decode($string);
    }
}
