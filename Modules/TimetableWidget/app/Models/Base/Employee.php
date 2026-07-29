<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\TimetableWidget\Models\Base;


use Illuminate\Database\Eloquent\Model;
use Modules\TimetableWidget\Models\Organization;
use Modules\TimetableWidget\Models\Timetable;


class Employee extends Model
{
    protected $table = 'timetable_widget_employees';
    public $timestamps = false;

    protected $casts = [
        'organization_id' => 'int'
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function timetables()
    {
        return $this->hasMany(Timetable::class, 'employee_global_id', 'global_id');
    }
}
