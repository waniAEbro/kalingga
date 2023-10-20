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
        const componentSupplier = {!! $component_supplier !!}

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

            let supplier_list = ''

            component.suppliers.forEach((sp, i) => {
                supplier_list += `<tr>
                        <td class="px-4 py-2 text-center">${i+1}</td>
                        <td class="px-4 py-2">${sp.name}</td>
                        <td class="px-4 py-2">${toRupiah(sp.pivot.price_per_unit)}</td>
                    </tr>`
            })

            modal.innerHTML = `
            <div class="w-[400px] bg-white rounded-xl text-gray-800">
                <div class="py-[20px] px-[30px] w-full relative border-b-2 border-gray-200 flex justify-between items-center">
                    <div class="text-xl font-bold">Detail Komponen</div>
                    <div onclick="hideModal()" class="absolute flex items-center p-1 text-2xl transition-all rounded-full cursor-pointer right-5 hover:bg-slate-100"><ion-icon name="close-outline"></ion-icon>
                    </div>
                </div>

                <div class="px-[30px] py-[20px] text-sm">
                    <div class="grid grid-cols-[1fr_1fr] mb-1">
                        <div class="flex justify-between w-40 font-bold">Nama Komponen<div>:</div></div>
                        <div class="">${component.name}</div>
                    </div>
                    <div class="grid grid-cols-[1fr_1fr] mb-1">
                        <div class="flex justify-between w-40 font-bold">Satuan<div>:</div></div>
                        <div class="">${component.unit}</div>
                    </div>
                    <div class="grid grid-cols-[1fr_1fr] mb-1">
                        <div class="flex justify-between w-40 font-bold">Harga<div>:</div></div>
                        <div class="">${toRupiah(component.price_per_unit)}</div>
                    </div>
                    <table class="w-full mt-5 table-fixed">
                                <thead class="border-gray-200 border-y-2">
                                    <tr>
                                        <th class="w-10 px-4 py-2">No</th>
                                        <th class="w-20 px-4 py-2 text-start">Pemasok</th>
                                        <th class="w-20 px-4 py-2 text-start">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${supplier_list}
                                </tbody>
                            </table>
                </div>

                <div class="py-[20px] px-[30px] w-full flex justify-end items-center">
                    <button onclick="hideModal()" class="py-2 px-5 border text-[#768498] text-sm rounded-lg hover:bg-[#F7F9F9]">Kembali</button>
                </div>
            </div>
            `
        }
    </script>
@endpush
