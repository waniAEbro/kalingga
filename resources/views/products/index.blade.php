@extends('layouts.layout')

@section('content')
    <x-data-list>
        <div class="h-[550px] relative">
            <table class="w-full mt-5 border-separate table-fixed border-spacing-y-3">
            </table>
            <div id="pagination-wrapper" class="absolute bottom-0 flex h-10 gap-2 my-5 text-sm"></div>
        </div>
    </x-data-list>
@endsection

@push('script')
    <script>
        state.columnName = ["Nomor", "Nama Produk", "Kode Produk", "RFID", "Harga Jual", "Aksi"]
        state.columnQuery = ["name", "code", "rfid", "sell_price"]
        state.menu = "products"

        document.querySelector(".table-fixed").appendChild(buildHeader())

        const products = {!! $products !!}

        state.data = products
        state.allData = products

        paginate()
        pageNumber()
        buildTable()

        function show(id) {
            const product = products.find(data => data.id === id);

            const modal = document.querySelector('#modal');
            document.querySelector('#modal-background').classList.remove('hidden');

            modal.classList.remove('opacity-0', '-z-20');
            modal.classList.add('opacity-100', 'z-20');

            let components_lists = '';
            let components_price = 0;
            product.components.forEach((cp, i) => {
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

            let total_produksi = toRupiah(product.production_costs.price_perakitan + product.production_costs
                .price_perakitan_prj + product.production_costs.price_grendo + product.production_costs.price_obat +
                product.production_costs.upah);

            let total_packing = toRupiah(product.pack.box_price + product.pack.box_hardware + product.pack.assembling +
                product.pack.stiker + product.pack.hagtag + product.pack.maintenance)

            let total_lain_lain = toRupiah(product.other_costs.biaya_overhead_pabrik + product.other_costs
                .biaya_listrik + product.other_costs.biaya_pajak + product.other_costs.biaya_ekspor)

            let hpp = toRupiah(product.production_costs.price_perakitan + product.production_costs
                .price_perakitan_prj + product.production_costs.price_grendo + product.production_costs.price_obat +
                product.production_costs.upah + product.pack.box_price + product.pack.box_hardware + product.pack
                .assembling +
                product.pack.stiker + product.pack.hagtag + product.pack.maintenance + product.other_costs
                .biaya_overhead_pabrik + product.other_costs
                .biaya_listrik + product.other_costs.biaya_pajak + product.other_costs.biaya_ekspor);

            modal.innerHTML = `
            <div class="w-[960px] bg-white rounded-xl text-gray-800">
                <div class="py-[20px] px-[30px] w-full relative border-b-2 border-gray-200 flex justify-between items-center">
                    <div class="text-xl font-bold">Detail Produk</div>
                    <div onclick="hideModal()" class="absolute flex items-center p-1 text-2xl transition-all rounded-full cursor-pointer right-5 hover:bg-slate-100"><ion-icon name="close-outline"></ion-icon>
                    </div>
                </div>

                <div class="px-[30px] py-[34px] w-full h-[500px] overflow-y-scroll overscroll-none">
                    <div class="flex justify-between gap-5">
                        <div>
                            <div class="mb-2 font-bold">Produk</div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] mb-1 text-xs">
                                <div class="flex justify-between">
                                    <div class="font-bold">Nama</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.name}</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs mb-1">
                                <div class="flex justify-between">
                                    <div class="font-bold">Logo</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.logo}</div>
                            </div>

                            <div class="mb-1 text-xs font-bold">Kode</div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Barcode</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.barcode}</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>RFID</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.rfid}</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Produk</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.code}</div>
                            </div>

                            <div class="mb-1 text-xs font-bold">Dimensi</div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Panjang</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.length} cm</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Lebar</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.width} cm</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Tinggi</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.height} cm</div>
                            </div>
                        </div>

                        <div>
                            <div class="mb-2 font-bold">Pack</div>

                            <div class="mb-1 text-xs font-bold">Dimensi Dalam</div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Panjang</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.pack.inner_length} cm</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Lebar</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.pack.inner_width} cm</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Tinggi</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.pack.inner_height} cm</div>
                            </div>

                            <div class="mb-1 text-xs font-bold">Dimensi Luar</div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Panjang</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.pack.outer_length} cm</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Lebar</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.pack.outer_width} cm</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Tinggi</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.pack.outer_height} cm</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Volume</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.pack.outer_length*product.pack.outer_width*product.pack.outer_length} cm</div>
                            </div>

                            <div class="mb-1 text-xs font-bold">Berat</div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>NW</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.pack.nw} kg</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>GW</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.pack.gw} kg</div>
                            </div>
                        </div>

                        <div>
                            <div class="mb-3 font-bold">Komponen</div>

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
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-3 mt-8">
                        <div>
                            <div class="mb-3 font-bold">Biaya Produksi</div>

                            <table class="w-full text-xs table-fixed">
                                <thead class="border-gray-200 border-y-2">
                                    <tr>
                                        <th class="px-4 py-2 text-start">Deskripsi</th>
                                        <th class="px-4 py-2 text-start">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="px-4 py-2">Harga Perakitan</td>
                                        <td class="px-4 py-2">${toRupiah(product.production_costs.price_perakitan)}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2">Harga Perakitan PRJ</td>
                                        <td class="px-4 py-2">${toRupiah(product.production_costs.price_perakitan_prj)}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2">Harga Grendo</td>
                                        <td class="px-4 py-2">${toRupiah(product.production_costs.price_grendo)}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2">Harga Obat</td>
                                        <td class="px-4 py-2">${toRupiah(product.production_costs.price_obat)}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2">Upah</td>
                                        <td class="px-4 py-2">${toRupiah(product.production_costs.upah)}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2 text-transparent">d</td>
                                        <td class="px-4 py-2"></td>
                                    </tr>
                                    <tr class="border-gray-200 border-y-2">
                                        <td class="px-4 py-2 font-bold">Total</td>
                                        <td class="px-4 py-2 font-bold">${total_produksi}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        <div>
                            <div class="mb-3 font-bold">Biaya Packing</div>

                            <table class="w-full text-xs table-fixed">
                                <thead class="border-gray-200 border-y-2">
                                    <tr>
                                        <th class="px-4 py-2 text-start">Deskripsi</th>
                                        <th class="px-4 py-2 text-start">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="px-4 py-2">Harga Box</td>
                                        <td class="px-4 py-2">${toRupiah(product.pack.box_price)}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2">Box Hardware</td>
                                        <td class="px-4 py-2">${toRupiah(product.pack.box_hardware)}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2">Assembling</td>
                                        <td class="px-4 py-2">${toRupiah(product.pack.assembling)}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2">Stiker</td>
                                        <td class="px-4 py-2">${toRupiah(product.pack.stiker)}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2">Hagtag</td>
                                        <td class="px-4 py-2">${toRupiah(product.pack.hagtag)}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2">Maintenance</td>
                                        <td class="px-4 py-2">${toRupiah(product.pack.maintenance)}</td>
                                    </tr>
                                    <tr class="border-gray-200 border-y-2">
                                        <td class="px-4 py-2 font-bold">Total</td>
                                        <td class="px-4 py-2 font-bold">${total_packing}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        <div>
                            <div class="mb-3 font-bold">Biaya Lain-Lain</div>

                            <table class="w-full text-xs table-fixed">
                                <thead class="border-gray-200 border-y-2">
                                    <tr>
                                        <th class="px-4 py-2 text-start">Deskripsi</th>
                                        <th class="px-4 py-2 text-start">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="px-4 py-2">Overhead Pabrik</td>
                                        <td class="px-4 py-2">${toRupiah(product.other_costs.biaya_overhead_pabrik)}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2">Listrik</td>
                                        <td class="px-4 py-2">${toRupiah(product.other_costs.biaya_listrik)}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2">Pajak</td>
                                        <td class="px-4 py-2">${toRupiah(product.other_costs.biaya_pajak)}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2">Export+Usaha</td>
                                        <td class="px-4 py-2">${toRupiah(product.other_costs.biaya_ekspor)}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2 text-transparent">d</td>
                                        <td class="px-4 py-2"></td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2 text-transparent">d</td>
                                        <td class="px-4 py-2"></td>
                                    </tr>
                                    <tr class="border-gray-200 border-y-2">
                                        <td class="px-4 py-2 font-bold">Total</td>
                                        <td class="px-4 py-2 font-bold">${total_lain_lain}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="flex justify-end w-full mt-8 text-xs">
                        <div class="w-60">
                            <div class="grid w-full grid-cols-2 mb-2 font-bold">HPP<span>: ${hpp}</span></div>
                            <div class="grid w-full grid-cols-2 font-bold">Harga Jual<span>: ${toRupiah(product.sell_price)}</span></div>
                        </div>
                    </div>
                </div>

                <div class="py-[20px] px-[30px] w-full border-t-2 border-gray-200 flex justify-end items-center">
                    <button onclick="hideModal()" class="py-2 px-5 border text-[#768498] text-sm rounded-lg hover:bg-[#F7F9F9]">Kembali</button>
                </div>
            </div>
            `


        }
    </script>
@endpush
