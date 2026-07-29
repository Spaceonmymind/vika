<?php

namespace Modules\Admin\Services;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Modules\Admin\Emails\PasswordChanged;
use Modules\Admin\Emails\ResetPasswordMail;
use Modules\Admin\Models\User;

class UserService
{

    /**
     * Авторизация
     * @param $userData
     * @return array
     */
    public function login($userData)
    {
        $userData['is_active'] = 1;

        $auth = Auth::attempt($userData) || Auth::attempt([
                'name' => mb_strtolower($userData['email']),
                'password' => $userData['password'],
                'is_active' => $userData['is_active'],
            ]);

        if (!$auth) {
            return [
                'auth' => false,
                'error' => 'Неверный логин или пароль',
            ];
        }
        $user = auth()->user();

        Cookie::queue(Cookie::make('roles', $user->getRoleNames(), 1440, httpOnly: false));
        Cookie::queue(Cookie::make('permissions', $user->getAllPermissions()->pluck('name'), 1440, httpOnly: false));

        $user->update(['last_logged_in' => Carbon::now()]);

        return [
            'auth' => true,
            'user' => $this->me($user),
        ];
    }

    /**
     * Мишка
     * @param User $user
     * @return array
     */
    public function me(User $user)
    {
        /*        Cookie::queue(Cookie::make('roles', $user->getRoleNames(), 1440, httpOnly: false));
                Cookie::queue(Cookie::make('permissions', $user->getAllPermissions()->pluck('name'), 1440, httpOnly: false));*/

        $user->load(['roles:id,name,russian_name', 'person']);


        $arUser = $user->toArray();

        $arUser['permissions'] = $user->getAllPermissions();

        $arUser['is_logged_in_by_another_user'] = app('impersonate')->isImpersonating();

        return $arUser;
    }

    /**
     * Логаут
     * @return void
     */
    public function logout()
    {
        Auth::guard('web')->logout();
    }

    /**
     * Получение токена для мобилки
     * @param $email
     * @param $password
     * @param $deviceName
     * @return string|string[]
     */
    public function getToken($email, $password, $deviceName)
    {
        $user = User::query()
            ->where(function ($q) use ($email) {
                $q
                    ->where('email', $email)
                    ->orWhere('name', $email);
            })->first();
        if (!$user || !Hash::check($password, $user->password)) {
            return ['error' => 'Неверный логин или пароль.'];
        }
        return $user->createToken($deviceName)->plainTextToken;
    }

    /**
     * Отправляет письмо со ссылкой для сброса пароля на почту
     * @param string $email
     * @return true[]
     */
    public function sendResetPasswordLink(string $email)
    {
        $user = User::query()->where('email', mb_strtolower($email))->first();

        $token = Password::createToken($user);

        Mail::to($user)->send(new ResetPasswordMail($user->email, $token));
        return ['success' => true];
    }

    /**
     * Изменяет пароль пользователя
     * @param $email
     * @param $password
     * @param $token
     * @return bool[]
     */
    public function resetPassword($email, $password, $token)
    {
        $status = Password::reset(
            ['email' => $email, 'token' => $token, 'password' => $password],
            function (User $user, string $password) {
                $user->update([
                    'password' => Hash::make($password),
                ]);
                $user->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            },
        );

        if($success = $status === Password::PasswordReset){
            Mail::to($email)->send(new PasswordChanged());
        }

        return [
            'success' => $success,
        ];
    }

}
