<?php

namespace Modules\InformationSystemsWidget\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


/**
 * Class InformationSystem
 *
 * @property int $id
 * @property string $unique_number
 * @property string $full_name
 * @property string $short_name
 * @property string $targets
 * @property string $purposes
 * @property int $owner_id
 * @property string $subsystems
 * @property string $state_info_sys
 * @property string $operator_id
 * @property string $url
 *
 * @package App\Models
 */
class InformationSystem extends Model
{
    protected $table = 'information_systems_widget_information_systems';
    public $timestamps = false;

    protected $fillable = [
        'unique_number',
        'full_name',
        'short_name',
        'targets',
        'purposes',
        'owner_id',
        'subsystems',
        'state_info_sys',
        'operator_id',
        'url',
    ];

    public function purposes(): BelongsToMany
    {
        return $this->belongsToMany(Purpose::class,
            'information_systems_widget_information_system_purpose',
            'system_id',
            'purpose_id',
        );
    }

    public function subsystems(): BelongsToMany
    {
        return $this->belongsToMany(SubSystem::class,
            'information_systems_widget_information_system_subsystem',
            'system_id',
            'subsystem_id',
        );
    }

    public function owner(): HasOne
    {
        return $this->hasOne(Owner::class, 'id', 'owner_id');
    }

    public function operator(): HasOne
    {
        return $this->hasOne(Operator::class, 'id', 'operator_id');
    }
}
