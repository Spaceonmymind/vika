<?php

namespace Modules\SportSectionsWidget\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class OdDataset
 *
 * @property int $id
 * @property int $organisation_id
 * @property int $sport_id
 * @property int $city_id
 * @property string $street
 * @property string $house
 * @property int $trainer_id
 * @property int $age_min
 * @property int $age_max
 * @property int $schedule_id
 * @property int $municipality_id
 *
 * @package App\Models
 */
class Section extends Model
{
    protected $table = 'sport_sections_widget_sport_sections';
    public $timestamps = false;

    protected $fillable = [
        'organisation_id',
        'sport_id',
        'city_id',
        'street',
        'house',
        'trainer_id',
        'age_min',
        'age_max',
        'schedule_id',
        'municipality_id',
    ];

    protected $casts = [
        'organization_id' => 'int',
        'sport_id' => 'int',
        'city_id' => 'int',
        'age_min' => 'int',
        'age_max' => 'int',
        'trainer_id' => 'int',
        'schedule_id' => 'int',
        'municipality_id' => 'int',
    ];

    public function organisation(): BelongsTo
    {
        return $this->belongsTo(Organisation::class, 'organisation_id');
    }

    public function sport(): BelongsTo
    {
        return $this->belongsTo(Sport::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function trainer(): BelongsTo
    {
        return $this->belongsTo(Trainer::class);
    }

    public function schedule(): HasOne
    {
        return $this->hasOne(Schedule::class, 'section_id', 'id');
    }

    public function municipality(): BelongsTo
    {
        return $this->belongsTo(Municipality::class);
    }
}
