<?php

namespace Modules\SportSectionsWidget\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class OdDataset
 *
 * @property int $id
 * @property string $code
 * @property string $name
 *
 * @package App\Models
 */
class OdDatasetType extends Model
{
    protected $table = 'sport_sections_widget_od_dataset_types';
    public $timestamps = false;

    protected $fillable = [
        'code',
        'name',
    ];

    protected $casts = [
        'code' => 'string',
        'name' => 'string',
    ];

    public function datasets(): HasMany
    {
        return $this->hasMany(OdDataset::class, 'dataset_type_id');
    }
}
