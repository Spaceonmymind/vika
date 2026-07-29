<?php

namespace Modules\InformationSystemsWidget\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class OdDataset
 *
 * @property int $id
 * @property string $name
 *
 * @package App\Models
 */
class Owner extends Model
{
    protected $table = 'information_systems_widget_owners';
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function info_systems(): BelongsTo
    {
        return $this->belongsTo(InformationSystem::class);
    }
}
