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
 * @property string $phone
 * @property string $category
 * @property int $municipality_id
 *
 * @package App\Models
 */
class Trainer extends Model
{
    protected $table = 'sport_sections_widget_trainers';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'phone',
        'category',
        'municipality_id',
    ];

    protected $casts = [
        'name' => 'string',
        'municipality_id' => 'int',
    ];

    public function municipality(): BelongsTo
    {
        return $this->belongsTo(Municipality::class, 'municipality_id');
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class, 'trainer_id');
    }
}
