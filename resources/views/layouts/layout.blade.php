<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{{ csrf_token() }}}">
    <title>@yield('title', config('seo.seo.title'))</title>
    <meta name="description" content="@yield('description',  config('seo.seo.description'))"/>
    <meta name="keywords" content="@yield('keywords',  config('seo.seo.keywords'))"/>
    {{--  {!!   config('google.google_tag.head') !!}--}}
    <link rel="preload" href="{{ Vite::asset('node_modules/@fontsource-variable/golos-text/files/golos-text-cyrillic-wght-normal.woff2') }}" as="font" type="font/woff2" crossorigin>
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
    ])
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/site.webmanifest">
    @stack('head')
</head>
<body>
<div id="back-to-top"></div>
{{--  {!!  config('google.google_tag.body') !!}  --}}
<div class="content_  @yield('class')  {{ route_name() }}">
    <x-message.message/>
    <x-message.message_error/>
    @include('templates.axeld.header')
    <main>
        @yield('content')
    </main>
</div><!--.content_-->
@include('templates.axeld.footer')
@stack('scripts')
</body>
</html>

