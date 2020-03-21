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
        <div class="bg-purple-800 p-6">
            <div class="bg-white flex flex-col font-sans">
                <div class="container mx-auto px-8 min-h-screen">
                    <site-navbar></site-navbar>
                    
                    @yield('content') 

                    <footer class="w-full text-center py-12 text-gray-500 text-xs">
                        Created by Jakub Gause & FunFirst s.r.o © All rights reserved - {{ date('Y') }}<br>
                        With use of Laravel, VueJS & TailwindCSS
                    </footer>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ env('APP_ENV') === 'local' ? 'http://localhost:8080/js/app.js' : asset('js/app.js') }}"></script>
</body>
</html>