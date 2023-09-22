@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Edit Component</h1>

    <x-edit-input-field :action="'components'" :items="$componentedit">
        <div class="grid gap-3  grid-cols-[5fr_1fr] mb-5">
            <x-input :name="'name'" :label="'Nama Komponen'" :placeholder="'kayu'" :type="'text'" :value="$componentedit->name" />
            <x-input :name="'unit'" :label="'Unit'" :placeholder="'m'" :value="$componentedit->unit" />
        </div>
        <div class="grid gap-3  grid-cols-[1fr_1fr] mb-3">
            <x-input-with-desc :desc="'Rp'" :name="'price_per_unit_sell'" :type="'number'" :label="'Harga Jual Per Unit'"
                :placeholder="'1000'" :value="$componentedit->price_per_unit_sell" />
            <x-input-with-desc :desc="'Rp'" :name="'price_per_unit_buy'" :type="'number'" :label="'Harga Beli Per Unit'"
                :placeholder="'1000'" :value="$componentedit->price_per_unit_buy" />
        </div>

        {{-- <x-input-text :name="'name'" :label="'Component Name'" :placeholder="'kayu'" :value="$componentedit->name" :type="'text'"
            class="mb-3" />
        <x-input-text :name="'unit'" :label="'Component Unit'" :placeholder="'m'" :value="$componentedit->unit" class="mb-3" />
        <x-input-text :name="'price_per_unit_sell'" :label="'Sell\'s Price Per Unit'" :type="'number'" :placeholder="'1000'" :value="$componentedit->price_per_unit_sell"
            class="mb-3" />
        <x-input-text :name="'price_per_unit_buy'" :label="'Buy\'s Price Per Unit'" :type="'number'" :placeholder="'1000'" :value="$componentedit->price_per_unit_buy" /> --}}
    </x-edit-input-field>
@endsection
