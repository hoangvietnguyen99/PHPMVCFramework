<?php


namespace app\utils;


final class StringUtil
{
    public static function removeSpecialDoubleQuote(string $data)
    {
        return str_replace('&#34;', '"', $data);
    }
}