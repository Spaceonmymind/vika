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
class Sport extends Model
{
    protected $table = 'sport_sections_widget_sports';
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'name' => 'string',
    ];

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class, 'sport_id');
    }
}
