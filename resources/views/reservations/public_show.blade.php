<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pro Svůj Úsměv</title>

    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body,html {
            height: 100%;
        }
    </style>
     <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id="app" class="w-full h-full">
        <public-reservation reservation-uuid="{{ $reservation->uuid }}"></public-reservation>     
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>