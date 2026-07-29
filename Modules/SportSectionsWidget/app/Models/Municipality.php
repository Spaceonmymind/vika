<?php

namespace Modules\SportSectionsWidget\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class OdDataset
 *
 * @property int $id
 * @property string $name
 *
 * @package App\Models
 */
class Municipality extends Model
{
    protected $table = 'sport_sections_widget_municipalities';
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'name' => 'string',
    ];

    public function datasets(): HasMany
    {
        return $this->hasMany(OdDataset::class, 'municipality_id');
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    public function trainers(): HasMany
    {
        return $this->hasMany(Trainer::class);
    }
}
