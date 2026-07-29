<?php

namespace Modules\Admin\Services;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\Models\Role;
use Modules\Admin\Models\User;
use Spatie\Permission\Models\Permission;

class AdminUserService
{
    /**
     * Создание пользователя
     * @param $userAttributes
     * @param $personAttributes
     * @return true[]
     */
    public function createUser($userAttributes, $personAttributes)
    {
        $userAttributes['password'] = Hash::make($userAttributes['password']);
        $user = User::query()->create($userAttributes);
        $user->roles()->sync($userAttributes['roles']);
        $user->permissions()->sync($userAttributes['permissions']);
        $user->person()->create($personAttributes);

        return ['success' => true];
    }

    /**
     * Справочник ролей
     * @return \Illuminate\Database\Eloquent\Collection|Role[]
     */
    public function getRoles()
    {
        return Role::query()
            ->select(['id', 'name', 'russian_name'])
            ->get();
    }

    /**
     * Справочник пермишенов
     * @param $roles
     * @return array|Collection
     */
    public function getPermissions($roles = [], $withoutGrouping = false)
    {
        if ($withoutGrouping) {

            return Permission::query()
                ->select([
                    'id',
                    'name',
                    'russian_name',
                ])
                ->get();

        }

        return [

            'permissions_in_roles' => Permission::query()
                ->select([
                    'id',
                    'name',
                    'russian_name',
                ])
                ->whereHas('roles', function (Builder $q) use ($roles) {
                    $q->whereIn('id', $roles);
                })
                ->get(),

            'permissions_not_in_roles' => Permission::query()
                ->select([
                    'id',
                    'name',
                    'russian_name',
                ])
                ->whereDoesntHave('roles', function (Builder $q) use ($roles) {
                    $q->whereIn('id', $roles);
                })
                ->get(),
        ];
    }

    /**
     * Изменение данных пользователя
     * @param $userAttributes
     * @param $personAttributes
     * @param User $user
     * @return true[]
     */
    public function updateUser($userAttributes, $personAttributes, User $user)
    {
        $user->update($userAttributes);

        if (isset($userAttributes['roles'])) {
            $user->roles()->sync($userAttributes['roles']);
        }

        if (isset($userAttributes['permissions'])) {
            $user->permissions()->sync($userAttributes['permissions']);
        }

        $user->person()->updateOrCreate([], $personAttributes);

        return ['success' => true];
    }

    /**
     * Возвращает список пользователей системы
     * @param string|null $query
     * @param array $roles
     * @param array $permissions
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getUsers($query = null, array $roles = [], array $permissions = [], int $perPage = 15): LengthAwarePaginator
    {
        return User::query()
            ->with([
                'roles:id,name,russian_name',
                'permissions:id,name,russian_name',
                'person',
            ])
            ->where('id', '!=', 1)
            ->when(isset($query), function (Builder $q) use ($query) {
                $q
                    ->whereHas('person', function (Builder $q) use ($query) {
                        $q->where(DB::raw("CONCAT( UPPER( last_name) ,' ', UPPER(first_name), ' ' ,UPPER(middle_name))"), 'like', '%' . $query . '%');
                    })
                    ->orWhere('email', 'like', '%' . $query . '%');
            })
            ->when(!empty($roles), function (Builder $q) use ($roles) {
                $q->whereHas('roles', function (Builder $q) use ($roles) {
                    $q->whereIn('id', $roles);
                });
            })
            ->when(!empty($permissions), function (Builder $q) use ($permissions) {
                $q->where(function (Builder $q) use ($permissions) {
                    $q
                        ->whereHas('roles', function (Builder $q) use ($permissions) {
                            $q->whereHas('permissions', function (Builder $q) use ($permissions) {
                                $q->whereIn('id', $permissions);
                            });
                        })
                        ->orWhereHas('permissions', function (Builder $q) use ($permissions) {
                            $q->whereIn('id', $permissions);
                        });
                });

            })
            ->paginate($perPage);
    }

    /**
     * Детальная информация пользователя
     * @param User $user
     * @return User
     */
    public function getDetailUserInformation(User $user): User
    {
        $user->load([
            'roles:id,name,russian_name',
            'person',
            'permissions:id,name,russian_name',
        ]);
        return $user;
    }

    /**
     * Удаление пользователя
     * @param User $user
     * @return true[]
     */
    public function deleteUser(User $user): array
    {
        $user->delete();

        return ['success' => true];
    }


}
