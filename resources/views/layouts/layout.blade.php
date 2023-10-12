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

        <div id="modal-background" onclick="hideModal()"
            class="absolute hidden top-0 z-10 w-full h-full bg-black opacity-50">
        </div>
        <div id="modal"
            class="absolute text-[#161414] -z-20 translate-x-1/2 -translate-y-1/2 bg-white top-1/2 right-1/2 rounded-xl transition-opacity duration-300 opacity-0">
            {{-- <div class="w-[960px] bg-white rounded-xl">
                <div class="py-[20px] px-[30px] w-full border-b-2 border-[#A59898] flex justify-between items-center">
                    <div class="text-xl font-bold">Detail Produk</div>
                    <div class="text-2xl flex items-center"><ion-icon name="close-outline"></ion-icon>
                    </div>
                </div>

                <div class="px-[30px] py-[34px] w-full h-[500px] overflow-y-scroll overscroll-none">
                    <div class="flex justify-between gap-5">
                        <div>
                            <div class="font-bold mb-2">Produk</div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] mb-1 text-xs">
                                <div class="flex justify-between">
                                    <div class="font-bold">Nama</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>Kursi Goyang</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs mb-1">
                                <div class="flex justify-between">
                                    <div class="font-bold">Logo</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>Sunyard</div>
                            </div>

                            <div class="font-bold text-xs mb-1">Kode</div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Barcode</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>939393</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>RFID</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>939393</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Produk</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>939393</div>
                            </div>

                            <div class="font-bold text-xs mb-1">Dimensi</div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Panjang</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>2 cm</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Lebar</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>2 cm</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Tinggi</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>2 cm</div>
                            </div>
                        </div>

                        <div>
                            <div class="font-bold mb-2">Pack</div>

                            <div class="font-bold text-xs mb-1">Dimensi Dalam</div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Panjang</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>2 cm</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Lebar</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>2 cm</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Tinggi</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>2 cm</div>
                            </div>

                            <div class="font-bold text-xs mb-1">Dimensi Luar</div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Panjang</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>2 cm</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Lebar</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>2 cm</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Tinggi</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>2 cm</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Volume</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>2 cm</div>
                            </div>

                            <div class="font-bold text-xs mb-1">Berat</div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>NW</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>2 kg</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>GW</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>2 kg</div>
                            </div>
                        </div>

                        <div>
                            <div class="font-bold mb-3">Komponen</div>

                            <table class="table-fixed w-full text-xs">
                                <thead class="border-y-2 border-[#A59898]">
                                    <tr>
                                        <th class="py-2 px-4 w-10">No</th>
                                        <th class="py-2 px-4 text-start w-20">Komponen</th>
                                        <th class="py-2 px-4 text-start w-20">Jumlah</th>
                                        <th class="py-2 px-4 text-start w-10">Unit</th>
                                        <th class="py-2 px-4 text-start">Harga per Satuan</th>
                                        <th class="py-2 px-4 text-start">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-2 px-4">1</td>
                                        <td class="py-2 px-4">Kayu</td>
                                        <td class="py-2 px-4">1</td>
                                        <td class="py-2 px-4">m</td>
                                        <td class="py-2 px-4">Rp 4.000,00</td>
                                        <td class="py-2 px-4">Rp 4.000,00</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-4">2</td>
                                        <td class="py-2 px-4">Kayu</td>
                                        <td class="py-2 px-4">1</td>
                                        <td class="py-2 px-4">m</td>
                                        <td class="py-2 px-4">Rp 4.000,00</td>
                                        <td class="py-2 px-4">Rp 4.000,00</td>
                                    </tr>
                                    <tr class="border-y-2 border-[#A59898]">
                                        <td class="py-2 px-4"></td>
                                        <td class="py-2 px-4"></td>
                                        <td class="py-2 px-4"></td>
                                        <td class="py-2 px-4"></td>
                                        <td class="py-2 px-4 font-bold">Total</td>
                                        <td class="py-2 px-4 font-bold">Rp 4.000,00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-3 mt-8">
                        <div>
                            <div class="font-bold mb-3">Biaya Produksi</div>

                            <table class="table-fixed w-full text-xs">
                                <thead class="border-y-2 border-[#A59898]">
                                    <tr>
                                        <th class="py-2 px-4 text-start">Deskripsi</th>
                                        <th class="py-2 px-4 text-start">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-2 px-4">Harga Perakitan</td>
                                        <td class="py-2 px-4">Rp 4.000,00</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-4">Harga Perakitan PRJ</td>
                                        <td class="py-2 px-4">Rp 4.000,00</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-4">Harga Grendo</td>
                                        <td class="py-2 px-4">Rp 4.000,00</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-4">Harga Obat</td>
                                        <td class="py-2 px-4">Rp 4.000,00</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-4">Upah</td>
                                        <td class="py-2 px-4">Rp 4.000,00</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-4 text-transparent">d</td>
                                        <td class="py-2 px-4"></td>
                                    </tr>
                                    <tr class="border-y-2 border-[#A59898]">
                                        <td class="py-2 px-4 font-bold">Total</td>
                                        <td class="py-2 px-4 font-bold">Rp 4.000,00</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        <div>
                            <div class="font-bold mb-3">Biaya Packing</div>

                            <table class="table-fixed w-full text-xs">
                                <thead class="border-y-2 border-[#A59898]">
                                    <tr>
                                        <th class="py-2 px-4 text-start">Deskripsi</th>
                                        <th class="py-2 px-4 text-start">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-2 px-4">Harga Box</td>
                                        <td class="py-2 px-4">Rp 4.000,00</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-4">Box Hardware</td>
                                        <td class="py-2 px-4">Rp 4.000,00</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-4">Assembling</td>
                                        <td class="py-2 px-4">Rp 4.000,00</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-4">Stiker</td>
                                        <td class="py-2 px-4">Rp 4.000,00</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-4">Hagtag</td>
                                        <td class="py-2 px-4">Rp 4.000,00</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-4">Maintenance</td>
                                        <td class="py-2 px-4">Rp 4.000,00</td>
                                    </tr>
                                    <tr class="border-y-2 border-[#A59898]">
                                        <td class="py-2 px-4 font-bold">Total</td>
                                        <td class="py-2 px-4 font-bold">Rp 4.000,00</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        <div>
                            <div class="font-bold mb-3">Biaya Lain-Lain</div>

                            <table class="table-fixed w-full text-xs">
                                <thead class="border-y-2 border-[#A59898]">
                                    <tr>
                                        <th class="py-2 px-4 text-start">Deskripsi</th>
                                        <th class="py-2 px-4 text-start">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-2 px-4">Overhead Pabrik</td>
                                        <td class="py-2 px-4">Rp 4.000,00</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-4">Listrik</td>
                                        <td class="py-2 px-4">Rp 4.000,00</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-4">Pajak</td>
                                        <td class="py-2 px-4">Rp 4.000,00</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-4">Export+Usaha</td>
                                        <td class="py-2 px-4">Rp 4.000,00</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-4 text-transparent">d</td>
                                        <td class="py-2 px-4"></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-4 text-transparent">d</td>
                                        <td class="py-2 px-4"></td>
                                    </tr>
                                    <tr class="border-y-2 border-[#A59898]">
                                        <td class="py-2 px-4 font-bold">Total</td>
                                        <td class="py-2 px-4 font-bold">Rp 4.000,00</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-8 w-full text-xs flex justify-end">
                        <div class="w-40">
                            <div class="font-bold mb-2 flex justify-between">HPP<span>: Rp 4.000,00</span>
                            </div>
                            <div class="font-bold flex justify-between">Harga Jual<span>:
                                    Rp 4.000,00</span></div>
                        </div>
                    </div>
                </div>

                <div class="py-[20px] px-[30px] w-full border-t-2 border-[#A59898] flex justify-end items-center">
                    <div class="py-2 px-5 border text-[#768498] text-sm rounded-lg hover:bg-[#F7F9F9]">Kembali</div>
                </div>
            </div> --}}

        </div>
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
            if (columnName === "Aksi") th.classList.add('w-52')
            if (columnName === "Nomor") th.classList.add('w-28')
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
            tr.classList.add("cursor-pointer", "text-sm", "bg-white", "hover:scale-[1.01]", "transition-all",
                "overflow-hidden", "drop-shadow-[0_0_15px_rgba(0,0,0,0.05)]")
            tr.id = "daftar-item";
            tr.height = "30px";
            tr.innerHTML += `<td class="py-2 px-4" class="p-4 rounded-l-lg"><div class="flex items-center justify-center gap-3 border-r h-7 border-slate-200">
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
            <td class="py-2 px-4" onclick="stopPropagation(event)" class="p-4 rounded-r-lg">
                <div class="flex items-center justify-center gap-3 border-l h-7 border-slate-200">
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
            tr.addEventListener("click", (event) => {
                show(data.id)
            })
            tbody.appendChild(tr)
        })
        document.querySelector(".table-fixed").appendChild(tbody)
    }

    function stopPropagation(event) {
        event.stopPropagation();
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

    function hideModal() {
        const modal = document.querySelector("#modal");
        document.querySelector("#modal-background").classList.add("hidden");

        modal.classList.remove('opacity-100', 'z-20');
        modal.classList.add('opacity-0', '-z-20');

        // modal.classList.remove('z-20');
        // modal.classList.add('-z-20');
    }
</script>
@stack('script')

</html>
