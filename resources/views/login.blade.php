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
    <div class="grid w-full grid-cols-2">
        <div class="flex items-center justify-center w-full h-screen">
            <div class="w-2/3 bg-white p-7 rounded-xl h-fit drop-shadow-lg">
                <div class="flex items-center w-full gap-2">
                    <img src="img/image 6 big.png" class="w-10" alt="">
                    <div class="text-lg font-bold">Kalingga Keling Jati</div>
                </div>

                <div class="mt-4 mb-2 text-2xl font-bold">Welcome Back!</div>

                <div class="text-sm text-gray-500">Start your website in seconds.</div>

                <form action="/login/user" method="post">
                    @csrf
                    <x-input :label="'Email'" :name="'email'" :inputParentClass="'my-5'" :labelClass="'font-[500]'" :placeholder="'example@example.com'"
                        class="bg-gray-200 focus:bg-white" :value="old('email')" />
                    <x-input :label="'Password'" :name="'password'" :type="'password'" :labelClass="'font-[500]'"
                        class="bg-gray-200 focus:bg-white" oninput="validasi(event)" :placeholder="'*************'" />

                    @if (!($errors->has('password')))
                        <p id="error" class="hidden mt-2 text-xs text-red-500">Password minimal 8 karakter</p>
                        
                    @endif
                    <button
                        class="mt-10 text-sm text-white bg-[#16A34A] focus:bg-[#278e4d] hover:bg-[#2b9d54] rounded-lg w-full py-2">Sign
                        in to your
                        account</button>
                </form>
            </div>
        </div>
        <div class="flex items-center justify-start w-full h-screen">
            <div class="w-[90%]">
                <img src="/img/ilustrasi.png" alt="">
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
