<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Modules\Admin\Models\Role;
use Modules\Admin\Services\RoleService;
use Modules\Admin\Swagger\Docs\Attributes\RoleController\CreateRole;
use Modules\Admin\Swagger\Docs\Attributes\RoleController\DeleteRole;
use Modules\Admin\Swagger\Docs\Attributes\RoleController\GetRole;
use Modules\Admin\Swagger\Docs\Attributes\RoleController\GetRoles;
use Modules\Admin\Swagger\Docs\Attributes\RoleController\UpdateRole;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'RoleController', description: 'Всё связанное с ролями')]
class RoleController extends Controller
{
    private RoleService $roleService;

    /**
     * @param RoleService $roleService
     */
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
        Context::add('module', 'Admin');

    }

    #[GetRole]
    public function getRole(Role $role, Request $request)
    {
        return $this->roleService->getRole($role);
    }

    #[UpdateRole]
    public function updateRole(Role $role, Request $request)
    {
        $validated = $request->validate([
            'name' => 'sometimes',
            'russian_name' => 'sometimes',
            'permissions' => 'required|array',
        ]);
        return $this->roleService->updateRole($role, $validated, $validated['permissions']);
    }

    #[DeleteRole]
    public function deleteRole(Role $role, Request $request)
    {
        return $this->roleService->deleteRole($role);
    }

    #[GetRoles]
    public function getRoles(Request $request)
    {
        $validated = $request->validate([
            'name' => 'sometimes|nullable|string',
            'per_page' => 'sometimes|nullable|integer',
        ]);
        return $this->roleService->getRoles($validated['name'] ?? null, $validated['per_page'] ?? 15);
    }

    #[CreateRole]
    public function createRole(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:roles,name',
            'russian_name' => 'required',
            'permissions' => 'required|array',
        ]);
        return $this->roleService->createRole($validated, $validated['permissions']);
    }
}
