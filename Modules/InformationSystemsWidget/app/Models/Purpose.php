<?php

namespace Modules\InformationSystemsWidget\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class OdDataset
 *
 * @property int $id
 * @property string $name
 *
 * @package App\Models
 */
class Purpose extends Model
{
    protected $table = 'information_systems_widget_purposes';
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function info_systems(): BelongsToMany
    {
        return $this->belongsToMany(InformationSystem::class,
            'information_systems_widget_information_system_purpose',
            'purpose_id',
            'system_id'
        );
    }
}
