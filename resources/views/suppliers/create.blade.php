@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Create Supplier</h1>

    <x-create-input-field :action="'suppliers'">
        <x-input-text :name="'name'" :label="'Supplier Name'" :placeholder="'name'" class="mb-3" />
        <x-input-text :name="'email'" :label="'Email'" :placeholder="'email'" class="mb-3" />
        <x-input-text :name="'phone'" :label="'Phone'" :placeholder="'phone'" :type="'number'" class="mb-3" />
        <x-input-textarea :name="'address'" :label="'Address'" :placeholder="'address'" />
    </x-create-input-field>
@endsection
