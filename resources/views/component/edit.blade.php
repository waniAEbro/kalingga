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
                <label for="supplier_id" class="block text-sm mb-2">Supplier</label>
                <x-select :value="$componentedit->supplier->id" :label="$componentedit->supplier->name" x-on:click="$nextTick();" :dataLists="$suppliers->toArray()"
                    :name="'supplier_id'" :id="'supplier_id'" />
            </div>
            <div class="flex-none">
                <x-input-with-desc :desc="'Rp'" :name="'price_per_unit'" :type="'number'" :label="'Harga Per Unit'"
                    :placeholder="'1000'" :value="$componentedit->price_per_unit" />
            </div>
        </div>
    </x-edit-input-field>
@endsection
