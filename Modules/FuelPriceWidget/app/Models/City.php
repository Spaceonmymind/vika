<?php

namespace Modules\FuelPriceWidget\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class City
 *
 * @property int $id
 * @property string|null $name
 *
 * @property Collection|GasStation[] $gas_stations
 *
 * @package App\Models
 */
class City extends Model
{
    protected $table = 'fuel_price_widget_cities';
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function gas_stations(): HasMany
    {
        return $this->hasMany(GasStation::class, 'city_id');
    }

    public function od_dataset(): HasMany
    {
        return $this->hasMany(OdDataset::class, 'city_id');
    }
}
