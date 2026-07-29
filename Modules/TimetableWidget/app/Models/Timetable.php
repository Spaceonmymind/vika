<?php

namespace Modules\TimetableWidget\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;
use Modules\TimetableWidget\Models\Base\Timetable as BaseTimetable;

class Timetable extends BaseTimetable
{
    protected $fillable = [
        'year',
        'month',
        'day',
        'status',
        'employee_global_id',
    ];

    public function date():Attribute
    {
        return Attribute::make(
            get: fn() => Carbon::create($this->year, $this->month, $this->day)->format('d.m.Y'),
        );
    }
}
