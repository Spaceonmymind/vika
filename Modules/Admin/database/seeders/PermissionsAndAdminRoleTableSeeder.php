<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\PermissionRegistrar;

class PermissionsAndAdminRoleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        if (\DB::table('roles')->where('id', 1)->doesntExist()) {
            \DB::table('roles')->insert([
                0 =>
                    [
                        'id' => 1,
                        'name' => 'superuser',
                        'guard_name' => 'web',
                        'created_at' => '2025-04-07 17:19:49',
                        'updated_at' => '2025-04-07 17:19:49',
                        'russian_name' => 'Супер пользователь',
                    ],
            ]);
        }
        Schema::disableForeignKeyConstraints();

        \DB::table('permissions')->delete();

        \DB::table('role_has_permissions')->where('role_id',1)->delete();

        $permissions = [
            [
                'id' => 1,
                'name' => 'administrate_users',
                'guard_name' => 'web',
                'created_at' => '2025-04-09 14:49:45',
                'updated_at' => '2025-04-09 14:49:45',
                'russian_name' => 'Управление пользователями',
            ],
            [
                'id' => 2,
                'name' => 'administrate_chat',
                'guard_name' => 'web',
                'created_at' => '2025-04-14 17:26:07',
                'updated_at' => '2025-04-14 17:26:07',
                'russian_name' => 'Управление чатом',
            ],
            [
                'id' => 3,
                'name' => 'administrate_roles',
                'guard_name' => 'web',
                'created_at' => '2025-04-15 16:34:16',
                'updated_at' => '2025-04-15 16:34:16',
                'russian_name' => 'Управление ролями',
            ],
            [
                'id' => 4,
                'name' => 'administrate_ai',
                'guard_name' => 'web',
                'created_at' => '2025-04-15 16:34:16',
                'updated_at' => '2025-04-15 16:34:16',
                'russian_name' => 'Управление нейросетями',
            ],
            [
                'id' => 5,
                'name' => 'actirovki',
                'guard_name' => 'web',
                'created_at' => '2025-04-15 16:34:16',
                'updated_at' => '2025-04-15 16:34:16',
                'russian_name' => 'Управление актировками',
            ],
            [
                'id' => 6,
                'name' => 'administrate_vika_types',
                'guard_name' => 'web',
                'created_at' => '2025-04-15 16:34:16',
                'updated_at' => '2025-04-15 16:34:16',
                'russian_name' => 'Управление типами Вики',
            ],
            [
                'id' => 7,
                'name' => 'administrate_widgets',
                'guard_name' => 'web',
                'created_at' => '2025-04-15 16:34:16',
                'updated_at' => '2025-04-15 16:34:16',
                'russian_name' => 'Управление виджетами',
            ],
            [
                'id' => 8,
                'name' => 'administrate_widgets_statistic',
                'guard_name' => 'web',
                'created_at' => '2025-04-15 16:34:16',
                'updated_at' => '2025-04-15 16:34:16',
                'russian_name' => 'Управление статистикой по виджетам',
            ],
            [
                'id' => 9,
                'name' => 'get_intents_statistic',
                'guard_name' => 'web',
                'created_at' => '2025-04-15 16:34:16',
                'updated_at' => '2025-04-15 16:34:16',
                'russian_name' => 'Получение статистики по интентам',
            ],
        ];

        foreach ($permissions as $permission){
            \DB::table('permissions')->insert($permission);
            \DB::table('role_has_permissions')->insert([
               'role_id'=>1,
               'permission_id'=>$permission['id'],
            ]);
        }
        Schema::enableForeignKeyConstraints();

        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
