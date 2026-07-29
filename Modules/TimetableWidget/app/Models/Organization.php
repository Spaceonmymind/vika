<?php

namespace Modules\TimetableWidget\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    protected $table = 'timetable_widget_organizations';

    protected $fillable = [
        'name',
        'timesheet_name',
        'global_id'
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'organization_id', 'id');
    }
}
