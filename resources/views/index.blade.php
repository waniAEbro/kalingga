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

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0- 
 alpha/css/bootstrap.css"
        rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <title>Kalingga Keling Jati</title>
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
    <div
        class="h-[calc(100vh-100px)] bg-[#F1F5F9] rounded-[30px] w-full pt-10 px-16 grid grid-cols-4 gap-10 content-start">

        <x-card-menu :url="'dashboard'" :icon="'home-outline'">
            <div class="text-xl font-bold">Dashboard</div>
        </x-card-menu>

        <x-card-menu :url="'sales'" :icon="'cash-outline'" :color="'#2c8d39ff'">
            <div class="text-xl font-bold">Sales</div>
            <div>Sistem Sales</div>
        </x-card-menu>

        <x-card-menu :url="'purchases'" :icon="'bag-check-outline'" :color="'#12263aff'">
            <div class="text-xl font-bold">Purchasing</div>
            <div>Sistem Purchasing</div>
        </x-card-menu>

        <x-card-menu :url="'productions'" :icon="'cog-outline'" :color="'#ccfccbff'">
            <div class="text-xl font-bold">Manufacture</div>
            <div>Sistem Manufacture</div>
        </x-card-menu>

        <x-card-menu :url="'quotations'" :icon="'clipboard-outline'" :color="'#028090ff'">
            <div class="text-xl font-bold">Quotation</div>
            <div>Sistem Quotation</div>
        </x-card-menu>

        <x-card-menu :url="'warehouse'" :icon="'grid-outline'" :color="'#f4c095ff'">
            <div class="text-xl font-bold">Warehouse</div>
            <div>Sistem Warehouse</div>
        </x-card-menu>

        <x-card-menu :url="'finances'" :icon="'logo-usd'" :color="'#4F9DA6'">
            <div class="text-xl font-bold">Finance</div>
            <div>Sistem Finance</div>
        </x-card-menu>

    </div>



    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
