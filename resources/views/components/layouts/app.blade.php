<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Alonso del Rey' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @@livewireStyles
    </head>
    <body class="bg-state-200 dark:bg-slate-700">
        {{ $slot }}
        @@livewireScripts
    </body>
</html>