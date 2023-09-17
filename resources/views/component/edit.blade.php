@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Edit Component</h1>

    <x-edit-input-field :action="'components'" :items="$componentedit">
        <x-input-text :name="'name'" :label="'Component Name'" :placeholder="'kayu'" :value="$componentedit->name" :type="'text'" class="mb-3" />
        <x-input-text :name="'unit'" :label="'Component Unit'" :placeholder="'m'" :value="$componentedit->unit" class="mb-3" />
        <x-input-text :name="'price_per_unit'" :label="'Component Price'" :placeholder="'1000'" :value="$componentedit->price_per_unit" />
    </x-edit-input-field>
@endsection
