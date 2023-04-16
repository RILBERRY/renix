<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')

    <title>Login Page</title>
    <style>
        /* Set full height for body and html */
        body, html {
            height: 100%;
        }
        /* Set background image and size */
        .bg-image {
            /* background-image: url('/img/bg_original.png'); */
            background-size: cover;
            background-position: center;
        }
        /* Center form on page */
        .form-center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
    </style>
</head>
<body>
    <div class="bg-image h-screen">
        <div class="form-center ">
            <form class="bg-white rounded-lg p-8 shadow-md w-full m-2 sm:w-96" method="POST" action="/login">
                @csrf
                <h2 class="text-gray-800 text-2xl font-semibold">Login</h2>
                <div class="mt-4">
                    <label class="block text-gray-700 font-semibold">Email</label>
                    <input type="text" name="email" class="form-input mt-1 block w-full rounded-md border-gray-300" placeholder="Enter your username">
                </div>
                <div class="mt-4">
                    <label class="block text-gray-700 font-semibold">Password</label>
                    <input type="password" name="password" class="form-input mt-1 block w-full rounded-md border-gray-300" placeholder="Enter your password">
                </div>
                <button class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md">Login</button>
                <a href="/register" class="mt-4 text-gray-500 font-semibold py-2 px-4 rounded-md">Register</a>
            </form>
        </div>
    </div>
    <div>
        <img src="/img/green-1.svg" class=" fixed top-[0rem] -left-[5rem] rotate-[27deg] -z-10 w-96">
        <img src="/img/green-1.svg" class=" fixed top-[5rem] -left-[10rem] rotate-[48deg] -z-10 w-96">
        <img src="/img/green-2.svg" class=" fixed top-[5rem] -left-[5rem] rotate-[38deg] -z-10 w-96">

        <img src="/img/or-1.svg" class=" fixed top-[0rem] -right-[5rem] -rotate-[197deg] -z-20 w-96">
        <img src="/img/or-1.svg" class=" fixed top-[5rem] -right-[10rem] -rotate-[168deg] -z-20 w-96">
        <img src="/img/or-2.svg" class=" fixed top-[5rem] -right-[8rem] rotate-[158deg] -z-20 w-96">

        <img src="/img/pea-1.svg" class=" fixed bottom-[0rem] -left-[5rem] -rotate-[17deg] -z-10 w-96">
        <img src="/img/pea-1.svg" class=" fixed bottom-[5rem] -left-[10rem] -rotate-[38deg] -z-10 w-96">
        <img src="/img/pea-2.svg" class=" fixed bottom-[5rem] -left-[5rem] -rotate-[28deg] -z-10 w-96">
        <img src="/img/green-2.svg" class=" fixed -bottom-[7rem] -right-[3rem] -rotate-[180deg] -z-10 w-[40rem]">
    </div>

</body>
</html>
