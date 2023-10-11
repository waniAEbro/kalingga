<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
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
    <div class="relative flex">
        <x-nav />

        <x-main>
            @yield('content')
        </x-main>
        {{-- <div class="absolute top-0 z-10 w-full h-full bg-black opacity-50"></div> --}}
        {{-- <div id="modal"
            class="absolute z-20 translate-x-1/2 -translate-y-1/2 bg-white top-1/3 right-1/2 w-52 h-52 rounded-xl">
        </div> --}}
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

    const state = {
        allData: [],
        data: [],
        currentData: [],
        columnName: [],
        columnQuery: [],
        page: 1,
        rows: 5,
        window: 5,
        menu: ""
    }

    function searching(text = "") {
        let found = []
        state.allData.forEach(data => {
            let isFound = false
            state.columnQuery.forEach(columnQuery => {
                const query = "data." + columnQuery
                if (eval(query).toString().toLowerCase().includes(text.toLowerCase())) {
                    isFound = true
                }
            })
            if (isFound) {
                found.push(data)
            }
        })

        state.data = found
        state.page = 1

        paginate()
        pageNumber()
        buildTable()
    }

    function buildHeader() {
        const thead = document.createElement("thead")
        const tr = document.createElement("tr")
        tr.classList.add("text-center")
        state.columnName.forEach(columnName => {
            const th = document.createElement("th")
            th.classList.add("px-4", "py-5", "font-[500]")
            th.innerText = columnName
            tr.appendChild(th)
        })
        thead.appendChild(tr)
        return thead
    }

    function buildTable() {
        if (document.querySelector("#table-body")) {
            document.querySelector("#table-body").remove()
        }
        let tbody = document.createElement("tbody")
        tbody.classList.add("text-center")
        tbody.id = "table-body"
        state.currentData.forEach((data, index) => {
            const tr = document.createElement("tr")
            tr.classList.add("cursor-pointer", "text-sm", "bg-white",
                "drop-shadow-[0_0_15px_rgba(0,0,0,0.05)]")
            tr.id = "daftar-item"
            tr.innerHTML += `<td class="p-4 rounded-l-lg"><div class="flex items-center justify-center gap-3 border-r h-7 border-slate-200">
                ${state.page * state.rows - state.rows + index + 1}
                </td>`
            state.columnQuery.forEach(columnQuery => {
                const query = "data." + columnQuery
                const td = document.createElement("td")
                td.classList.add("p-4", "break-words")
                td.innerText = eval(query)
                tr.appendChild(td)
            })
            tr.innerHTML += `
            <td class="p-4 rounded-r-lg">
                <div class="flex items-center justify-center gap-3 border-l h-7 border-slate-200">
                    <button onclick="show(${ data.id })" class="flex items-center gap-1 text-slate-600">
                        <span class="text-lg"><ion-icon name="eye-outline"></ion-icon></span>Show
                    </button>
                    <a href="/${state.menu}/${ data.id }/edit" class="flex items-center gap-1 text-slate-600">
                        <span class="text-lg"><ion-icon name="create-outline"></ion-icon></span>Edit
                    </a>
                    <form action="/${state.menu}/${ data.id }" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="flex items-center gap-1 text-red-700"><span
                                class="text-lg"><ion-icon name="trash-outline"></ion-icon></span>Hapus</button>
                    </form>
                </div>
            </td>`
            tr.addEventListener("click", () => {
                show('halo')
            })
            tbody.appendChild(tr)
        })
        document.querySelector(".table-fixed").appendChild(tbody)
    }

    function show(id) {
        // let damn = state.allData.find(data => {
        //     console.log(data)
        //     return data.id === id
        // });

        // const modal = document.querySelector('#modal');

        // modal.innerHTML = `id`
        console.log("halo")
    }

    function paginate() {
        let trimStart = (state.page - 1) * state.rows
        let trimEnd = trimStart + state.rows

        let trimmedData = state.data.slice(trimStart, trimEnd)

        state.currentData = trimmedData
    }

    function pageNumber() {
        document.querySelector("#pagination-wrapper").innerHTML = ""
        let pages = Math.ceil(state.data.length / state.rows);
        if (state.page >= 4) {
            const button1 = document.createElement('button')
            const button2 = document.createElement('button')
            button1.innerText = 1
            button2.innerText = "..."
            button1.classList.add("bg-gray-200", "hover:bg-gray-400", "text-gray-800", "font-bold", "py-2", "px-4",
                "rounded-full", "focus:outline-none", "focus:ring-2", "focus:ring-gray-600",
                "focus:ring-opacity-50")
            button2.classList.add("bg-gray-400", "rounded-full", "py-2", "px-4", "text-white", "font-bold")
            button1.addEventListener("click", function(e) {
                state.page = parseInt(e.currentTarget.innerText)
                paginate()
                pageNumber()
                buildTable()
            })
            document.querySelector("#pagination-wrapper").appendChild(button1)
            document.querySelector("#pagination-wrapper").appendChild(button2)
        }
        for (i = state.page - 2; i < state.page + state.window && i <= pages; i++) {
            if (i > 0) {
                const button = document.createElement('button')
                button.innerText = i
                if (i == state.page) {
                    button.classList.add("bg-gray-400", "rounded-full", "py-2", "px-4", "text-white", "font-bold")
                } else {
                    button.classList.add("bg-gray-200", "hover:bg-gray-400", "text-gray-800", "font-bold", "py-2",
                        "px-4",
                        "rounded-full", "focus:outline-none", "focus:ring-2", "focus:ring-gray-600",
                        "focus:ring-opacity-50"
                    )
                    button.addEventListener("click", function(e) {
                        state.page = parseInt(e.currentTarget.innerText)
                        paginate()
                        pageNumber()
                        buildTable()
                    })
                }
                document.querySelector("#pagination-wrapper").appendChild(button)
            }
        }
        if (state.page < pages - 4) {
            const button1 = document.createElement('button')
            const button2 = document.createElement('button')
            button1.innerText = pages
            button2.innerText = "..."
            button1.classList.add("bg-gray-200", "hover:bg-gray-400", "text-gray-800", "font-bold", "py-2", "px-4",
                "rounded-full", "focus:outline-none", "focus:ring-2", "focus:ring-gray-600",
                "focus:ring-opacity-50")
            button2.classList.add("bg-gray-400", "rounded-full", "py-2", "px-4", "text-white", "font-bold")
            button1.addEventListener("click", function(e) {
                state.page = parseInt(e.currentTarget.innerText)
                paginate()
                pageNumber()
                buildTable()
            })
            document.querySelector("#pagination-wrapper").appendChild(button2)
            document.querySelector("#pagination-wrapper").appendChild(button1)
        }
    }
</script>
@stack('script')

</html>
