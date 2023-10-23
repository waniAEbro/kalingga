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
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        [x-cloak] {
            display: none;
        }
    </style>

    <title>Kalingga Keing Jati</title>
</head>

<body class="bg-[#064E3B] h-screen w-full px-8">
    <div class="flex items-center justify-between py-3">
        <a href="/" class="flex items-center gap-4">
            <div class="w-10 h-10">
                <img src="/img/image 6 big.png" alt="">
            </div>
            <div class="font-[500] text-white">Kalingga Keling Jati</div>
        </a>

        <div class="flex items-center gap-10">
            <a href="/roles"
                class="font-[500] transition-all text-white hover:underline hover:underline-offset-4">Roles</a>

            <div x-data="{ open: false }" x-on:click="open = !open" x-cloak
                class="font-[500] hover:cursor-pointer relative text-white">
                <div class="bg-yellow-400 rounded-full w-9 h-9"></div>

                <div x-show="open" x-transition:enter.duration.300ms x-transition:leave.duration.300ms
                    class="w-52 rounded-lg absolute z-10 top-12 right-0 bg-[#053E2F] hover:cursor-default">
                    <div class="p-4 border-b border-[#064e3be8]">
                        <div class="text-sm">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-[#AABEB8]">{{ Auth::user()->email }}</div>
                    </div>
                    <div class="p-2">
                        <a href="/logout">
                            <div class="flex items-center gap-3 hover:cursor-pointer p-2 hover:bg-[#12483A] rounded">
                                <ion-icon class="text-sm text-white" name="exit-outline"></ion-icon>
                                <div class="text-sm">Logout</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="h-[calc(100vh-100px)] bg-[#F1F5F9] rounded-[30px] w-full pt-10 px-16 grid grid-cols-4 gap-10 content-start">
        <x-data-list>
            <div class="h-[550px] relative m-5">
                <table class="w-full mt-5 border-separate table-fixed border-spacing-y-3">
                </table>
                <div id="pagination-wrapper" class="absolute bottom-0 flex h-10 gap-2 my-5 text-sm"></div>
            </div>
        </x-data-list>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>




</body>

</html>
