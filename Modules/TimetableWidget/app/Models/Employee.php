<?php

namespace Modules\TimetableWidget\Models;

use Modules\TimetableWidget\Models\Base\Employee as BaseEmployee;

class Employee extends BaseEmployee
{
    protected $fillable = [
        'organization_id',
        'global_id',
        'post',
        'name',
    ];
}
