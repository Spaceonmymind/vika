<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\PermissionRegistrar;

class Role extends \Spatie\Permission\Models\Role {
    public  $fillable=[
        'name',
        'russian_name',
        'guard_name',
    ];

    public $attributes=[
        'guard_name' => 'web'
    ];
    public function users(): BelongsToMany
    {
        return $this->morphedByMany(
            User::class,
            'model',
            config('permission.table_names.model_has_roles'),
            app(PermissionRegistrar::class)->pivotRole,
            config('permission.column_names.model_morph_key')
        );
    }
}
