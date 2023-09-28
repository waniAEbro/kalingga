@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Edit Component</h1>

    <x-edit-input-field :action="'components'" :items="$componentedit">
        <div class="grid gap-3  grid-cols-[5fr_1fr] mb-5">
            <x-input :name="'name'" :label="'Nama Komponen'" :placeholder="'kayu'" :type="'text'" :value="$componentedit->name" />
            <x-input :name="'unit'" :label="'Unit'" :placeholder="'m'" :value="$componentedit->unit" />
        </div>
        <div class="grid gap-3  grid-cols-[1fr_1fr] mb-3">
            <x-input-with-desc :desc="'Rp'" :name="'price_per_unit'" :type="'number'" :label="'Harga Per Unit'"
                :placeholder="'1000'" :value="$componentedit->price_per_unit" />
        </div>
    </x-edit-input-field>
@endsection
