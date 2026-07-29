<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;
use Modules\Admin\Emails\ResetPasswordMail;
use Modules\Admin\Models\User;
use Modules\Admin\Services\UserService;
use Modules\Admin\Swagger\Docs\Attributes\UserController\GetToken;
use Modules\Admin\Swagger\Docs\Attributes\UserController\Login;
use Modules\Admin\Swagger\Docs\Attributes\UserController\LogOut;
use Modules\Admin\Swagger\Docs\Attributes\UserController\Me;
use Modules\Admin\Swagger\Docs\Attributes\UserController\ResetPassword;
use Modules\Admin\Swagger\Docs\Attributes\UserController\SendResetPasswordLink;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Auth', description: 'Методы связанные с авторизацией')]
class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        Context::add('module', 'Admin');

    }

    #[Login]
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required|string|min:8',
        ]);

        $validated['email'] = mb_strtolower($validated['email']);

        $response = $this->userService->login([
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        if ($response['auth']) {
            session()->regenerate();
            return $response;
        }

        return $response;
    }

    #[LogOut]
    public function logOut(Request $request)
    {
        $this->userService->logOut();
        //setcookie('roles', '', time() - 10000, path: '/');

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return [
            'success' => true,
        ];
    }

    #[Me]
    public function me(Request $request)
    {
        return $this->userService->me(Auth::user());
    }

    #[GetToken]
    public function getToken(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required|string|min:8',
            'device_name' => 'required|string',
        ]);
        $result = $this->userService->getToken($validated['email'], $validated['password'], $validated['device_name']);
        return isset($result['error']) ? response()->json($result, 401) : response()->json(['token' => $result]);
    }

    #[SendResetPasswordLink]
    public function sendResetPasswordLink(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', Rule::exists('users', 'email')->whereNotIn('id', [1])],
        ]);


        return $this->userService->sendResetPasswordLink($validated['email']);
    }

    #[ResetPassword]
    public function resetPassword(Request $request)
    {
       $validated= $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

       return $this->userService->resetPassword($validated['email'], $validated['password'], $validated['token']);
    }
}
