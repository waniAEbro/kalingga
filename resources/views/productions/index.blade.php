@extends('layouts.layout')

@section('content')
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
        const productions = {!! $productions !!}

        state.columnName = ["Nomor", "Kode", "Nama Produk", "Jumlah Belum Selesai", "Jumlah Sudah Selesai", "Jumlah Total",
            "Aksi"
        ]
        state.columnQuery = ["code", "product.name", "quantity_not_finished", "quantity_finished",
            "sale.product.find(el => el.id == data.product_id).pivot.quantity"
        ]
        state.menu = "productions"

        document.querySelector(".table-fixed").appendChild(buildHeader())

        state.data = productions
        state.allData = productions

        paginate()
        pageNumber()
        buildTable()

        function show(id) {
            const production = productions.find(data => data.id === id);
            console.log(id)

            const modal = document.querySelector('#modal');
            document.querySelector('#modal-background').classList.remove('hidden');

            modal.classList.remove('opacity-0', '-z-20');
            modal.classList.add('opacity-100', 'z-20');

            modal.innerHTML = `
                <div class="w-[400px] px-[18px] py-[24px] text-gray-700">
                    <div class="relative flex justify-between">
                        <div class="text-lg font-bold">Detail Produksi</div>
                        <div onclick="hideModal()" class="absolute top-0 right-0 flex items-center justify-center p-1 transition-all rounded-full cursor-pointer hover:bg-slate-200 bg-slate-100">
                            <ion-icon size="small" name="close-outline"></ion-icon>    
                        </div>
                    </div>
        
                    <div class="divider"></div>
        
                    <div>
                        <div class="grid grid-cols-[1fr_1fr] mb-1">
                            <div class="mb-3 font-bold">Kode Produksi</div>
                            <div class="mb-3">: ${production.code}</div>
                        </div>
                        <div class="grid grid-cols-[1fr_1fr] mb-1">
                            <div class="mb-3 font-bold">Nama Produk</div>
                            <div class="mb-3">: ${production.product.name}</div>
                        </div>
                        <div class="grid grid-cols-[1fr_1fr] mb-1">
                            <div class="mb-3 font-bold">Jumlah Belum Selesai</div>
                            <div class="mb-3">: ${production.quantity_not_finished}</div>
                        </div>
                        <div class="grid grid-cols-[1fr_1fr] mb-1">
                            <div class="mb-3 font-bold">Jumlah Sudah Selesai</div>
                            <div class="mb-3">: ${production.quantity_finished}</div>
                        </div>
                        <div class="grid grid-cols-[1fr_1fr]">
                            <div class="mb-3 font-bold">Total</div>
                            <div class="mb-3">: ${production.quantity_finished+production.quantity_not_finished}</div>
                        </div>
                    </div>
                </div>
            `
        }
    </script>
@endpush
