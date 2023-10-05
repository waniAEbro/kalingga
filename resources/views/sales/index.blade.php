{{-- @dd($sales) --}}
@extends('layouts.layout')

@section('content')
    <div class="flex gap-5 mb-10">
        <div class="relative flex items-end justify-center w-full h-40 group">
            <div
                class="w-[90%] group-hover:scale-110 transition duration-500 h-20 bg-slate-50 shadow-[0px_3px_20px_#0000000b] rounded-xl z-0">
            </div>
            <div
                class="w-full group-hover:scale-110 transition duration-500 h-40 p-5 rounded-xl shadow-[0px_3px_20px_#0000000b] absolute -top-3 bg-white">
                <ion-icon class="text-3xl text-red-500" name="today-outline"></ion-icon>
                <h1 id="pembayaran_jatuh_tempo" class="font-bold text-2xl mt-4 text-[#1E293B]"></h1>
                <div class="text-[#707E94] mt-2">Pembayaran Jatuh Tempo</div>
            </div>
        </div>
        <div class="relative flex items-end justify-center w-full h-40 group">
            <div
                class="w-[90%] group-hover:scale-110 transition duration-500 h-20 bg-slate-50 shadow-[0px_3px_20px_#0000000b] rounded-xl z-0">
            </div>
            <div
                class="w-full group-hover:scale-110 transition duration-500 h-40 p-5 rounded-xl shadow-[0px_3px_20px_#0000000b] absolute -top-3 bg-white">
                <ion-icon class="text-3xl text-yellow-500" name="time-outline"></ion-icon>
                <h1 id="pembayaran_belum_selesai" class="font-bold text-2xl mt-4 text-[#1E293B]"></h1>
                <div class="text-[#707E94] mt-2">Pembayaran Belum Selesai</div>
            </div>
        </div>
        <div class="relative flex items-end justify-center w-full h-40 group">
            <div
                class="w-[90%] group-hover:scale-110 transition duration-500 h-20 bg-slate-50 shadow-[0px_3px_20px_#0000000b] rounded-xl z-0">
            </div>
            <div
                class="w-full group-hover:scale-110 transition duration-500 h-40 p-5 rounded-xl shadow-[0px_3px_20px_#0000000b] absolute -top-3 bg-white">
                <ion-icon class="text-3xl text-green-600" name="checkmark-done-circle-outline"></ion-icon>
                <h1 id="pembayaran_lunas" class="font-bold text-2xl mt-4 text-[#1E293B]"></h1>
                <div class="text-[#707E94] mt-2">Pembayaran Lunas</div>
            </div>
        </div>
    </div>

    <x-data-list>
        <div class="h-[580px] relative">
            <table class="w-full mt-5 border-separate table-fixed border-spacing-y-3">
                <thead>
                    <tr class="text-center">
                        <th class="px-4 py-5 font-[500] w-14">No</th>
                        <th class="px-4 py-5 font-[500]">Pelanggan</th>
                        <th class="px-4 py-5 font-[500]">Tanggal Penjualan</th>
                        <th class="px-4 py-5 font-[500]">Tanggal Jatuh Tempo</th>
                        <th class="px-4 py-5 font-[500] w-20">Status</th>
                        <th class="px-4 py-5 font-[500]">Sisa Bayar</th>
                        <th class="px-4 py-5 font-[500]">Total Pembayaran</th>
                        <th class="px-4 py-5 font-[500] w-[200px]">Aksi</th>
                    </tr>
                </thead>
                <tbody id="table-body" class="text-center ">

                </tbody>
            </table>
            <div id="pagination-wrapper" class="absolute bottom-0 flex h-10 gap-2 my-5 text-sm"></div>
        </div>
    </x-data-list>
