<?php

namespace Modules\SportSectionsWidget\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class OdDataset
 *
 * @property int $id
 * @property string $name
 *
 * @package App\Models
 */
class City extends Model
{
    protected $table = 'sport_sections_widget_cities';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'municipality_id',
    ];

    protected $casts = [
        'name' => 'string',
    ];

    public function organisations(): HasMany
    {
        return $this->hasMany(Organisation::class, 'city_id');
    }

    public function municipality(): BelongsTo
    {
        return $this->belongsTo(Municipality::class, 'municipality_id');
    }
}
