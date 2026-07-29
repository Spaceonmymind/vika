<?php

namespace Modules\InformationSystemsWidget\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class OdDataset
 *
 * @property int $id
 * @property string $name
 * @property string $site
 * @property string $helpdesk
 *
 * @package App\Models
 */
class SubSystem extends Model
{
    protected $table = 'information_systems_widget_subsystems';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'site',
        'helpdesk',
    ];

    public function info_systems(): BelongsToMany
    {
        return $this->belongsToMany(InformationSystem::class,
            'information_systems_widget_information_system_subsystem',
            'subsystem_id',
            'system_id'
        );
    }
}
