<?php

namespace Modules\FuelPriceWidget\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class GasStation
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $company_name
 * @property string|null $address
 * @property float|null $latitude
 * @property float|null $longitude
 * @property int $city_id
 * @property int $od_api_id
 *
 * @property City $city
 * @property Collection|FuelPrice[] $fuel_prices
 *
 * @package App\Models
 */
class GasStation extends Model
{
    protected $table = 'fuel_price_widget_gas_stations';
    public $timestamps = true;
    const UPDATED_AT = null;

    protected $fillable = [
        'name',
        'company_name',
        'address',
        'latitude',
        'longitude',
        'od_api_id',
        'city_id',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'created_at' => 'datetime:d.m.Y H:i:s'
    ];

    public function od_dataset(): HasOne
    {
        return $this->hasOne(OdDataset::class, 'id', 'od_api_id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function fuel_prices(): HasMany
    {
        return $this->hasMany(FuelPrice::class, 'gas_station_id');
    }
}
