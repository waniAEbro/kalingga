@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Edit Customer</h1>

    <x-edit-input-field :action="'customers'" :items="$customers" :width="'w-full'">
        <div class="flex gap-3 w-full">
            <div class="flex-1">
                <x-input :name="'name'" :label="'Customer Name'" :placeholder="'name'" :value="$customers->name" type="'text'"
                    class="mb-3" />
            </div>
            <div class="flex-1">
                <x-input :name="'email'" :label="'Email'" :placeholder="'email'" :value="$customers->email" type="'email'"
                    class="mb-3" />
            </div>
        </div>
        <div class="flex gap-3 w-full my-3">
            <div class="flex-1">
                <x-input :name="'code'" :label="'Code'" :placeholder="'code'" :type="'text'" :value="$customers->code"
                    class="mb-3" />
            </div>
            <div class="flex-1">
                <x-input :name="'phone'" :label="'Phone'" :placeholder="'phone'" :type="'number'" :value="$customers->phone"
                    class="mb-3" />
            </div>
        </div>
        <div class="flex gap-3 w-full my-3">
            <div class="flex-1">
                <x-input-textarea :name="'address'" :label="'Address'" :placeholder="'address'" :value="$customers->address"
                    class="mb-3" />
            </div>
        </div>
    </x-edit-input-field>
@endsection
