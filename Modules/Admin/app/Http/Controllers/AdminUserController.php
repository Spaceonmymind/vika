<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Context;
use Illuminate\Validation\Rule;
use Modules\Admin\Models\User;
use Modules\Admin\Services\AdminUserService;
use Modules\Admin\Swagger\Docs\Attributes\AdminUserController\CreateUser;
use Modules\Admin\Swagger\Docs\Attributes\AdminUserController\DeleteUser;
use Modules\Admin\Swagger\Docs\Attributes\AdminUserController\GetDetailUserInformation;
use Modules\Admin\Swagger\Docs\Attributes\AdminUserController\GetPermissions;
use Modules\Admin\Swagger\Docs\Attributes\AdminUserController\GetRoles;
use Modules\Admin\Swagger\Docs\Attributes\AdminUserController\GetUsers;
use Modules\Admin\Swagger\Docs\Attributes\AdminUserController\LoginByUser;
use Modules\Admin\Swagger\Docs\Attributes\AdminUserController\LogOutFromUser;
use Modules\Admin\Swagger\Docs\Attributes\AdminUserController\UpdateUser;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'AdminUserController', description: 'Всё связанное с админкой пользователя')]
class AdminUserController extends Controller
{
    private AdminUserService $adminUserService;

    /**
     * @param AdminUserService $adminUserService
     */
    public function __construct(AdminUserService $adminUserService)
    {
        $this->adminUserService = $adminUserService;
        Context::add('module', 'Admin');
    }

    #[GetRoles]
    public function getRoles(Request $request)
    {
        return $this->adminUserService->getRoles();
    }

    #[GetPermissions]
    public function getPermissions(Request $request)
    {
        $validated = $request->validate([
            'roles' => 'sometimes|array|nullable',
            'roles.*' => 'exists:roles,id',
            'without_grouping' => 'sometimes|nullable|boolean',
        ]);
        return $this->adminUserService->getPermissions(
            $validated['roles'] ?? [],
            $validated['without_grouping'] ?? false,
        );
    }

    #[CreateUser]
    public function createUser(Request $request)
    {
        $this->transformToLowerRequestEmailAndLogin($request);

        $validated = $request->validate([
            'user' => 'required|array',
            'user.email' => 'required|email|unique:users,email|unique:users,name',
            'user.name' => 'required|unique:users,email|unique:users,name',
            'user.password' => 'required|string|min:8',
            'user.roles' => 'present|array|min:0',
            'user.roles.*' => 'exists:roles,id',
            'user.permissions' => 'present|array|min:0',
            'user.permissions.*' => 'exists:permissions,id',

            'person' => 'required|array',
            'person.last_name' => 'required|string',
            'person.first_name' => 'required|string',
            'person.middle_name' => 'sometimes|string|nullable',
        ]);
        return $this->adminUserService->createUser($validated['user'], $validated['person']);
    }

    private function transformToLowerRequestEmailAndLogin(Request $request)
    {
        $requestUserData = $request->get('user');

        if (isset($requestUserData['email'])) {
            $requestUserData['email'] = mb_strtolower($requestUserData['email']);
        }
        if (isset($requestUserData['name'])) {
            $requestUserData['name'] = mb_strtolower($requestUserData['name']);
        }
        $request->merge(['user' => $requestUserData]);
    }

    #[UpdateUser]
    public function updateUser(Request $request, User $user)
    {
        $this->transformToLowerRequestEmailAndLogin($request);

        $validated = $request->validate([
            'user' => 'required|array',
            'user.email' => [
                'sometimes',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
                Rule::unique('users', 'name')->ignore($user->id),
            ],
            'user.name' => [
                'sometimes',
                Rule::unique('users', 'email')->ignore($user->id),
                Rule::unique('users', 'name')->ignore($user->id),
            ],
            'user.password' => 'sometimes|string|min:8',
            'user.is_active' => 'sometimes|boolean',
            'user.roles' => 'sometimes|array',
            'user.roles.*' => 'exists:roles,id',
            'user.permissions' => 'sometimes|array',
            'user.permissions.*' => 'exists:permissions,id',

            'person' => 'sometimes|array',
            'person.last_name' => 'sometimes|string',
            'person.first_name' => 'sometimes|string',
            'person.middle_name' => 'sometimes|string|nullable',
        ]);

        return $this->adminUserService->updateUser($validated['user'], $validated['person'], $user);
    }

    #[GetUsers]
    public function getUsers(Request $request)
    {
        $validated = $request->validate([
            'query' => 'sometimes|nullable|string',
            'roles' => 'sometimes|array|nullable',
            'roles.*' => 'exists:roles,id',
            'permissions' => 'sometimes|array|nullable',
            'permissions.*' => 'exists:permissions,id',
            'per_page' => 'sometimes|integer|nullable',
        ]);
        return $this->adminUserService->getUsers(
            $validated['query'] ?? null,
            $validated['roles'] ?? [],
            $validated['permissions'] ?? [],
            $validated['per_page'] ?? 15,
        );
    }

    #[GetDetailUserInformation]
    public function getDetailUserInformation(Request $request, User $user)
    {
        return $this->adminUserService->getDetailUserInformation($user);
    }

    #[DeleteUser]
    public function deleteUser(Request $request, User $user)
    {
        return $this->adminUserService->deleteUser($user);
    }

    #[LoginByUser]
    public function loginByUser(Request $request, User $user)
    {
        Auth::user()->impersonate($user, 'web');
        return ['success' => true];
    }

    #[LogOutFromUser]
    public function logOutFromUser(Request $request)
    {
        Auth::user()->leaveImpersonation();

        return ['success' => true];
    }
}
