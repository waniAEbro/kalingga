@extends('layouts.layout')

@section('content')
    <x-data-list :isReadOnly="true">
        <div class="h-[550px] relative">
            <table class="w-full mt-5 border-separate table-fixed border-spacing-y-3">
            </table>
            <div id="pagination-wrapper" x-data class="absolute bottom-0 flex h-10 gap-2 text-sm"></div>
        </div>

    </x-data-list>
    @dump($products)
@endsection

@push('script')
    <script>
        const products = {!! $products !!}

        state.columnName = ["Nomor", "Kode", "Nama Produk", "Jumlah Belum Selesai", "Jumlah Sudah Selesai",
            "Aksi"
        ]
        state.columnQuery = ["code", "name", "production.quantity_not_finished", "production.quantity_finished"]
        state.menu = "products/production"

        document.querySelector(".table-fixed").appendChild(buildHeader())

        state.data = products
        state.allData = products

        paginate()
        pageNumber()
        buildTable()

        function show(id) {
            const production = productions.find(data => data.id === id);
            console.log(id)

            const modal = document.querySelector('#modal');
            document.querySelector('#modal-background').classList.remove('hidden');

            modal.classList.remove('opacity-0', '-z-40');
            modal.classList.add('opacity-100', 'z-40');

            modal.innerHTML = `
                <div class="w-[400px] bg-white rounded-xl text-gray-800">
                    <div class="py-[20px] px-[30px] w-full relative border-b-2 border-gray-200 flex justify-between items-center">
                        <div class="text-xl font-bold">Detail Produksi</div>
                        <div onclick="hideModal()" class="absolute flex items-center p-1 text-2xl transition-all rounded-full cursor-pointer right-5 hover:bg-slate-100"><ion-icon name="close-outline"></ion-icon>
                        </div>
                    </div>
        
                    <div class="px-[30px] py-[20px] text-sm">
                        <div class="grid grid-cols-[1fr_1fr] mb-1">
                            <div class="font-bold w-40 flex justify-between">Kode Produksi<div>:</div></div>
                            <div class="">${production.code}</div>
                        </div>
                        <div class="grid grid-cols-[1fr_1fr] mb-1">
                            <div class="font-bold w-40 flex justify-between">Nama Produk<div>:</div></div>
                            <div class="">${production.product.name}</div>
                        </div>
                        <div class="grid grid-cols-[1fr_1fr] mb-1">
                            <div class="font-bold w-40 flex justify-between">Jumlah Belum Selesai<div>:</div></div>
                            <div class="">${production.quantity_not_finished}</div>
                        </div>
                        <div class="grid grid-cols-[1fr_1fr] mb-1">
                            <div class="font-bold w-40 flex justify-between">Jumlah Selesai<div>:</div></div>
                            <div class="">${production.quantity_finished}</div>
                        </div>
                        <div class="grid grid-cols-[1fr_1fr] mb-1">
                            <div class="font-bold w-40 flex justify-between">Total<div>:</div></div>
                            <div class="">${production.quantity_finished+production.quantity_not_finished}</div>
                        </div>
                    </div>

                    <div class="py-[20px] px-[30px] w-full flex justify-end items-center">
                        <button onclick="hideModal()" class="py-2 px-5 border text-[#768498] text-sm rounded-lg hover:bg-[#F7F9F9]">Kembali</button>
                    </div>
                </div>
            `
        }
    </script>
@endpush
