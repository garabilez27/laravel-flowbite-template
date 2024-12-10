<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel/Flowbite</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    @include('components.navbar')
    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
        @include('components.sidebar')
        <div class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <div class="grid grid-cols-1 px-4 pt-6 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
                <div class="mb-4 col-span-full xl:mb-2">
                    @include('components.breadcrumb')
                </div>
            </div>
            <div class="col-span-full xl:col-auto">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
