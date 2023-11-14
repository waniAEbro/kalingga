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
            class="absolute text-[#161414] -z-40 translate-x-1/2 top-20 right-1/2 rounded-xl transition-opacity duration-300 opacity-0">

        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
</body>
<script>
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

    const toastr = new Notyf({
        duration: 3000,
        dismissible: true,
        ripple: true,
        position: {
            x: 'right',
            y: 'top',
        },
    });

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
            if (columnName === "Aksi") th.classList.add('w-60')
            if (columnName === "Nomor") th.classList.add('w-20')
            if (columnName === "Status") th.classList.add('w-20')
            if (columnName === "#") th.classList.add('w-12')
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
            tr.innerHTML += `
                <td>
                    <div class="flex items-center justify-center gap-3 border-r h-7 border-slate-200">
                        ${state.page * state.rows - state.rows + index + 1}
                    </div>
                </td>`
            state.columnQuery.forEach(columnQuery => {
                const query = "data." + columnQuery
                const td = document.createElement("td")
                state.menu == "presence" ? "" : td.classList.add("p-4", "break-words", columnQuery
                    .replace(".", "-"))

                if (columnQuery == 'remain_bill' || columnQuery == 'total_bill') td.innerText =
                    toRupiah(eval(query))
                else td.innerText = eval(query)

                tr.appendChild(td)
            })
            const button = `<a href="/${state.menu}/${ data.id }/print" target="_blank" class="flex items-center gap-1 text-slate-600">
                        <span class="text-lg"><ion-icon name="print-outline"></ion-icon></span>Print
                    </a>`
            const excelButton = `<a href="/${state.menu}/${ data.id }/export" target="_blank" class="flex items-center gap-1 text-slate-600">
                        <span class="text-lg"><ion-icon name="document-outline"></ion-icon></span>Excel
                    </a>`
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
                    <a href="/${state.menu}/${ data.id }/edit" class="flex items-center gap-1 text-slate-600">
                        <span class="text-lg"><ion-icon name="create-outline"></ion-icon></span>Edit
                    </a>
                    ${state.menu == "sales" || state.menu == "purchases" ? button : ""}
                    ${state.menu == "sales" || state.menu == "purchases" ? excelButton : ""}
                    <form action="/${state.menu}/${ data.id }" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="flex items-center gap-1 text-red-700"><span
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
        let pageNumbers = "";
        let pages = Math.ceil(state.data.length / state.rows);

        if(pages){
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
            if(pages <= 8){
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
            }else{
                if(state.page <= 4){
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

                    pageNumbers += `<div class="px-4 flex items-center">...</div>`

                    pageNumbers +=
                            `<button
                                x-on:click="state.page = ${pages}; paginate(); pageNumber(); buildTable();"
                                class="px-4 flex items-center rounded hover:bg-gray-200 transition-300 transition-all"
                            >
                                ${pages}
                            </button>`
                }else if(state.page >= pages - 4){
                    pageNumbers +=
                            `<button
                                x-on:click="state.page = ${1}; paginate(); pageNumber(); buildTable();"
                                class="px-4 flex items-center rounded hover:bg-gray-200 transition-300 transition-all"
                            >
                                ${1}
                            </button>`

                    pageNumbers += `<div class="px-4 flex items-center">...</div>`

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
                }else{
                    pageNumbers += `<div class="px-4 flex items-center">...</div>`

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

                    pageNumbers += `<div class="px-4 flex items-center">...</div>`
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
        }

    }

    function hideModal() {
        const modal = document.querySelector("#modal");
        document.querySelector("#modal-background").classList.add("hidden");

        modal.classList.remove('opacity-100', 'z-40');
        modal.classList.add('opacity-0', '-z-40');

        // modal.classList.remove('z-20');
        // modal.classList.add('-z-20');
    }
</script>
@stack('script')

</html>
