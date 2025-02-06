<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('superadmin.layouts.navigation')
        
        <!-- Main Content Area -->
        <div class="md:pl-60">
            <div class="md:hidden h-14"></div>
            <main class="p-4">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const openButton = document.getElementById('openSidebar');
        const closeButton = document.getElementById('closeSidebar');
        
        openButton?.addEventListener('click', function() {
            sidebar.classList.remove('-translate-x-full');
        });
        
        closeButton?.addEventListener('click', function() {
            sidebar.classList.add('-translate-x-full');
        });
    });
    </script>

    @stack('scripts')  <!-- Tambahkan ini -->
</body>
</html>