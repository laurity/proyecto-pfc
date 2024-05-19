<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:wght@400;700&family=Didot:wght@400;700&display=swap" rel="stylesheet">
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
              <title>{{ $title ?? 'Alonso del Rey' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="bg-state-200 dark:bg-slate-700">
        @livewire('partials.navbar')
        <main>
        {{ $slot }}
    </main>
    @livewire('partials.footer')
        @livewireScripts
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <x-livewire-alert::scripts />
    </body>
</html>