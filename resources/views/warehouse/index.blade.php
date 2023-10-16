@extends('layouts.layout')

@section('content')
    {{-- @dd($warehouse[0]->production->product->name) --}}
    <x-data-list :isReadOnly="true">
        <div class="h-[550px] relative">
            <table class="w-full mt-5 border-separate table-fixed border-spacing-y-3">
            </table>
            <div id="pagination-wrapper" class="absolute bottom-0 flex h-10 gap-2 my-5 text-sm"></div>
        </div>
    </x-data-list>
@endsection

@push('script')
    <script>
        state.columnName = ["Nomor", "Nama Produk", "RFID", "Barcode", "Jumlah", "Aksi"]
        state.columnQuery = ["production.product.name", "production.product.rfid", "production.product.barcode", "quantity"]
        state.menu = "warehouse"

        document.querySelector(".table-fixed").appendChild(buildHeader())

        const warehouse = {!! $warehouse !!}

        state.data = warehouse
        state.allData = warehouse

        paginate()
        pageNumber()
        buildTable()

        function show(id) {
            const wh = warehouse.find(data => data.id === id);

            const modal = document.querySelector('#modal');
            document.querySelector('#modal-background').classList.remove('hidden');

            modal.classList.remove('opacity-0', '-z-20');
            modal.classList.add('opacity-100', 'z-20');

            modal.innerHTML = `
                <div class="w-[400px] bg-white rounded-xl text-gray-800">
                    <div class="py-[20px] px-[30px] w-full relative border-b-2 border-gray-200 flex justify-between items-center">
                        <div class="text-xl font-bold">Detail Warehouse</div>
                        <div onclick="hideModal()" class="absolute flex items-center p-1 text-2xl transition-all rounded-full cursor-pointer right-5 hover:bg-slate-100"><ion-icon name="close-outline"></ion-icon>
                        </div>
                    </div>
        
                    <div class="px-[30px] py-[20px] text-sm">
                        <div class="grid grid-cols-[1fr_1fr] mb-1">
                            <div class="font-bold w-40 flex justify-between">Nama Produk<div>:</div></div>
                            <div class="">${wh.production.product.name}</div>
                        </div>
                        <div class="grid grid-cols-[1fr_1fr] mb-1">
                            <div class="font-bold w-40 flex justify-between">RFID<div>:</div></div>
                            <div class="">${wh.production.product.rfid}</div>
                        </div>
                        <div class="grid grid-cols-[1fr_1fr] mb-1">
                            <div class="font-bold w-40 flex justify-between">Barcode<div>:</div></div>
                            <div class="">${wh.production.product.barcode}</div>
                        </div>
                        <div class="grid grid-cols-[1fr_1fr] mb-1">
                            <div class="font-bold w-40 flex justify-between">Jumlah<div>:</div></div>
                            <div class="">${wh.quantity}</div>
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
