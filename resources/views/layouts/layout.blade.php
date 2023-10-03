<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.4/dist/full.css" rel="stylesheet" type="text/css" />

    <style type="text/tailwindcss">
        @layer components {
            .active {
                @apply pl-5 flex gap-4 w-[86px] transition-all min-[1000px]:w-[224px] items-center text-[#064E3B] bg-[#F1F5F9] before:bg-transparent before:h-10 before:w-10 before:right-0 before:bottom-[100%] before:shadow-[20px_20px_0_#F1F5F9] before:rounded-full before:absolute relative py-1 mb-2 rounded-l-full after:h-10 after:absolute after:w-10 after:bg-transparent after:right-0 after:top-[100%] after:shadow-[20px_-20px_0_#F1F5F9] after:rounded-full;
            }

            .active-warehouse {
                @apply pl-5 flex w-[86px] transition-all min-[1000px]:w-[224px] gap-4 items-center text-[#064E3B] bg-[#F1F5F9] before:bg-transparent before:h-10 before:w-10 before:right-0 before:bottom-[100%] before:shadow-[20px_20px_0_#F1F5F9] before:rounded-full before:absolute relative py-1 mb-2 rounded-l-full after:w-5 after:h-5 after:absolute after:-right-1 after:bottom-0 after:bg-[#F1F5F9];
            }
        }
    </style> --}}

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    @stack('head')
    <style>
        ion-icon {
            --ionicon-stroke-width: 40px;
        }

        [x-cloak] {
            display: none;
        }
    </style>
    <title>Document</title>
</head>

<body class="font-['Roboto']">
    <div class="flex">
        <x-nav />

        <x-main>
            @yield('content')
        </x-main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>

</body>
<script>
    const setup = () => {
        const getTheme = () => {
            if (window.localStorage.getItem('dark')) {
                return JSON.parse(window.localStorage.getItem('dark'))
            }
            return !!window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches
        }

        const setTheme = (value) => {
            window.localStorage.setItem('dark', value)
        }

        return {
            loading: true,
            isDark: getTheme(),
            toggleTheme() {
                this.isDark = !this.isDark
                setTheme(this.isDark)
            },
        }
    }

    function toRupiah(number) {
        let rupiahFormat = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
        }).format(number);
        return rupiahFormat
    }



    function update_bill(element) {
        let total = document.querySelector('#total_bill').value;
        if (parseInt(element.value) >= parseInt(total)) {
            element.value = total
        } else if (parseInt(element.value) <= 0) {
            element.value = 0
        }
    }

    document.querySelectorAll(".rupiah").forEach(element => {
        element.innerText = toRupiah(element.innerText)
    });
</script>
@stack('script')

</html>
