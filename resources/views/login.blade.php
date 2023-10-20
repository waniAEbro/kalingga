<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="shortcut icon" type="image/png" href="/img/image 6.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <title>Login</title>
</head>

<body class="font-['Roboto']">
    <!-- Container -->
    <div class="container mx-auto drop-shadow-xl">
        <div class="flex justify-center px-6 my-12">
            <!-- Row -->
            <div class="w-full xl:w-3/4 lg:w-11/12 flex">
                <!-- Col -->
                <div class="w-full h-auto bg-gray-400 hidden lg:block lg:w-1/2 bg-cover rounded-l-lg"
                    style="background-image: url('https://source.unsplash.com/Z3NceSeZqgI/600x800')"></div>
                <!-- Col -->
                <div class="w-full lg:w-1/2 bg-white p-5 rounded-lg lg:rounded-l-none">
                    <h3 class="pt-4 text-2xl text-center">Welcome Back!</h3>
                    <form action="/login/user" class="px-8 pt-6 pb-8 mb-4 bg-white rounded" method="post">
                        @csrf
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="username">
                                Email
                            </label>
                            <input
                                class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="email" name="email" type="email" value="{{ Session::get('email') }}"
                                placeholder="email" />
                        </div>
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="password">
                                Password
                            </label>
                            <input
                                class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="password" name="password" type="password" placeholder="******************"
                                oninput="validasi(event)" />
                            <p id="error" class="text-xs italic text-red-500 hidden">Password minimal 8 karakter</p>
                        </div>
                        <div class="mb-6 text-center">
                            <button
                                class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                                type="submit" name="submit">
                                Sign In
                            </button>
                        </div>
                        <hr class="mb-6 border-t" />
                        {{-- <div class="text-center">
                            <a class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800"
                                href="/register">
                                Create an Account!
                            </a>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function validasi(event) {
        if (event.target.value.length < 8) {
            document.querySelector('#error').classList.remove('hidden');
            event.target.classList.add('border-red-500');
        } else {
            document.querySelector('#error').classList.add('hidden');
            event.target.classList.remove('border-red-500');
        }
    }
</script>

</html>
