<?php
class Hash
{
    public static function make(string $plainText):string
    {
        return password_hash($plainText, PASSWORD_BCRYPT,['cost'=>10]);
    }

    public static function verify (string $plainText, string $hashedpassword):string
    {
        return password_verify($plainText, $hashedpassword);
    }

    public static function hash(int $userId)
    {
        return hash('sha256', $userId . Util::getCurrentTimeMillis() . strrev($userId) . rand());
    }
}