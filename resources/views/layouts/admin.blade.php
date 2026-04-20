<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        @include('layouts.admin-sidebar')

        {{-- Main Content --}}
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>

    </div>

</body>
</html>