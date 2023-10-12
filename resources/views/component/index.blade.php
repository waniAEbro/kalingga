@extends('layouts.layout')

@section('content')
    <x-data-list>
        <div class="h-[550px] relative m-5">
            <table class="w-full mt-5 border-separate table-fixed border-spacing-y-3">
            </table>
            <div id="pagination-wrapper" class="absolute bottom-0 flex h-10 gap-2 my-5 text-sm"></div>
        </div>
    </x-data-list>
@endsection

@push('script')
    <script>
        state.columnName = ["Nomor", "Nama Komponen", "Satuan", "Harga Per Satuan", "Aksi"]
        state.columnQuery = ["name", "unit", "price_per_unit"]
        state.menu = "components"

        document.querySelector(".table-fixed").appendChild(buildHeader())

        const components = {!! $components !!}


        state.data = components
        state.allData = components
        paginate()
        pageNumber()
        buildTable()

        function show(id) {
            const component = components.find(data => data.id === id);

            const modal = document.querySelector('#modal');
            document.querySelector('#modal-background').classList.remove('hidden');

            modal.classList.remove('opacity-0', '-z-20');
            modal.classList.add('opacity-100', 'z-20');

            modal.innerHTML = `
            <div class="w-[400px] px-[18px] py-[24px] text-gray-700">
                    <div class="relative flex justify-between">
                        <div class="text-lg font-bold">Detail Komponen</div>
                        <div onclick="hideModal()" class="absolute top-0 right-0 flex items-center justify-center p-1 transition-all rounded-full cursor-pointer hover:bg-slate-200 bg-slate-100">
                            <ion-icon size="small" name="close-outline"></ion-icon>    
                        </div>
                    </div>
        
                    <div class="divider"></div>
        
                    <div>
                        <div class="grid grid-cols-[1fr_1fr] mb-1">
                            <div class="font-bold ">Nama Komponen</div>
                            <div class="">: ${component.name}</div>
                        </div>
                        <div class="grid grid-cols-[1fr_1fr] mb-1">
                            <div class="font-bold ">Satuan</div>
                            <div class="">: ${component.unit}</div>
                        </div>
                        <div class="grid grid-cols-[1fr_1fr] mb-1">
                            <div class="font-bold ">Harga per Satuan</div>
                            <div class="">: ${component.price_per_unit}</div>
                        </div>
                    </div>
                </div>
            `
        }
    </script>
@endpush
