<?php

namespace Modules\FuelPriceWidget\Models;

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
 * @property Carbon|null $last_update
 * @property string|null $description
 * @property bool $need_update
 * @property bool $is_active
 * @property string|null $current_hash
 * @property int $city_id
 *
 * @package App\Models
 */
class OdDataset extends Model
{
    protected $table = 'fuel_price_widget_od_datasets';
    public $timestamps = false;

    protected $fillable = [
        'url',
        'data_type',
        'class_handler',
        'last_update',
        'description',
        'need_update',
        'is_active',
        'current_hash',
        'city_id',
    ];

    protected $casts = [
        'last_update' => 'datetime',
        'need_update' => 'bool',
        'is_active' => 'bool',
        'city_id' => 'int',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
