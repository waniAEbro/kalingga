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
                <div class="w-[332px] h-[221px] px-[18px] py-[24px] text-gray-700">
                    <div class="flex justify-between relative">
                        <div class="text-lg font-bold">Component Details</div>
                        <div onclick="hideModal()" class="absolute top-0 right-0 p-1 transition-all cursor-pointer hover:bg-slate-200 bg-slate-100 rounded-full flex justify-center items-center">
                            <ion-icon size="small" name="close-outline"></ion-icon>    
                        </div>
                    </div>

                    <div class="divider"></div>

                    <div class="flex justify-between">
                        <div class="font-bold">
                            <div class="mb-3">Nama</div>
                            <div class="mb-3">Satuan</div>
                            <div>Harga per Satuan</div>
                        </div>
                        <div>
                            <div class="mb-3">${component.name}</div>
                            <div class="mb-3">${component.unit}</div>
                            <div>${toRupiah(component.price_per_unit)}</div>
                        </div>
                    </div>
                </div>
            `
        }
    </script>
@endpush
