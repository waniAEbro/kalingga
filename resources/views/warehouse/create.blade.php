@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Create Warehouse</h1>

    <x-create-input-field :action="'warehouse'">
        <x-input :name="'name'" :label="'Component Name'" :placeholder="'kayu'" :type="'text'" class="mb-3" />
        <x-input :name="'unit'" :label="'Component Unit'" :placeholder="'m'" class="mb-3" />
        <x-input :name="'price_per_unit_sell'" :type="'number'" :label="'Sell\'s Price Per Unit'" :placeholder="'1000'" class="mb-3" />
        <x-input :name="'price_per_unit_buy'" :type="'number'" :label="'Buy\'s Price Per Unit'" :placeholder="'1000'" />
    </x-create-input-field>
@endsection
