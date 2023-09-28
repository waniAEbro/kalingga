@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Create Customer</h1>

    <x-create-input-field :action="'customers'" :width="'w-full'">
        <div class="flex gap-3 w-full">
            <div class="flex-1">
                <x-input :name="'name'" :label="'Supplier Name'" :placeholder="'name'" :type="'text'" class="mb-3" />
            </div>
            <div class="flex-1">
                <x-input :name="'email'" :label="'Email'" :placeholder="'email'" :type="'email'" class="mb-3" />
            </div>
        </div>
        <div class="flex gap-3 w-full my-3">
            <div class="flex-1">
                <x-input :name="'code'" :label="'Code'" :placeholder="'code'" :type="'text'" class="mb-3" />
            </div>
            <div class="flex-1">
                <x-input :name="'phone'" :label="'Phone'" :placeholder="'phone'" :type="'number'" class="mb-3" />
            </div>
        </div>
        <div class="flex w-full my-3">
            <div class="flex-1">
                <x-input-textarea :name="'address'" :label="'Address'" :placeholder="'address'" />
            </div>
        </div>
    </x-create-input-field>
@endsection
