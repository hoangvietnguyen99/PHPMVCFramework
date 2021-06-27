<?php


namespace app\utils;


use Carbon\Carbon;
use DateTime;

final class DateTimeUtil
{
    public static function getDiffForHumans(DateTime $dateTime, DateTime $fromDateTime = null)
    {
        if ($fromDateTime) return Carbon::parse($dateTime)->diffForHumans(Carbon::parse($fromDateTime));
        return Carbon::parse($dateTime)->diffForHumans();
    }
}