<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rumah Ticket')</title>

    @vite(['resources/css/app.css', 'resources/js/auth-guard.js', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">

    <x-navbar />

    @yield('content')

    <x-footer />

</body>
</html>