{{-- @dd($componentedit) --}}
@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Edit Component</h1>

    <x-edit-input-field :action="'components'" :items="$componentedit" :width="'w-full'">
        <div class="flex w-full gap-3">
            <div class="flex-1">
                <x-input :name="'name'" :label="'Nama Komponen'" :placeholder="'kayu'" :type="'text'" :value="$componentedit->name" />
            </div>
            <div class="flex-none">
                <x-input :name="'unit'" :label="'Unit'" :placeholder="'m'" :value="$componentedit->unit" />
            </div>
        </div>
        <div class="flex w-full gap-3 my-3">
            <div class="flex-1">
                <x-input-with-desc :desc="'Rp'" :name="'price_per_unit'" :type="'number'" :label="'Harga Per Unit'"
                    :placeholder="'1000'" :value="$componentedit->price_per_unit" />
            </div>
        </div>
        {{-- <table class="w-full text-left">
            <thead>
                <tr>
                    <th class="px-4 py-5 font-[500]">Supplier</th>
                    <th class="px-4 py-5 font-[500]">Price</th>
                    <th class="px-4 py-5 font-[500]">Aksi</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <tr onclick="addRow()">
                    <td colspan="3" class=" border-t border-b p-3 text-center">Add Supplier</td>
                </tr>
                @foreach ($componentedit->suppliers as $supplier)
                    <tr>
                        <td class="border-t border-b p-3">
                            <x-select x-on:click="$nextTick();" :dataLists="$suppliers->toArray()" :name="'supplier_id[]'" :id="'supplier_id'"
                                :value="$supplier->id" :label="$supplier->name" />
                        </td>
                        <td class="border-t border-b p-3">
                            <x-input-with-desc :desc="'Rp'" :name="'price_supplier[]'" :type="'number'" :placeholder="'1000'"
                                :value="$supplier->pivot->price_per_unit" />
                        </td>
                        <td class="border-t border-b p-3">
                            <button type="button" class="btn btn-red"
                                onclick="this.parentElement.parentElement.remove()">Hapus</button>
                    </tr>
                @endforeach
            </tbody>
        </table> --}}

        <table class="w-full text-left mt-5 table-fixed">
            <thead>
                <tr class="border-y-2">
                    <th class="p-2 w-20 text-center">#</th>
                    <th class="p-2 w-96">Pemasok</th>
                    <th class="p-2">Harga</th>
                    <th class="p-2 w-20"></th>
                </tr>
            </thead>
            <tbody id="table-body">
                @foreach ($componentedit->suppliers as $supplier)
                    <tr x-data="{ supplier: $el }" class="border-b">
                        <td id="number" class="p-2 text-center"></td>
                        <td class="p-2">
                            <x-select x-on:click="$nextTick();" :dataLists="$suppliers->toArray()" :name="'supplier_id[]'" :id="'supplier_id'"
                                :value="$supplier->id" :label="$supplier->name" />
                        </td>
                        <td class="p-2">
                            <x-input-with-desc :desc="'Rp'" :name="'price_supplier[]'" :type="'number'" :placeholder="'1000'"
                                :value="$supplier->pivot->price_per_unit" />
                        </td>
                        <td class="p-2">
                            <button type="button" x-on:click="supplier.remove(); set_total(); set_number()"
                                class="transition-all duration-300 rounded-full hover:bg-slate-100 active:bg-slate-200"><span
                                    class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="button" x-data x-on:click="addNewSupplier(); set_number()"
            class="flex justify-center w-full py-2 text-sm transition duration-300 border-b border-dashed border-x hover:bg-slate-50 active:bg-sky-100">Add
            New</button>
    </x-edit-input-field>
@endsection
@push('script')
    <script>
        set_number();
        const tableBody = document.getElementById('table-body');

        function addNewSupplier() {
            const tableBody = document.getElementById('table-body');
            const tableRow = document.createElement('tr');
            tableRow.setAttribute('x-data', '{ supplier: $el }')
            tableRow.className = 'border-b';
            tableRow.innerHTML = `
                                        <td id="number" class="p-2 text-center"></td>
                                        <td class="p-2">
                                            <x-select x-on:click="$nextTick();" :dataLists="$suppliers->toArray()" :name="'supplier_id[]'" :id="'supplier_id'" />
                                        </td>
                                        <td class="p-2">
                                            <x-input-with-desc :desc="'Rp'" :name="'price_supplier[]'" :type="'number'" :placeholder="'1000'" />
                                        </td>
                                        <td class="p-2">
                                            <button type="button" x-on:click="supplier.remove(); set_total(); set_number()"
                                                class="transition-all duration-300 rounded-full hover:bg-slate-100 active:bg-slate-200"><span
                                                    class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                                        </td>
                                    `;

            tableBody.appendChild(tableRow);
        }

        function set_number() {
            const numbers = document.querySelectorAll('#number');
            numbers.forEach((number, i) => number.innerText = i + 1)
        }
    </script>
@endpush
