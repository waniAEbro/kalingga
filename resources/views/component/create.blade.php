@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Buat Komponen</h1>

    <x-create-input-field :action="'components'" :width="'w-full'">
        <div class="flex w-full gap-3">
            <div class="flex-1">
                <x-input :name="'name'" :label="'Nama Komponen'" :placeholder="'kayu'" :type="'text'" :value="old('name')" />
            </div>
            <div class="flex-none">
                <x-input :name="'unit'" :label="'Unit'" :placeholder="'m'" :value="old('unit')" />
            </div>
        </div>
        <div class="flex w-full gap-3 my-3">
            <div class="flex-1">
                <x-input-with-desc :desc="'Rp'" :name="'price_per_unit'" :type="'number'" :label="'Harga Per Unit'"
                    :placeholder="'1000'" :value="old('price_per_unit')" />
            </div>
        </div>

        <table class="w-full mt-5 text-left table-fixed">
            <thead>
                <tr class="border-y-2">
                    <th class="w-20 p-2 text-center">#</th>
                    <th class="p-2 w-96">Pemasok</th>
                    <th class="p-2">Harga</th>
                    <th class="w-20 p-2"></th>
                </tr>
            </thead>
            <tbody id="table-body">
                @if (old('supplier_id', []))
                    @foreach (old('supplier_id', []) as $index => $supplier)
                        <tr x-data="{ supplier: $el }" class="border-b">
                            <td id="number" class="p-2 text-center"></td>
                            <td class="p-2">
                                <x-select x-on:click="$nextTick();" :dataLists="$suppliers->toArray()" :name="'supplier_id[]'" :id="'supplier_id'"
                                    :value="$supplier" />
                                @error('supplier_id.' . $index)
                                    <div class="mt-1 text-xs text-red-400">{{ $message }}</div>
                                @enderror
                            </td>

                            <td class="p-2">
                                <x-input-with-desc :desc="'Rp'" :name="'price_supplier[]'" :type="'number'"
                                    :placeholder="'1000'" :value="old('price_supplier', [])[$index]" />
                                @error('price_supplier.' . $index)
                                    <div class="mt-1 text-xs text-red-400">{{ $message }}</div>
                                @enderror
                            </td>

                            <td id="aksi" class="p-2">
                                <button type="button" x-on:click="supplier.remove(); set_number(); deleteBtnToggle()"
                                    class="transition-all duration-300 rounded-full delete-btn hover:bg-slate-100 active:bg-slate-200"><span
                                        class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr x-data="{ supplier: $el }" class="border-b">
                        <td id="number" class="p-2 text-center"></td>
                        <td class="p-2">
                            <x-select x-on:click="$nextTick();" :dataLists="$suppliers->toArray()" :name="'supplier_id[]'" :id="'supplier_id'" />
                        </td>
                        <td class="p-2">
                            <x-input-with-desc :desc="'Rp'" :name="'price_supplier[]'" :type="'number'"
                                :placeholder="'1000'" />
                        </td>
                        <td id="aksi" class="p-2">
                            <button type="button" x-on:click="supplier.remove(); set_number(); deleteBtnToggle()"
                                class="transition-all duration-300 rounded-full delete-btn hover:bg-slate-100 active:bg-slate-200"><span
                                    class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>

        <button type="button" x-data x-on:click="addNewSupplier(); set_number(); deleteBtnToggle()"
            class="flex justify-center w-full py-2 text-sm transition duration-300 border-b border-dashed border-x hover:bg-slate-50 active:bg-sky-100">Add
            New</button>
    </x-create-input-field>
@endsection

@push('script')
    {{-- <script src="../../js/test.js"></script> --}}
    <script></script>
@endpush
