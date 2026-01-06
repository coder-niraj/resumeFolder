<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel') . ' - Admin')</title>

    <!-- Fonts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <link href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" rel="stylesheet" /> --}}
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('header')
    <!-- Additional Styles -->
    @yield('styles')

    <!-- Livewire Styles -->
    @livewireStyles
</head>

<body class="antialiased @yield('body-class', 'bg-gray-100')">
    @include('admin::toast.app')
    @yield('content')


    <!-- Additional Scripts -->
    @yield('scripts')

    <!-- Stack Scripts -->
    @stack('scripts')
</body>

</html>
