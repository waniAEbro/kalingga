@extends('layouts.layout')

@section('content')
    <div class="text-xl font-bold mb-10 text-center">Penjualan</div>
    <div class="h-min-[580px] relative">
        <table id="table-purchase" class="w-full mt-5 border-separate table-fixed border-spacing-y-3">
            <thead>
                <tr>
                    <th class="px-4 py-5 font-[500] w-28">#</th>
                    <th class="px-4 py-5 font-[500] w-28">Kode Transaksi</th>
                    <th class="px-4 py-5 font-[500] w-28">Pelanggan</th>
                    <th class="px-4 py-5 font-[500] w-28">Tanggal Transaksi</th>
                    <th class="px-4 py-5 font-[500] w-28">Total Transaksi</th>
                    <th class="px-4 py-5 font-[500] w-28">Aksi</th>
                </tr>
            </thead>
            <tbody id="table-body">
                @foreach ($sales as $no => $sale)
                    <tr x-data onclick="showSale({{ $sale->id }})"
                        class="cursor-pointer text-sm bg-white transition-all overflow-hidden drop-shadow-[0_0_15px_rgba(0,0,0,0.05)] text-center">
                        <td class="px-4 py-2">
                            <div class="flex items-center justify-center gap-3 border-r h-7 border-slate-200">
                                {{ $no + 1 }}</div>
                        </td>
                        <td class="p-4 break-words">{{ $sale->code }}</td>
                        <td class="p-4 break-words">{{ $sale->customer->name }}</td>
                        <td class="p-4 break-words">{{ date('Y-m-d', strtotime($sale->sale_date)) }}</td>
                        <td class="p-4 break-word" x-text="toRupiah({{ $sale->total_bill }})"></td>
                        <td class="px-4 py-2" onclick="stopPropagation(event)" class="p-4 rounded-r-lg">
                            <div class="flex items-center justify-center gap-3 border-l h-7 border-slate-200">
                                <a href="/sales/{{ $sale->id }}/print" target="_blank"
                                    class="flex items-center gap-1 text-slate-600 hover:opacity-70">
                                    <span class="text-lg"><ion-icon name="print-outline"></ion-icon></span>Print
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <hr class=" my-10">
        <div class="text-xl font-bold mb-10 text-center">Pembelian</div>
        <table id="table-purchase" class="w-full mt-5 border-separate table-fixed border-spacing-y-3">
            <thead>
                <tr>
                    <th class="px-4 py-5 font-[500] w-28">#</th>
                    <th class="px-4 py-5 font-[500] w-28">Kode Transaksi</th>
                    <th class="px-4 py-5 font-[500] w-28">Pemasok</th>
                    <th class="px-4 py-5 font-[500] w-28">Tanggal Transaksi</th>
                    <th class="px-4 py-5 font-[500] w-28">Total Transaksi</th>
                    <th class="px-4 py-5 font-[500] w-28">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchases as $no => $purchase)
                    <tr x-data onclick="showPurchase({{ $purchase->id }})"
                        class="cursor-pointer text-sm bg-white transition-all overflow-hidden drop-shadow-[0_0_15px_rgba(0,0,0,0.05)] text-center">
                        <td class="px-4 py-2">
                            <div class="flex items-center justify-center gap-3 border-r h-7 border-slate-200">
                                {{ $no + 1 }}</div>
                        </td>
                        <td class="p-4 break-words">{{ $purchase->code }}</td>
                        <td class="p-4 break-words">{{ $purchase->supplier->name }}</td>
                        <td class="p-4 break-words">{{ date('Y-m-d', strtotime($purchase->purchase_date)) }}</td>
                        <td class="p-4 break-word" x-text="toRupiah({{ $purchase->total_bill }})"></td>
                        <td class="px-4 py-2" onclick="stopPropagation(event)" class="p-4 rounded-r-lg">
                            <div class="flex items-center justify-center gap-3 border-l h-7 border-slate-200">
                                <a href="/purchases/{{ $purchase->id }}/print" target="_blank"
                                    class="flex items-center gap-1 text-slate-600 hover:opacity-70">
                                    <span class="text-lg"><ion-icon name="print-outline"></ion-icon></span>Print
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endsection
    @push('script')
        <script>
            const purchases = @json($purchases);
            const sales = @json($sales);

            function showPurchase(id) {
                const purchase = purchases.find(data => data.id === id);

                const modal = document.querySelector('#modal');
                document.querySelector('#modal-background').classList.remove('hidden');

                modal.classList.remove('opacity-0', '-z-40');
                modal.classList.add('opacity-100', 'z-40');

                let components_lists = '';
                let components_price = 0;
                purchase.components.forEach((cp, i) => {
                    components_price += cp.pivot.quantity * cp.price_per_unit;
                    console.log(components_price)

                    components_lists += `<tr>
                            <td class="px-4 py-2">${i+1}</td>
                            <td class="px-4 py-2">${cp.name}</td>
                            <td class="px-4 py-2">${cp.pivot.quantity}</td>
                            <td class="px-4 py-2">${cp.unit}</td>
                            <td class="px-4 py-2">${toRupiah(cp.price_per_unit)}</td>
                            <td class="px-4 py-2">${toRupiah(cp.price_per_unit*cp.pivot.quantity)}</td>
                        </tr>`;
                })

                components_lists += `<tr class="border-gray-200 border-y-2">
                        <td class="px-4 py-2"></td>
                        <td class="px-4 py-2"></td>
                        <td class="px-4 py-2"></td>
                        <td class="px-4 py-2"></td>
                        <td class="px-4 py-2 font-bold">Total</td>
                        <td class="px-4 py-2 font-bold">${toRupiah(components_price)}</td>
                    </tr>`

                let history_lists = '';
                let total_dibayar = 0;
                purchase.histories.forEach((hs, i) => {
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
                    <div class="text-xl font-bold">Detail Pembelian</div>
                    <div onclick="hideModal()" class="absolute flex items-center p-1 text-2xl rounded-full cursor-pointer right-5 hover:bg-slate-100"><ion-icon name="close-outline"></ion-icon>
                    </div>
                </div>

                <div class="grid w-full grid-cols-[0.7fr_1.3fr] px-[30px] py-5 overscroll-none h-[380px] overflow-y-scroll">
                    <div class="w-full">
                        <div class="mb-5 font-bold">Informasi Pemasok</div>

                        <div class="grid grid-cols-[0.9fr_1.1fr] w-[280px] mb-1 text-xs">
                            <div class="flex justify-between">
                                <div class="font-bold">Nama Pemasok</div>
                                <div class="whitespace-pre">: </div>
                            </div>
                            <div>${purchase.supplier.name}</div>
                        </div>

                        <div class="grid grid-cols-[0.9fr_1.1fr] w-[280px] text-xs mb-1">
                            <div class="flex justify-between">
                                <div class="font-bold">Alamat Pemasok</div>
                                <div class="whitespace-pre">: </div>
                            </div>
                            <div>${purchase.supplier.address}</div>
                        </div>

                        <div class="grid grid-cols-[0.9fr_1.1fr] w-[280px] text-xs mb-1">
                            <div class="flex justify-between">
                                <div class="font-bold">Email Pemasok</div>
                                <div class="whitespace-pre">: </div>
                            </div>
                            <div class="break-all">${purchase.supplier.email}</div>
                        </div>

                        <div class="grid grid-cols-[0.9fr_1.1fr] w-[280px] text-xs mb-1">
                            <div class="flex justify-between">
                                <div class="font-bold">No Hp Pemasok</div>
                                <div class="whitespace-pre">: </div>
                            </div>
                            <div>${purchase.supplier.phone}</div>
                        </div>

                        <div class="my-5 font-bold">Informasi Penjualan</div>

                        <div class="grid grid-cols-[0.9fr_1.1fr] w-[280px] mb-1 text-xs">
                            <div class="flex justify-between">
                                <div class="font-bold">Tanggal Penjualan</div>
                                <div class="whitespace-pre">: </div>
                            </div>
                            <div>${purchase.purchase_date}</div>
                        </div>

                        <div class="grid grid-cols-[0.9fr_1.1fr] w-[280px] mb-1 text-xs">
                            <div class="flex justify-between">
                                <div class="font-bold">Tanggal Jatuh Tempo</div>
                                <div class="whitespace-pre">: </div>
                            </div>
                            <div>${purchase.due_date}</div>
                        </div>

                        <div class="grid grid-cols-[0.9fr_1.1fr] w-[280px] text-xs mb-1">
                            <div class="flex justify-between">
                                <div class="font-bold">Kode Penjualan</div>
                                <div class="whitespace-pre">: </div>
                            </div>
                            <div>${purchase.code}</div>
                        </div>

                        <div class="grid grid-cols-[0.9fr_1.1fr] w-[280px] text-xs mb-1">
                            <div class="flex justify-between">
                                <div class="font-bold">Total</div>
                                <div class="whitespace-pre">: </div>
                            </div>
                            <div>${toRupiah(purchase.total_bill)}</div>
                        </div>

                        <div class="grid grid-cols-[0.9fr_1.1fr] w-[280px] text-xs mb-1">
                            <div class="flex justify-between">
                                <div class="font-bold">Sudah Dibayar</div>
                                <div class="whitespace-pre">: </div>
                            </div>
                            <div>${toRupiah(purchase.total_bill-purchase.remain_bill)}</div>
                        </div>

                        <div class="grid grid-cols-[0.9fr_1.1fr] w-[280px] text-xs mb-1">
                            <div class="flex justify-between">
                                <div class="font-bold">Sisa</div>
                                <div class="whitespace-pre">: </div>
                            </div>
                            <div>${toRupiah(purchase.remain_bill)}</div>
                        </div>

                    </div>

                    <div class="w-full">
                        <div class="mb-5 font-bold">Komponen</div>

                        <table class="w-full text-xs table-fixed">
                            <thead class="border-gray-200 border-y-2">
                                <tr>
                                    <th class="w-10 px-4 py-2">No</th>
                                    <th class="w-20 px-4 py-2 text-start">Komponen</th>
                                    <th class="w-20 px-4 py-2 text-start">Jumlah</th>
                                    <th class="w-10 px-4 py-2 text-start">Unit</th>
                                    <th class="px-4 py-2 text-start">Harga per Satuan</th>
                                    <th class="px-4 py-2 text-start">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${components_lists}
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

            function showSale(id) {
                const sale = sales.find(data => data.id === id);
                console.log('sale', sale)

                const modal = document.querySelector('#modal');
                document.querySelector('#modal-background').classList.remove('hidden');

                modal.classList.remove('opacity-0', '-z-40');
                modal.classList.add('opacity-100', 'z-40');

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

                <div class="grid w-full grid-cols-[0.7fr_1.3fr] px-[30px] py-5 overscroll-none  h-[380px] overflow-y-scroll">
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
