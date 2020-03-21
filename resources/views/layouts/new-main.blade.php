<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pro svůj úsměv</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

    <style>
        html, body, #app {
            width: 100%;
            height: 100%;
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>
    <div id="app">
        @yield('content') 
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>