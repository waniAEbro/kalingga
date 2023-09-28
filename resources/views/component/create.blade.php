@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Buat Komponen</h1>

    <x-create-input-field :action="'components'">
        <div class="grid gap-3  grid-cols-[5fr_1fr] mb-5">
            <div>
                <x-input :name="'name'" :label="'Nama Komponen'" :placeholder="'kayu'" :type="'text'" />
            </div>
            <div>
                <x-input :name="'unit'" :label="'Unit'" :placeholder="'m'" />
            </div>
        </div>
        <div class="grid gap-3  grid-cols-[1fr_1fr] mb-3">
            <x-input-with-desc :desc="'Rp'" :name="'price_per_unit'" :type="'number'" :label="'Harga Per Unit'"
                :placeholder="'1000'" />
        </div>
    </x-create-input-field>
@endsection
