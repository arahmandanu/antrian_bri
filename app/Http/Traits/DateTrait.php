<?php

namespace App\Http\Traits;

trait DateTrait
{
    public function getDateInWeek($dateQuery)
    {
        $range = 6;
        $dates = [];
        $startWeek = $dateQuery->startOfWeek();
        array_push($dates, $startWeek);

        for ($x = 1; $x <= $range; $x++) {
            array_push($dates, $startWeek->copy()->addDays($x));
        }
        return $dates;
    }
}
