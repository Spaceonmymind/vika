<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\TimetableWidget\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\TimetableWidget\Models\Employee;

/**
 * Class Timetable
 *
 * @property int $id
 * @property int $month
 * @property int $day
 * @property string|null $status
 * @property string $employee_global_id
 *
 * @property \Modules\TimetableWidget\Models\Base\Employee $employee
 *
 * @package App\Models\Base
 */
class Timetable extends Model
{
    protected $table = 'timetable_widget_timetables';
    public $timestamps = false;

    protected $casts = [
        'month' => 'int',
        'day' => 'int'
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_global_id', 'global_id');
    }
}
