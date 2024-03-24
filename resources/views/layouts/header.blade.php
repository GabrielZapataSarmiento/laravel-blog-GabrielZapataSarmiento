<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Home</title>

</head>
<body>
    <header class="bg-white">
        <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
                <a href="#" class="-m-1.5 p-1.5">
                    <span class="sr-only">Your Company</span>
                    <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="">
                </a>
            </div>
            <div class="hidden lg:flex lg:gap-x-12">
                <a href="/" class="text-sm font-semibold leading-6 text-gray-900">Home</a>
                <a href="{{ route('blog.add') }}" class="text-sm font-semibold leading-6 text-gray-900">Create Blog</a>
                <a href="{{ route('myblogs') }}" class="text-sm font-semibold leading-6 text-gray-900">My Blogs</a>
                @auth
                    <a class="text-sm font-semibold leading-6 text-gray-900">Welcome, {{ Auth::user()->name }}</a>
                @endauth
            </div>
            <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                @auth
                    <a href="{{ route('logout') }}" class="text-sm font-semibold leading-6 text-gray-900">Log out<span aria-hidden="true">&rarr;</span></a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold leading-6 text-gray-900 mr-4">Log in</a>
                    <a href="{{ route('register') }}" class="text-sm font-semibold leading-6 text-gray-900">Register</a>
                @endauth
            </div>
        </nav>
    </header>
    <div class="container mx-auto py-4">
        <div class="container mx-auto py-4 sm:w-1/2">
            @if(session('msg'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative flex justify-center mb-4" role="alert">
                    <span class="block sm:inline">{{ session('msg') }}</span>
                    <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close">
                        <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 5.652a.5.5 0 0 1 0 .707L10.707 10l3.641 3.641a.5.5 0 0 1-.707.707L10 10.707 6.359 14.348a.5.5 0 0 1-.707-.707L9.293 10 5.652 6.359a.5.5 0 0 1 .707-.707L10 9.293l3.641-3.641a.5.5 0 0 1 .707 0z"/></svg>
                    </button>
                </div>
            @endif
        </div>


@yield('content')
