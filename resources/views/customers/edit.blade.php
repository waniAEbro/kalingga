@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Create Customer</h1>

    <x-create-input-field :action="'suppliers'" :items="$customers">
        <x-input-text :name="'name'" :label="'Supplier Name'" :placeholder="'name'" :value="$customers->name" class="mb-3" />
        <x-input-text :name="'email'" :label="'Email'" :placeholder="'email'" :value="$customers->email" class="mb-3" />
        <x-input-text :name="'phone'" :label="'Phone'" :placeholder="'phone'" :type="'number'" :value="$customers->phone"
            class="mb-3" />
        <x-input-textarea :name="'address'" :label="'Address'" :placeholder="'address'" :value="$customers->address" class="mb-3" />
        <x-input-text :name="'code'" :label="'Code'" :placeholder="'code'" :type="'number'" :value="$customers->code"
            class="mb-3" />
    </x-create-input-field>
@endsection
