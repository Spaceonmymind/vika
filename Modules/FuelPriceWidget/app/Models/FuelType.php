<?php

namespace Modules\FuelPriceWidget\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class FuelType
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $code
 *
 * @property Collection|FuelPrice[] $fuel_prices
 *
 * @package App\Models
 */
class FuelType extends Model
{
    protected $table = 'fuel_price_widget_fuel_types';
    public $timestamps = false;


    protected $fillable = [
        'name',
        'code'
    ];

    public function fuel_prices(): HasMany
    {
        return $this->hasMany(FuelPrice::class, 'fuel_type_id');
    }
}
