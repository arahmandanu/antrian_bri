<?php

namespace App\Http\Traits;

use Carbon\Carbon;

trait AbstractTrait
{
    public function formatDateRangePicker($dateRange)
    {
        $formatDate = explode('/', $dateRange);

        return [
            'from' => Carbon::parse($formatDate[0]),
            'to' => Carbon::parse($formatDate[1]),
        ];
    }
}
