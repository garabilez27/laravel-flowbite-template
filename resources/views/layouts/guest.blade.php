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
    <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
        <a href="https://flowbite-admin-dashboard.vercel.app/" class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white">
            <img src="https://flowbite-admin-dashboard.vercel.app/images/logo.svg" class="mr-4 h-11" alt="FlowBite Logo">
            <span>Flowbite</span>
        </a>
        <div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
            @yield('content')
        </div>
    </div>
</body>
</html>
