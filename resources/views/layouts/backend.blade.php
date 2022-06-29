<!DOCTYPE html>
<html class="loading @if(session('theme')) {{session('theme')}} @else {{request('themes')}} @endif" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <title>@yield('title')</title>
    @if(app()->getLocale() === 'ur')
        @include('backend.partials.rtl-styles')
    @else
        @include('backend.partials.styles')
    @endif
    @stack('styles')
    @livewireStyles
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
</head>

<body
    class="vertical-layout vertical-menu-modern @if(app()->getLocale() === 'ur') content-align-urdu @endif navbar-floating footer-static  "
    data-open="click"
    data-menu="vertical-menu-modern" data-col="">

<x-navbar/>

<x-sidebar/>

<div class="app-content content">
    {{$slot}}
</div>

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<x-footer/>

@livewireScripts
@include('backend.partials.scripts')
@stack('scripts')
</body>

</html>
