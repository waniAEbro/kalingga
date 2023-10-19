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
            </table>
            <div id="pagination-wrapper" class="absolute bottom-0 flex h-10 gap-2 my-5 text-sm"></div>
        </div>
    </x-data-list>
@endsection
@push('script')
    <script>
        state.columnName = ["Nomor", "Nama Customer", "Tanggal Transaksi", "Jatuh Tempo", "Status", "Sisa Transaksi",
            "Total Transaksi", "Aksi"
        ]
        state.columnQuery = ["customer.name", "sale_date", "due_date", "status", "remain_bill", "total_bill"]
        state.menu = "sales"

        document.querySelector(".table-fixed").appendChild(buildHeader())

        const sales = {!! $sales !!}

        state.data = sales
        state.allData = sales

        paginate()
        pageNumber()
        buildTable()

        let currentDate = new Date();

        set_belum_selesai()
        set_jatuh_tempo()
        set_lunas()
        document.querySelectorAll(".rupiah").forEach(element => {
            element.innerText = toRupiah(element.innerText)
        });

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

        function show(id) {
            const sale = sales.find(data => data.id === id);

            const modal = document.querySelector('#modal');
            document.querySelector('#modal-background').classList.remove('hidden');

            modal.classList.remove('opacity-0', '-z-20');
            modal.classList.add('opacity-100', 'z-20');

            let products_lists = '';
            let products_price = 0;
            sale.products.forEach((pr, i) => {
                products_price += pr.pivot.quantity * pr.sell_price;
                console.log(products_price)

                products_lists += `<tr>
                            <td class="px-4 py-2">${i+1}</td>
                            <td class="px-4 py-2">${pr.name}</td>
                            <td class="px-4 py-2">${pr.pivot.quantity}</td>
                            <td class="px-4 py-2">${toRupiah(pr.sell_price)}</td>
                            <td class="px-4 py-2">${toRupiah(pr.sell_price*pr.pivot.quantity)}</td>
                        </tr>`;
            })

            products_lists += `<tr class="border-gray-200 border-y-2">
                        <td class="px-4 py-2"></td>
                        <td class="px-4 py-2"></td>
                        <td class="px-4 py-2"></td>
                        <td class="px-4 py-2 font-bold">Total</td>
                        <td class="px-4 py-2 font-bold">${toRupiah(products_price)}</td>
                    </tr>`

            let history_lists = '';
            let total_dibayar = 0;
            sale.histories.forEach((hs, i) => {
                total_dibayar += hs.payment;

                history_lists += `
                                <tr>
                                    <td class="px-4 py-2">${i+1}</td>
                                    <td class="px-4 py-2">${hs.created_at.split('T')[0]}</td>
                                    <td class="px-4 py-2">${toRupiah(hs.payment)}</td>
                                    <td class="px-4 py-2">${hs.description}</td>
                                </tr>`
            })

            history_lists += `<tr class="border-gray-200 border-y-2">
                                    <td class="px-4 py-2"></td>
                                    <td class="px-4 py-2 font-bold">Total</td>
                                    <td class="px-4 py-2 font-bold">${toRupiah(total_dibayar)}</td>
                                    <td class="px-4 py-2"></td>
                                </tr>`

            modal.innerHTML = `
            <div class="w-[960px] bg-white rounded-xl">
                <div class="py-[20px] px-[30px] w-full relative border-b-2 border-gray-200 flex justify-between items-center">
                    <div class="text-xl font-bold">Detail Penjualan</div>
                    <div onclick="hideModal()" class="absolute flex items-center p-1 text-2xl rounded-full cursor-pointer right-5 hover:bg-slate-100"><ion-icon name="close-outline"></ion-icon>
                    </div>
                </div>

                <div class="grid w-full grid-cols-[0.7fr_1.3fr] px-[30px] my-5">
                    <div class="w-full">
                        <div class="mb-5 font-bold">Informasi Pelanggan</div>

                        <div class="grid grid-cols-[0.9fr_1.1fr] w-[280px] mb-1 text-xs">
                            <div class="flex justify-between">
                                <div class="font-bold">Nama Pelanggan</div>
                                <div class="whitespace-pre">: </div>
                            </div>
                            <div>${sale.customer.name}</div>
                        </div>

                        <div class="grid grid-cols-[0.9fr_1.1fr] w-[280px] text-xs mb-1">
                            <div class="flex justify-between">
                                <div class="font-bold">Alamat Pelanggan</div>
                                <div class="whitespace-pre">: </div>
                            </div>
                            <div>${sale.customer.address}</div>
                        </div>

                        <div class="grid grid-cols-[0.9fr_1.1fr] w-[280px] text-xs mb-1">
                            <div class="flex justify-between">
                                <div class="font-bold">Email Pelanggan</div>
                                <div class="whitespace-pre">: </div>
                            </div>
                            <div class="break-all">${sale.customer.email}</div>
                        </div>

                        <div class="grid grid-cols-[0.9fr_1.1fr] w-[280px] text-xs mb-1">
                            <div class="flex justify-between">
                                <div class="font-bold">No Hp Pelanggan</div>
                                <div class="whitespace-pre">: </div>
                            </div>
                            <div>${sale.customer.phone}</div>
                        </div>

                        <div class="my-5 font-bold">Informasi Penjualan</div>

                        <div class="grid grid-cols-[0.9fr_1.1fr] w-[280px] mb-1 text-xs">
                            <div class="flex justify-between">
                                <div class="font-bold">Tanggal Penjualan</div>
                                <div class="whitespace-pre">: </div>
                            </div>
                            <div>${sale.sale_date}</div>
                        </div>

                        <div class="grid grid-cols-[0.9fr_1.1fr] w-[280px] mb-1 text-xs">
                            <div class="flex justify-between">
                                <div class="font-bold">Tanggal Jatuh Tempo</div>
                                <div class="whitespace-pre">: </div>
                            </div>
                            <div>${sale.due_date}</div>
                        </div>

                        <div class="grid grid-cols-[0.9fr_1.1fr] w-[280px] text-xs mb-1">
                            <div class="flex justify-between">
                                <div class="font-bold">Kode Penjualan</div>
                                <div class="whitespace-pre">: </div>
                            </div>
                            <div>${sale.code}</div>
                        </div>

                        <div class="grid grid-cols-[0.9fr_1.1fr] w-[280px] text-xs mb-1">
                            <div class="flex justify-between">
                                <div class="font-bold">Total</div>
                                <div class="whitespace-pre">: </div>
                            </div>
                            <div>${toRupiah(sale.total_bill)}</div>
                        </div>

                        <div class="grid grid-cols-[0.9fr_1.1fr] w-[280px] text-xs mb-1">
                            <div class="flex justify-between">
                                <div class="font-bold">Sudah Dibayar</div>
                                <div class="whitespace-pre">: </div>
                            </div>
                            <div>${toRupiah(sale.total_bill-sale.remain_bill)}</div>
                        </div>

                        <div class="grid grid-cols-[0.9fr_1.1fr] w-[280px] text-xs mb-1">
                            <div class="flex justify-between">
                                <div class="font-bold">Sisa</div>
                                <div class="whitespace-pre">: </div>
                            </div>
                            <div>${toRupiah(sale.remain_bill)}</div>
                        </div>

                    </div>

                    <div class="w-full">
                        <div class="mb-5 font-bold">Produk</div>

                        <table class="w-full text-xs table-fixed">
                            <thead class="border-gray-200 border-y-2">
                                <tr>
                                    <th class="w-10 px-4 py-2">No</th>
                                    <th class="w-20 px-4 py-2 text-start">Produk</th>
                                    <th class="w-20 px-4 py-2 text-start">Jumlah</th>
                                    <th class="px-4 py-2 text-start">Harga per Produk</th>
                                    <th class="px-4 py-2 text-start">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${products_lists}
                            </tbody>
                        </table>

                        <div class="my-5 font-bold">History Pembayaran</div>

                        <table class="w-full text-xs table-fixed">
                            <thead class="border-gray-200 border-y-2">
                                <tr>
                                    <th class="w-10 px-4 py-2">No</th>
                                    <th class="px-4 py-2 text-start">Tanggal</th>
                                    <th class="px-4 py-2 text-start">Bayar</th>
                                    <th class="px-4 py-2 text-start">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${history_lists}
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="py-[20px] px-[30px] w-full flex justify-end items-center">
                    <div onclick="hideModal()" class="py-2 px-5 cursor-pointer border text-[#768498] text-sm rounded-lg hover:bg-[#F7F9F9]">Kembali</div>
                </div>
            </div>
            `
        }
    </script>
@endpush
