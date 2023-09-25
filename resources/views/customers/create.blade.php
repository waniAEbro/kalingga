@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Create Customer</h1>

    <x-create-input-field :action="'customers'">
        <x-input :name="'name'" :label="'Supplier Name'" :placeholder="'name'" :type="'text'" class="mb-3" />
        <x-input :name="'email'" :label="'Email'" :placeholder="'email'" :type="'email'" class="mb-3" />
        <x-input :name="'phone'" :label="'Phone'" :placeholder="'phone'" :type="'number'" class="mb-3" />
        <x-input-textarea :name="'address'" :label="'Address'" :placeholder="'address'" />
        <x-input :name="'code'" :label="'Code'" :placeholder="'code'" :type="'text'" class="mb-3" />
    </x-create-input-field>
@endsection
