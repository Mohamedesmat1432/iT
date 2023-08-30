<?php

namespace App\Helpers;

use Carbon\Carbon;

class Helper
{

    public static function countDays($end, $start)
    {
        return Carbon::parse($end)->diffInDays(Carbon::parse($start));
    }
}
