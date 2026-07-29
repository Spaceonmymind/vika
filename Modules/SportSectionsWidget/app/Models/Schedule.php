<?php

namespace Modules\SportSectionsWidget\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OdDataset
 *
 * @property int $id
 * @property int $section_id
 * @property string $monday
 * @property string $tuesday
 * @property string $wednesday
 * @property string $thursday
 * @property string $friday
 * @property string $saturday
 * @property string $sunday
 *
 * @package App\Models
 */
class Schedule extends Model
{
    protected $table = 'sport_sections_widget_sections_schedules';
    public $timestamps = false;

    protected $fillable = [
        'section_id',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
    ];

    public function section()
    {
        return $this->hasOne(Section::class, 'id', 'schedule_id');
    }
}
