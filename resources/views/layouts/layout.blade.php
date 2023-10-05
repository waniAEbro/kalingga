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

    function update_bill(element) {
        let total = document.querySelector('#total_bill').value;
        if (parseInt(element.value) >= parseInt(total)) {
            element.value = total
        } else if (parseInt(element.value) <= 0) {
            element.value = 0
        }
    }

    function toRupiah(number) {
        let rupiahFormat = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
        }).format(number);
        return rupiahFormat
    }

    document.querySelectorAll(".rupiah").forEach(element => {
        element.innerText = toRupiah(element.innerText)
    });

    function searching(cari) {
        console.log(document.querySelectorAll('#daftar-item'))
        let data = []
        document.querySelectorAll('#daftar-item').forEach(element => {
            let apakahDicari = false

            element.querySelectorAll("td")
                .forEach(e => e.innerText.toLowerCase().includes(cari.toLowerCase()) && (apakahDicari = true))

            if (apakahDicari) {
                element.classList.remove('hidden')
                data.push(state.data.find(el => el.id == element.querySelector('.id-item').innerText))
            } else {
                element.classList.add('hidden');
            }
        })
        state.querySet = data
        state.page = 1
        buildTable()
    }

    let state = {
        'querySet': [],
        "data": [],
        'page': 1,
        'rows': 2,
        'window': 5,
        'no': 1
    }

    function pagination(querySet, page, rows) {

        let trimStart = (page - 1) * rows
        let trimEnd = trimStart + rows

        let trimmedData = querySet.slice(trimStart, trimEnd)

        let pages = Math.ceil(querySet.length / rows);

        return {
            'querySet': trimmedData,
            'pages': pages,
            'trimStart': trimStart
        }
    }

    function pageButtons(pages, trimStart) {
        let wrapper = document.getElementById('pagination-wrapper')
        document.getElementById('info-pagination').innerText =
            `Showing ${trimStart + 1} to ${((trimStart + 5) > state.querySet.length) ? state.querySet.length : trimStart + 5} of ${state.querySet.length} entries`;

        wrapper.innerHTML = ``
        console.log('Pages:', pages)

        let maxLeft = (state.page - Math.floor(state.window / 2))
        let maxRight = (state.page + Math.floor(state.window / 2))

        if (maxLeft < 1) {
            maxLeft = 1
            maxRight = state.window
        }

        if (maxRight > pages) {
            maxLeft = pages - (state.window - 1)

            if (maxLeft < 1) {
                maxLeft = 1
            }
            maxRight = pages
        }

        for (let page = maxLeft; page <= maxRight; page++) {
            if (page == state.page) {
                wrapper.innerHTML +=
                    `<button value="${page}" onclick="pindahHalaman(this.value)" class="px-4 flex items-center bg-white drop-shadow-[0_0_15px_rgba(0,0,0,0.05)] hover:bg-gray-50 focus:bg-gray-100 rounded">${page}</button>`
            } else {
                wrapper.innerHTML +=
                    `<button value="${page}" onclick="pindahHalaman(this.value)" class="flex items-center px-4 transition-all rounded hover:bg-gray-50 focus:bg-gray-100">${page}</button>`
            }
        }

        if (state.page != 1) {
            wrapper.innerHTML =
                `<button value="${state.page - 1}" onclick="pindahHalaman(this.value)" class="flex items-center px-4 py-2 rounded hover:bg-gray-50 focus:bg-gray-100"><span class="material-symbols-outlined" style="font-size: 16px">keyboard_arrow_left</span></button>` +
                wrapper.innerHTML

            wrapper.innerHTML =
                `<button value="${1}" onclick="pindahHalaman(this.value)" class="flex items-center px-4 py-2 rounded hover:bg-gray-50 focus:bg-gray-100"><span class="material-symbols-outlined"
                style="font-size: 16px">keyboard_double_arrow_left</span></button>` +
                wrapper.innerHTML
        }

        if (state.page != pages) {
            wrapper.innerHTML +=
                `<button value="${state.page + 1}" onclick="pindahHalaman(this.value)" class="flex items-center px-4 py-2 rounded hover:bg-gray-50 focus:bg-gray-100"><span class="material-symbols-outlined" style="font-size: 16px">keyboard_arrow_right</span></button>`

            wrapper.innerHTML +=
                `<button value="${pages}" onclick="pindahHalaman(this.value)" class="flex items-center px-4 py-2 rounded hover:bg-gray-50 focus:bg-gray-100"><span class="material-symbols-outlined"
                style="font-size: 16px">keyboard_double_arrow_right</span></button>`
        }

    }

    function pindahHalaman(value) {
        state.page = Number(value);
        buildTable();
    }


    function buildTable() {
        let table = document.getElementById('table-body');


        let data = pagination(state.querySet, state.page, state.rows)
        state.querySet.length && pageButtons(data.pages, data.trimStart)

        let myList = data.querySet

        let ids = document.querySelectorAll(".id-item")
        let idsArray = Array.from(ids)
        ids.forEach(id => id.parentElement.classList.add("hidden"))

        myList.forEach(list => {
            let index = idsArray.indexOf(idsArray.find(el => el.innerText == list.id))
            ids[index].parentElement.classList.remove("hidden")
        })
    }
</script>
@stack('script')

</html>
