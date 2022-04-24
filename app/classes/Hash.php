<?php
class Hash
{
    public static function make(string $plainText):string
    {
        return password_hash($plainText, PASSWORD_BCRYPT,['cost'=>10]);
    }

    public static function verify (string $plainText, string $hashedpassword):string{
        return password_verify($plainText, $hashedpassword);
    }
}