<?php

namespace Modules\Admin\Services;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Modules\Admin\Models\Role;

class RoleService
{
    /**
     * Деталка роли
     * @param Role $role
     * @return mixed
     */
    public function getRole(Role $role)
    {
        return $role->load(['permissions:id,name,russian_name'])->loadCount('users')->only(['id','name','russian_name','permissions','users_count']);
    }

    /**
     * Изменение роли
     * @param Role $role
     * @param array $roleAttributes
     * @param array $permissions
     * @return true[]
     */
    public function updateRole(Role $role, array $roleAttributes, array $permissions)
    {
        $role->update($roleAttributes);
        $role->permissions()->sync($permissions);

        return ['success' => true];

    }

    /**
     * Удаление роли
     * @param Role $role
     * @return true[]
     */
    public function deleteRole(Role $role)
    {
        $role->delete();

        return ['success' => true];
    }

    /**
     * Список ролей
     * @param string|null $name
     * @param $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator|Role[]|\Spatie\Permission\Models\Role[]
     */
    public function getRoles(string $name=null,$perPage=15)
    {
        return Role::query()
            ->when(isset($name), function (Builder $q) use ($name) {
                $q->where('russian_name', 'like', '%' . $name . '%');
            })
            ->where('id', '>', 1)
            ->select([
                'id',
                'name',
                'russian_name',
            ])
            ->withCount([
                'users',
            ])
            ->paginate($perPage);
    }

    /**
     * Создание роли
     * @param array $roleAttributes
     * @param array $permissions
     * @return true[]
     */
    public function createRole(array $roleAttributes, array $permissions)
    {
        $roleAttributes['guard_name'] = 'web';
        $role = Role::query()->create($roleAttributes);
        $role->permissions()->sync($permissions);
        return ['success' => true];
    }
}
