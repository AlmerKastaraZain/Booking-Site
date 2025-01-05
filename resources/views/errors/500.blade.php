
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body>

        <section class="bg-white dark:bg-gray-900 h-[100vh] w-[100vw] flex justify-center items-center ">
            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
                <div class="mx-auto max-w-screen-sm text-center">
                    <h1 class="mb-8 text-7xl tracking-tight font-extrabold lg:text-9xl text-primary-600 dark:text-white"><span class="bg-indigo-500 px-10">500</span></h1>
                    <p class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">Internal Server Error.</p>
                    <p class="mb-4 text-lg font-light text-gray-500 dark:text-gray-400">Problem with the server that hosts a website. Please wait until site is active again!</p>
                    <a href="/" class="inline-flex text-white bg-primary-600 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-primary-900 my-4 bg-indigo-500 hover:bg-indigo-600">Back to Homepage</a>
                </div>   
            </div>
        </section>
    </body>
</html>
