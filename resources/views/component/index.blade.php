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

        // const components = {!! $components !!}
        const components = [{
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
            {
                name: "rasikh",
                unit: "m",
                price_per_unit: "Rp 80.000"
            },
        ]


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
            <div class="w-[400px] bg-white rounded-xl text-gray-800">
                <div class="py-[20px] px-[30px] w-full relative border-b-2 border-gray-200 flex justify-between items-center">
                    <div class="text-xl font-bold">Detail Komponen</div>
                    <div onclick="hideModal()" class="absolute flex items-center p-1 text-2xl transition-all rounded-full cursor-pointer right-5 hover:bg-slate-100"><ion-icon name="close-outline"></ion-icon>
                    </div>
                </div>
    
                <div class="px-[30px] py-[20px] text-sm">
                    <div class="grid grid-cols-[1fr_1fr] mb-1">
                        <div class="font-bold w-40 flex justify-between">Nama Komponen<div>:</div></div>
                        <div class="">${component.name}</div>
                    </div>
                    <div class="grid grid-cols-[1fr_1fr] mb-1">
                        <div class="font-bold w-40 flex justify-between">Satuan<div>:</div></div>
                        <div class="">${component.unit}</div>
                    </div>
                    <div class="grid grid-cols-[1fr_1fr] mb-1">
                        <div class="font-bold w-40 flex justify-between">Harga<div>:</div></div>
                        <div class="">${toRupiah(component.price_per_unit)}</div>
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
