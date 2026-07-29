<?php

namespace Modules\FuelPriceWidget\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class FuelTypes
 *
 * @property int $id
 * @property int $gas_station_id
 * @property int $fuel_type_id
 * @property float|null $price
 *
 * @property FuelType $fuel_type
 * @property GasStation $gas_station
 *
 * @package App\Models
 */
class FuelPrice extends Model
{
    protected $table = 'fuel_price_widget_fuel_prices';
    public $timestamps = false;

    protected $fillable = [
        'gas_station_id',
        'fuel_type_id',
        'price'
    ];

    protected $casts = [
        'gas_station_id' => 'int',
        'fuel_type_id' => 'int',
        'price' => 'decimal:2'
    ];

    public function fuel_type(): BelongsTo
    {
        return $this->belongsTo(FuelType::class, 'fuel_type_id');
    }

    public function gas_station(): BelongsTo
    {
        return $this->belongsTo(GasStation::class, 'gas_station_id');
    }
}
