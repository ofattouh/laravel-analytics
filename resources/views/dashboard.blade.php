<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Evaluation Analytics App') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <!--
        Vue will be "mounted" on main element of HTML structure, where Vue components would live inside. Usually,
        it is one of top div elements or body tag inside HTML layout, and to identify it, we assign it id="app"
    -->
    <body class="font-sans antialiased" id="app">
    </body>
</html>