@endsection
@push('script')
    <script>
        // let ngetes = [{
        //     nama,
        //     orang,
        //     tolol: {
        //         kocak,
        //         apalah,
        //         entahlah: ['aku', 'bingung', 'kocak']
        //     }
        // }]

        let sales = {!! $sales !!}

        let state = {
            'querySet': sales,

            'page': 1,
            'rows': 5,
            'window': 5,
            'no': 1
        }

        let currentDate = new Date();

        buildTable()
        set_belum_selesai()
        set_jatuh_tempo()
        set_lunas()
        document.querySelectorAll(".rupiah").forEach(element => {
            element.innerText = toRupiah(element.innerText)
        });

        function search(query) {
            query = query.toLowerCase();
            state.querySet = [];
            // const results = [];

            for (const sale of sales) {
                if (
                    sale.customer.name.toLowerCase().includes(query) ||
                    String(sale.sale_date).toLowerCase().includes(query) ||
                    String(sale.due_date).toLowerCase().includes(query) ||
                    sale.status.toLowerCase().includes(query) ||
                    String(sale.remain_bill).toLowerCase().includes(query) ||
                    String(sale.total_bill).toLowerCase().includes(query)
                ) {
                    state.querySet.push(sale);
                }
            }
            buildTable();
            console.log(state.querySet)
        }

        function set_belum_selesai() {
            let filteredData = sales.filter(item => {
                let dueDate = new Date(item.due_date);
                return dueDate > currentDate;
            });

            let belum_selesai = 0

            if (filteredData.length > 0) {
                belum_selesai = filteredData.reduce((total, data) => total + data.remain_bill, 0)
            }

            document.getElementById("pembayaran_belum_selesai").innerText = toRupiah(belum_selesai);
            console.log(toRupiah(belum_selesai))
        }

        function set_lunas() {
            let lunas = sales.reduce((total, data) => {
                let paid = data.histories.reduce((acc, cur) => cur.payment + acc, 0)

                return total + paid
            }, 0)

            document.getElementById("pembayaran_lunas").innerText = toRupiah(lunas);
            console.log(toRupiah(lunas))
        }

        function set_jatuh_tempo() {
            let filteredData = sales.filter(item => {
                let dueDate = new Date(item.due_date)
                return dueDate < currentDate
            })

            let jatuh_tempo = 0

            if (filteredData.length > 0) {
                jatuh_tempo = filteredData.reduce((total, data) => total + data.remain_bill, 0)
            }

            document.getElementById("pembayaran_jatuh_tempo").innerText = toRupiah(jatuh_tempo);
            console.log(toRupiah(jatuh_tempo))
        }

        function toRupiah(number) {
            let rupiahFormat = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
            }).format(number);
            return rupiahFormat
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
            document.getElementById('table-body').innerHTML = '';

            state.page = Number(value);

            buildTable();
        }

        function buildTable(querySet = state.querySet) {
            let table = document.getElementById('table-body');


            let data = pagination(state.querySet, state.page, state.rows)
            state.querySet.length && pageButtons(data.pages, data.trimStart)

            let myList = data.querySet

            myList.forEach(list => {
                let row = `
                <tr id="daftar-item" class="text-sm bg-white drop-shadow-[0_0_15px_rgba(0,0,0,0.05)]">
                            <td class="p-4 border-r rounded-l-lg border-slate-200">${ ++data.trimStart }</td>
                            <td class="p-4 break-words">${ list.customer.name }</td>
                            <td class="p-4 break-words">${ list.sale_date }</td>
                            <td class="p-4 break-words">${ list.due_date }</td>
                            <td class="p-4 break-words">${ list.status }</td>
                            <td class="p-4 break-words rupiah">${ list.remain_bill }</td>
                            <td class="p-4 break-words rupiah">${ list.total_bill }</td>
                            <td class="p-4 rounded-r-lg">
                                <div class="flex items-center justify-center gap-3 border-l h-7 border-slate-200">
                                    <a href="/sales/${ list.id }/edit"
                                        class="flex items-center gap-1 text-slate-600"><span class="text-lg"><ion-icon
                                                name="create-outline"></ion-icon></span>Edit</a>
                                    <form action="/sales/${ list.id }" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="flex items-center gap-1 text-red-700"><span class="text-lg"><ion-icon
                                                    name="trash-outline"></ion-icon></span>Delete</button>
    
                                    </form>
                                </div>
    
                            </td>
                        </tr>`
                table.innerHTML += row

            })

        }
    </script>
@endpush
