<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title'){{$title}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,600">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" >
    </head>
    <body>
        @include('includes.header')
        @yield('main-top')
        <main>
            @yield('main')
        </main>
        @include('includes.footer')
        @yield('script')
    </body>
</html>
