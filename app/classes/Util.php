<?php
class Util
{
    public static function getCurrentTimeMillis()
    {
        return round(microtime(true)*1000); //sec mei convert k liye *1000
    }

    public static function dd($dump)
    {
        die(var_dump($dump));
    }
}