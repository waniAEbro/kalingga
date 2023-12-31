<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <link rel="shortcut icon" type="image/png" href="/img/image 6.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-
     alpha/css/bootstrap.css"
        rel="stylesheet"> --}}

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet" />
    @stack('head')
    <style>
        ion-icon {
            --ionicon-stroke-width: 40px;
        }

        [x-cloak] {
            display: none;
        }

        #nav::-webkit-scrollbar {
            display: none;

        }
    </style>
    <title>Kalingga Keling Jati</title>
</head>

<body class="font-['Roboto']">
    <div class="relative flex">
        <x-nav />

        <x-main>
            @yield('content')
        </x-main>

        <div id="modal-background" onclick="hideModal()"
            class="absolute top-0 z-30 hidden w-full h-full bg-black opacity-50">
        </div>

        <div id="modal"
            class="fixed text-[#161414] -z-40 translate-x-1/2 top-20 right-1/2 rounded-xl transition-opacity duration-300 opacity-0">

        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
</body>
<script>
    const state = {
        allData: [],
        data: [],
        currentData: [],
        columnName: [],
        columnQuery: [],
        page: 1,
        rows: 5,
        gridItems: 12,
        isGrid: false,
        menu: ""
    }

    const toastr = new Notyf({
        duration: 3000,
        dismissible: true,
        ripple: true,
        position: {
            x: 'right',
            y: 'top',
        },
    });

    setFilepond();

    function setFilepond() {
        FilePond.registerPlugin(FilePondPluginImagePreview);

        FilePond.create(document.querySelector('input[name="product_image"]'));

        FilePond.setOptions({
            server: {
                process: '/tmp-upload',
                revert: '/tmp-delete',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        })
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

    function toUSD(number) {
        let USDFormat = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'USD',
        }).format(number);
        return USDFormat
    }

    document.querySelectorAll(".rupiah").forEach(element => {
        element.innerText = toRupiah(element.innerText)
    });

    async function searching(text = "") {
        document.querySelector('#search').innerHTML = `<span class="loading loading-spinner loading-sm"></span>`

        await new Promise(() => {
            setTimeout(() => {

                let found = []
                state.allData.forEach(data => {
                    let isFound = false
                    state.columnQuery.forEach(columnQuery => {
                        const query = "data." + columnQuery
                        if (eval(query).toString().toLowerCase().includes(text
                                .toLowerCase())) {
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
            }, 800);

        })

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
            if (columnName === "Aksi") th.classList.add('w-60')
            if (columnName === "Nomor") th.classList.add('w-20')
            if (columnName === "Status") th.classList.add('w-20')
            if (columnName === "#") th.classList.add('w-12')
        })
        thead.appendChild(tr)
        return thead
    }

    async function buildTable() {
        await new Promise(() => {
            if (state.isGrid) {
                const product_grid = document.querySelector('#product-grid');
                product_grid.innerHTML = '';

                state.currentData.forEach((data) => {
                    product_grid.innerHTML += `
                                            <div class="p-5 bg-white rounded-lg">
                                                    <div class="relative overflow-hidden bg-center bg-cover rounded-md h-36"
                                                        style="background-image: url('${data.image ? `/storage/${data.image}` : '/img/default-placeholder.png'}')">
                                                        <div class="absolute w-full h-full bg-gradient-to-t from-gray-800">
                                                            <div class="absolute bottom-3 left-3">
                                                                <div class="text-white">${data.name}</div>
                                                            </div>
                                                        </div>
                                                    </div>
        
                                                    <div class="flex items-center mt-5 text-sm text-gray-600">
                                                        <div class="flex items-center"><ion-icon name="pricetags-outline"></ion-icon><span class="ml-2">Kode Produk</span></div>
                                                        <div>: ${data.code}</div>
                                                    </div>
        
                                                    <div class="flex items-center mt-3 text-sm text-gray-600">
                                                        <div class="flex items-center"><ion-icon name="hardware-chip-outline"></ion-icon><span class="ml-2">Kode RFID</span></div>
                                                        <div>: ${data.rfid}</div>
                                                    </div>
        
                                                    <div class="flex items-center mt-3 text-sm text-gray-600">
                                                        <div class="flex items-center"><ion-icon name="cash-outline"></ion-icon><span class="ml-2">Harga</span></div>
                                                        <div>: ${toRupiah(data.sell_price)}</div>
                                                    </div>

                                                    <hr class="mt-5">

                                                    <div class="flex gap-3 mt-5 text-sm">
                                                        <button onclick="show(${data.id})" class="flex items-center hover:opacity-70"><ion-icon name="eye-outline"></ion-icon><span class="ml-2">Preview</span></button>
                                                        <a href="/${state.menu}/${ data.id }/edit" class="flex items-center hover:opacity-70"><ion-icon name="create-outline"></ion-icon><span class="ml-2">Edit</span></a>
                                                        <form action="/${state.menu}/${ data.id }" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="flex items-center hover:opacity-70 text-red-500"><ion-icon name="trash-outline"></ion-icon><span class="ml-2">Delete</span></button>
                                                        </form>
                                                    </div>
                                                </div>
                                        `
                })
            } else {
                if (document.querySelector("#table-body")) {
                    document.querySelector("#table-body").remove()
                }
                let tbody = document.createElement("tbody")
                tbody.classList.add("text-center")
                tbody.id = "table-body"
                state.currentData.forEach((data, index) => {
                    const tr = document.createElement("tr")
                    tr.classList.add("cursor-pointer", "text-sm", "bg-white", "transition-all",
                        "drop-shadow-[0_0_15px_rgba(0,0,0,0.05)]")
                    tr.id = "daftar-item";
                    tr.height = "30px";
                    tr.setAttribute('x-data', '{ open: false }')
                    tr.innerHTML += `
                        <td>
                            <div class="flex items-center justify-center gap-3 border-r h-7 border-slate-200">
                                ${state.page * state.rows - state.rows + index + 1}
                            </div>
                        </td>`
                    state.columnQuery.forEach(columnQuery => {
                        const query = "data." + columnQuery
                        const td = document.createElement("td")
                        state.menu == "presence" ? "" : td.classList.add("p-4",
                            "break-words", columnQuery
                            .replace(".", "-"))

                        if (columnQuery == 'remain_bill' || columnQuery == 'total_bill') td
                            .innerText =
                            toRupiah(eval(query))
                        else td.innerText = eval(query)

                        tr.appendChild(td)
                    })

                    const download = `
                            <button x-on:click="open = !open" class="flex items-center gap-1 text-slate-600 relative">
                                <div class="hover:opacity-70 flex items-center gap-1">
                                    <span class="text-lg hover:opacity-"><ion-icon name="download-outline"></ion-icon></span>
                                    Unduh
                                </div>
                                <div x-show="open" x-transition x-on:click.outside="open = false" class="absolute left-0 -top-24 bg-white  rounded-lg border-2 border-slate-300 p-2">
                                    <a href="/${state.menu}/${ data.id }/print" target="_blank" class="flex hover:bg-slate-100 rounded-md p-1 rounded w-20 items-center gap-1 text-slate-600">
                                        <span class="text-lg flex items-center"><ion-icon name="print-outline"></ion-icon></span>
                                        Pdf
                                    </a>
                                    <a href="/${state.menu}/${ data.id }/export" target="_blank" class="mt-1 flex w-20 items-center p-1 hover:bg-slate-100 rounded-md gap-1 text-slate-600">
                                        <span class="text-lg flex items-center"><ion-icon name="document-outline"></ion-icon></span>
                                        Excel
                                    </a>
                                </div>
                            </button>`
                    if (state.menu == "presence") {
                        tr.innerHTML += `
                    <td class="px-4 py-2" onclick="stopPropagation(event)" class="p-4 rounded-r-lg">
                        <div class="flex items-center justify-center gap-3 border-l h-7 border-slate-200">
                            <form action="/${state.menu}/${data.id}/excel" method="post">
                                @csrf
                                <input type="hidden" class="tanggal_cetak" name="bulan" value="${(new Date).getFullYear()}-${(new Date).getMonth()+1}" />
                                <button type="submit" class="flex items-center gap-1 text-slate-600">
                                <span class="text-lg"><ion-icon name="document-outline"></ion-icon></span>Excel</button>
                            </form>
                            <form action="/${state.menu}/${data.id}/print" method="post" target="_blank">
                                @csrf
                                <input type="hidden" class="tanggal_cetak" name="bulan" value="${(new Date).getFullYear()}-${(new Date).getMonth()+1}" />
                                <button type="submit" class="flex items-center gap-1 text-slate-600">
                                <span class="text-lg"><ion-icon name="print-outline"></ion-icon></span>Print</button>
                            </form>
                        </div>
                    </td>`
                    } else if (state.columnName.includes("Aksi")) {
                        tr.innerHTML += `
                    <td class="" onclick="stopPropagation(event)">
                        <div class="flex items-center justify-center gap-3 border-l h-7 border-slate-200">
                            <a href="/${state.menu}/${ data.id }/edit" class="flex items-center gap-1 text-slate-600 hover:opacity-70">
                                <span class="text-lg"><ion-icon name="create-outline"></ion-icon></span>Edit
                            </a>
                            ${state.menu == "sales" || state.menu == "purchases" ? download : ""}
                            <form action="/${state.menu}/${ data.id }" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="flex items-center gap-1 text-red-700 hover:opacity-70"><span
                                        class="text-lg"><ion-icon name="trash-outline"></ion-icon></span>Hapus</button>
                            </form>
                        </div>
                    </td>`
                    }
                    tr.addEventListener("click", (event) => {
                        show(data.id)
                    })
                    tbody.appendChild(tr)
                })
                document.querySelector(".table-fixed").appendChild(tbody)
            }

            document.querySelector('#search').innerHTML = `<ion-icon name="search-outline"></ion-icon>`
        })
    }

    function stopPropagation(event) {
        event.stopPropagation();
    }

    function paginate() {
        if (state.isGrid) {
            let trimStart = (state.page - 1) * state.gridItems
            let trimEnd = trimStart + state.gridItems

            let trimmedData = state.data.slice(trimStart, trimEnd)

            state.currentData = trimmedData
        } else {
            let trimStart = (state.page - 1) * state.rows
            let trimEnd = trimStart + state.rows

            let trimmedData = state.data.slice(trimStart, trimEnd)

            state.currentData = trimmedData
        }
    }

    function pageNumber() {
        let pageNumbers = "";
        let pages;
        if (state.isGrid) {
            pages = Math.ceil(state.data.length / state.gridItems);
        } else {
            pages = Math.ceil(state.data.length / state.rows);
        }

        if (pages > 1) {
            let arrowLeft = `
                <button
                    x-on:click="state.page = 1; paginate(); pageNumber(); buildTable();"
                    class="px-3 flex items-center rounded ${state.page == 1 || 'hover:bg-gray-200'} transition-300 transition-all"
                >
                    <span class="material-symbols-outlined" style="font-size: 16px">keyboard_double_arrow_left</span>
                </button>
                <button
                    x-on:click="state.page = ${state.page - 1 || 1}; paginate(); pageNumber(); buildTable();"
                    class="px-3 flex items-center rounded ${state.page == 1 || 'hover:bg-gray-200'} transition-300 transition-all"
                >
                    <span class="material-symbols-outlined" style="font-size: 16px">keyboard_arrow_left</span>
                </button>
            `
            if (pages <= 8) {
                for (i = 1; i <= pages; i++) {
                    pageNumbers +=
                        `<button
                            x-on:click="state.page = ${i}; paginate(); pageNumber(); buildTable();"
                            class="px-4
                                ${state.page == i ?
                                    'flex items-center bg-white drop-shadow-[0_0_15px_rgba(0,0,0,0.05)] rounded' :
                                    'flex items-center rounded hover:bg-gray-200 transition-300 transition-all'
                                }"
                        >
                            ${i}
                        </button>`
                }
            } else {
                if (state.page <= 4) {
                    for (i = 1; i <= 5; i++) {
                        pageNumbers +=
                            `<button
                                x-on:click="state.page = ${i}; paginate(); pageNumber(); buildTable();"
                                class="px-4
                                    ${state.page == i ?
                                        'flex items-center bg-white drop-shadow-[0_0_15px_rgba(0,0,0,0.05)] rounded' :
                                        'flex items-center rounded hover:bg-gray-200 transition-300 transition-all'
                                    }"
                            >
                                ${i}
                            </button>`
                    }

                    pageNumbers += `<div class="flex items-center px-4">...</div>`

                    pageNumbers +=
                        `<button 
                                x-on:click="state.page = ${pages}; paginate(); pageNumber(); buildTable();" 
                                class="flex items-center px-4 transition-all rounded hover:bg-gray-200 transition-300"
                            >
                                ${pages}
                            </button>`
                } else if (state.page >= pages - 4) {
                    pageNumbers +=
                        `<button 
                                x-on:click="state.page = 1; paginate(); pageNumber(); buildTable();" 
                                class="flex items-center px-4 transition-all rounded hover:bg-gray-200 transition-300"
                            >
                                1
                            </button>`

                    pageNumbers += `<div class="flex items-center px-4">...</div>`

                    for (i = pages - 5; i <= pages; i++) {
                        pageNumbers +=
                            `<button
                                x-on:click="state.page = ${i}; paginate(); pageNumber(); buildTable();"
                                class="px-4
                                    ${state.page == i ?
                                        'flex items-center bg-white drop-shadow-[0_0_15px_rgba(0,0,0,0.05)] rounded' :
                                        'flex items-center rounded hover:bg-gray-200 transition-300 transition-all'
                                    }"
                            >
                            ${i}
                            </button>`
                    }
                } else {
                    pageNumbers += `<div class="flex items-center px-4">...</div>`

                    for (i = state.page - 1; i <= state.page + 1; i++) {
                        pageNumbers +=
                            `<button
                                x-on:click="state.page = ${i}; paginate(); pageNumber(); buildTable();"
                                class="px-4
                                    ${state.page == i ?
                                        'flex items-center bg-white drop-shadow-[0_0_15px_rgba(0,0,0,0.05)] rounded' :
                                        'flex items-center rounded hover:bg-gray-200 transition-300 transition-all'
                                    }"
                            >
                            ${i}
                            </button>`
                    }

                    pageNumbers += `<div class="flex items-center px-4">...</div>`
                }
            }

            let arrowRight = `
                <button
                    x-on:click="state.page = ${state.page + 1 == pages || pages}; paginate(); pageNumber(); buildTable();"
                    class="px-3 flex items-center rounded ${state.page == pages || 'hover:bg-gray-200'} transition-300 transition-all"
                >
                    <span class="material-symbols-outlined" style="font-size: 16px">keyboard_arrow_right</span>
                </button>
                <button
                    x-on:click="state.page = ${pages}; paginate(); pageNumber(); buildTable();"
                    class="px-3 flex items-center rounded ${state.page == pages || 'hover:bg-gray-200'} transition-300 transition-all"
                >
                    <span class="material-symbols-outlined" style="font-size: 16px">keyboard_double_arrow_right</span>
                </button>
            `

            document.querySelector("#pagination-wrapper").innerHTML = arrowLeft + pageNumbers + arrowRight
        } else {
            document.querySelector("#pagination-wrapper").innerHTML = '';
        }

    }

    function hideModal() {
        const modal = document.querySelector("#modal");
        document.querySelector("#modal-background").classList.add("hidden");

        modal.classList.remove('opacity-100', 'z-40');
        modal.classList.add('opacity-0', '-z-40');
    }
</script>
@stack('script')

</html>
