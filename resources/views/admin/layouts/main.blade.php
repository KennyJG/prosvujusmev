<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin - Pro svůj úsměv</title>

    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="min-h-screen min-w-screen bg-gray-100">
    <div id="app" class="min-h-screen min-w-screen">
        @yield('content')
    </div>
    <script src="{{ env('APP_ENV') === 'local' ? 'http://localhost:8080/js/app.js' : asset('js/app.js') }}"></script>
</body>
</html>