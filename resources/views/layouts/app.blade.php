<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if (Auth::check())
            Impak | {{ tenant()->company }}
        @else
            {{ config('app.name', 'Laravel') }}
        @endif
    </title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    @livewireStyles

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @paddleJS

    @stack('styles')
    @stack('scripts')

    <style>
        .clearfix::after {
            content: " ";
            display: block;
            height: 0;
            clear: both;
            *zoom: expression(this.runtimeStyle['zoom']='1', this.innerHTML +='<div class="ie7-clear"></div>');
        }

        .ie7-clear {
            display: block;
            clear: both;
        }
    </style>

</head>

<body class="font-inter antialiased bg-slate-100 text-slate-600" :class="{ 'sidebar-expanded': sidebarExpanded }"
    x-data="{ sidebarOpen: false, sidebarExpanded: localStorage.getItem('sidebar-expanded') == 'true' }" x-init="$watch('sidebarExpanded', value => localStorage.setItem('sidebar-expanded', value))">

    <script>
        if (localStorage.getItem('sidebar-expanded') == 'true') {
            document.querySelector('body').classList.add('sidebar-expanded');
        } else {
            document.querySelector('body').classList.remove('sidebar-expanded');
        }
    </script>

    @livewireScripts
    {{-- @livewireChartsScripts --}}

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-livewire-alert::scripts />

    {{-- @auth
            @if (Auth::user()->onTrial())
            <div class="p-5 bg-lime-500">
                Your organization is currently on trial. Please enjoy our product for free for 7 days. After that, you will need to upgrade to a paid plan to continue using our product.
            </div>
            @else
                @if (Auth::user()->subscriptions()->active()->get()->count() <= 0)
                <div class="p-5 bg-amber-400">
                    Your organization is currently not subscribed to any plan. Please subscribe to a plan to continue using our product.
                </div>
                @endif
            @endif
        @endauth --}}

    <!-- Page wrapper -->
    <div class="flex h-screen overflow-hidden">

        <x-app.sidebar />

        <!-- Content area -->
        <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden @if ($attributes['background']) {{ $attributes['background'] }} @endif"
            x-ref="contentarea">

            <x-app.header />

            <main>
                {{ $slot }}
            </main>

        </div>

    </div>

    @yield('footer-scripts')
</body>

</html>
