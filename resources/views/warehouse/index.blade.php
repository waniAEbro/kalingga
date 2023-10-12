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
                <div class="w-[400px] px-[18px] py-[24px] text-gray-700">
                    <div class="relative flex justify-between">
                        <div class="text-lg font-bold">Detail Warehouse</div>
                        <div onclick="hideModal()" class="absolute top-0 right-0 flex items-center justify-center p-1 transition-all rounded-full cursor-pointer hover:bg-slate-200 bg-slate-100">
                            <ion-icon size="small" name="close-outline"></ion-icon>    
                        </div>
                    </div>
        
                    <div class="divider"></div>
        
                    <div>
                        <div class="grid grid-cols-[0.7fr_1.3fr] mb-1">
                            <div class="font-bold ">Nama Produk</div>
                            <div class="">: ${wh.production.product.name}</div>
                        </div>
                        <div class="grid grid-cols-[0.7fr_1.3fr] mb-1">
                            <div class="font-bold ">RFID</div>
                            <div class="">: ${wh.production.product.rfid}</div>
                        </div>
                        <div class="grid grid-cols-[0.7fr_1.3fr] mb-1">
                            <div class="font-bold ">Barcode</div>
                            <div class="">: ${wh.production.product.barcode}</div>
                        </div>
                        <div class="grid grid-cols-[0.7fr_1.3fr] mb-1">
                            <div class="font-bold ">Jumlah</div>
                            <div class="">: ${wh.quantity}</div>
                        </div>
                    </div>
                </div>
            `
        }
    </script>
@endpush
