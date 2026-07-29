<?php

namespace Modules\SportSectionsWidget\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class OdDataset
 *
 * @property int $id
 * @property string $url
 * @property string $data_type
 * @property string $class_handler
 * @property string|null $description
 * @property bool $need_update
 * @property bool $is_active
 * @property string|null $current_hash
 * @property Carbon|null $last_update
 * @property int $dataset_type_id
 * @property int $municipality_id
 *
 * @package App\Models
 */
class OdDataset extends Model
{
    protected $table = 'sport_sections_widget_od_datasets';
    public $timestamps = false;

    protected $fillable = [
        'url',
        'data_type',
        'class_handler',
        'description',
        'need_update',
        'is_active',
        'current_hash',
        'last_update',
        'dataset_type_id',
        'municipality_id',
    ];

    protected $casts = [
        'last_update' => 'datetime',
        'need_update' => 'bool',
        'is_active' => 'bool',
        'dataset_type_id' => 'int',
        'municipality_id' => 'int',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(OdDatasetType::class, 'dataset_type_id');
    }

    public function municipality(): BelongsTo
    {
        return $this->belongsTo(Municipality::class, 'municipality_id');
    }
}
