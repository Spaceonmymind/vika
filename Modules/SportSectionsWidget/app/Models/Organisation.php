<?php

namespace Modules\SportSectionsWidget\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class OdDataset
 *
 * @property int $id
 * @property string $name
 * @property int $city_id
 * @property string $street
 * @property string $house
 * @property string $inn
 * @property string $site
 * @property string $email
 * @property string $phone
 * @property int $municipality_id
 *
 * @package App\Models
 */
class Organisation extends Model
{
    protected $table = 'sport_sections_widget_organisations';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'city_id',
        'street',
        'house',
        'inn',
        'site',
        'email',
        'phone',
        'municipality_id',
    ];

    protected $casts = [
        'name' => 'string',
        'city_id' => 'int',
        'municipality_id' => 'int',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function municipality(): BelongsTo
    {
        return $this->belongsTo(Municipality::class, 'municipality_id');
    }
}
