<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Письмо для смены пароля</title>
    <style>
        {{--Для того, чтобы править стили см. resources/assets/mail/css/default.css --}}
    </style>
</head>
<body>
<table class="wrapper" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="center">
            <table class="content" cellpadding="0" cellspacing="0" role="presentation">
{{--                <tr>
                    <td class="header">
                        ИНС «Вика»
                    </td>
                </tr>--}}
                <tr>
                    <td class="body">
                        <h1 class="title">Здравствуйте!</h1>
                        <p class="text">
                            Нажмите эту кнопку, чтобы сбросить пароль для учётной записи.
                        </p>

                        <a href="{{ \Illuminate\Support\Facades\URL::query('admin/reset-password',query:['token'=>$token,'email'=>$email]) }}"
                           class="button">
                            Сбросить пароль
                        </a>
                        <p class="text">
                            Кнопка не срабатывает? Скопируйте ссылку <a href="{{ \Illuminate\Support\Facades\URL::query('admin/reset-password',query:['token'=>$token,'email'=>$email]) }}">
                                {{ \Illuminate\Support\Facades\URL::query('admin/reset-password',query:['token'=>$token,'email'=>$email]) }}
                            </a> и вставьте её в адресную строку браузера.
                        </p>

                    </td>
                </tr>
                <tr>
                    <td class="footer">
                       Нейронная сеть "Вика"
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
