<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        {{-- <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
        @yield('styles')

        <title>{{ config('app.name', 'Admin LTE') }}</title>
        <!--Header Links-->
        @include('layouts.partials.head')

        <!-- Fonts -->
        {{-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}

        <!-- Scripts -->
        {{-- mix.js('resources/js/app.js', 'public/dist/js').postCss('resources/css/app.css', 'public/dist/css'); --}}

        <!--DataTable Button Bg-Color-->
        <style>
            .dataTables_wrapper .dt-buttons :is(.buttons-print, .buttons-copy, .buttons-pdf) {
                background-color: #6c757d;
                /* Replace with your desired color */
            }
        </style>
    </head>
    @include('layouts.partials.header')
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">


          <!-- Preloader -->
          <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
          </div>


          <!--Navigation-->
            @include('layouts.navigation')
         <!--Sidebar-->
            @include('layouts.partials.sidebar')


            <!-- Page Heading -->
           @yield('toolbar')
            <!-- Page Content -->
            <main>
                <div class="content-wrapper px-4 py-2">
                @yield('content')
                </div>
            </main>

            <!-- Footer -->
            @include('layouts.partials.footer')

        </div>
        <!-- Scripts -->
        @include('layouts.partials.script')

        @stack('scripts')

    </body>
</html>

