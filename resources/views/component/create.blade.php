@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Create Component</h1>

    <x-create-input-field :action="'components'">
        <x-input-text :name="'name'" :label="'Component Name'" :placeholder="'kayu'" :type="'text'" class="mb-3" />
        <x-input-text :name="'unit'" :label="'Component Unit'" :placeholder="'m'" class="mb-3" />
        <x-input-text :name="'price_per_unit_sell'" :label="'Sell\'s Price Per Unit'" :placeholder="'1000'" />
        <x-input-text :name="'price_per_unit_buy'" :label="'Buy\'s Price Per Unit'" :placeholder="'1000'" />
    </x-create-input-field>
@endsection
