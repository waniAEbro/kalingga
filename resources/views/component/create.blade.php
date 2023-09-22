@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Buat Komponen</h1>

    <x-create-input-field :action="'components'">
        <div class="grid gap-3  grid-cols-[5fr_1fr] mb-5">
            <x-input :name="'name'" :label="'Nama Komponen'" :placeholder="'kayu'" :type="'text'" />
            <x-input :name="'unit'" :label="'Unit'" :placeholder="'m'" />
        </div>
        <div class="grid gap-3  grid-cols-[1fr_1fr] mb-3">
            <x-input-with-desc :desc="'Rp'" :name="'price_per_unit_sell'" :type="'number'" :label="'Harga Jual Per Unit'"
                :placeholder="'1000'" />
            <x-input-with-desc :desc="'Rp'" :name="'price_per_unit_buy'" :type="'number'" :label="'Harga Beli Per Unit'"
                :placeholder="'1000'" />
        </div>
    </x-create-input-field>
@endsection
