<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="format-detection" content="telephone=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="keywords" content="Realtor, finding a Realtor, find real estate agents,sell a home fast, selling a home, 
        top realtor for buying a new home, best Realtor, sell a home fast, foreclosure, for sale by owner, why to use a Realtor, 
        buy home, buy real estate, house for sale , buy a home, houses for sale, house 4 sale, foreclosures for sale , 
        find real estate , home buyer help, top real estate agents, how to sell a home, how to sell your home, sell my home fast, 
        HUD foreclosures, foreclosure houses, short sale, foreclosure listings, fsbo, land for sale, cheap houses, new houses for sale , 
        buying a home, houses for rent, buy, rent,  ,webapp, app, software">
        <meta name="author" content="Asaan Estate CRM">
        <meta name="description" content="Asaan Estate CRM Manage all your customers, properties, and deals in one app. Designed for real esate agents. Intelligent auto-match technology to help you close 10X more deals annually.">
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('app-assets/images/ico/favicon.png')}}">


        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
