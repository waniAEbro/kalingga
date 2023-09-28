@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Buat Komponen</h1>

    <x-create-input-field :action="'components'" :width="'w-full'">
        <div class="flex w-full gap-3">
            <div class="flex-1">
                <x-input :name="'name'" :label="'Nama Komponen'" :placeholder="'kayu'" :type="'text'" />
            </div>
            <div class="flex-none">
                <x-input :name="'unit'" :label="'Unit'" :placeholder="'m'" />
            </div>
        </div>
        <div class="flex w-full gap-3 my-3">
            <div class="flex-1">
                <x-input-with-desc :desc="'Rp'" :name="'price_per_unit'" :type="'number'" :label="'Harga Per Unit'"
                    :placeholder="'1000'" />
            </div>
        </div>
    </x-create-input-field>
@endsection
