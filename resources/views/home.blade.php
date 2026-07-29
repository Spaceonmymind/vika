<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta name="description" content="{{ $description ?? '' }}">
    <meta name="keywords" content="{{ $keywords ?? '' }}">
    <meta name="author" content="{{ $author ?? '' }}">

    <script data-skip-moving="true">
        var _vikaSettings = _vikaSettings || {};
        (function (w, d, u) {
            var s = d.createElement('script');
            s.async = 1;
            s.src = u + '?' + (Date.now() / 60000 | 0);
            var h = d.getElementsByTagName('script')[0];
            h.parentNode.insertBefore(s, h);
        })(window, document, '/build-vika-launcher/launcher.js');
    </script>

    @vite(['resources/js/app.ts'])
</head>
<body>

<div id="home-page"></div>

</body>
