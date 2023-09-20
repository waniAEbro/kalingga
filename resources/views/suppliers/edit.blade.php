@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Edit Supplier</h1>

    <x-edit-input-field :action="'suppliers'" :items="$suppliers">
        <x-input-text :name="'name'" :label="'Supplier Name'" :placeholder="'name'" :value="$suppliers->name" :type="'text'"
            class="mb-3" />
        <x-input-text :name="'email'" :label="'Email'" :placeholder="'email'" :value="$suppliers->email" :type="'email'"
            class="mb-3" />
        <x-input-text :name="'phone'" :label="'Phone'" :placeholder="'phone'" :value="$suppliers->phone" class="mb-3" />
        <x-input-text :name="'phone'" :label="'Code'" :placeholder="'Code'" :value="$suppliers->code" class="mb-3" />
        <x-input-textarea :name="'address'" :label="'Address'" :placeholder="'address'" :value="$suppliers->address" />
    </x-edit-input-field>
@endsection
