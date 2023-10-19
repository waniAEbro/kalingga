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
        <table class="w-full text-left">
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
                @endforeach
            </tbody>
        </table>
    </x-edit-input-field>
@endsection
@push('script')
    <script>
        const tableBody = document.getElementById('table-body');

        function addRow() {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="border-t border-b p-3">
                    <x-select x-on:click="$nextTick();" :dataLists="$suppliers->toArray()" :name="'supplier_id[]'" :id="'supplier_id'" />
                </td>
                <td class="border-t border-b p-3">
                    <x-input-with-desc :desc="'Rp'" :name="'price_supplier[]'" :type="'number'" :placeholder="'1000'" />
                </td>
                <td class="border-t border-b p-3">
                    <button type="button" class="btn btn-red" onclick="this.parentElement.parentElement.remove()">Hapus</button>
            `;
            tableBody.appendChild(row);
        }
    </script>
@endpush
