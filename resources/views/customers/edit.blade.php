@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Edit Customer</h1>

    <x-edit-input-field :action="'customers'" :items="$customers" :width="'w-full'">
        <div class="flex w-full gap-3">
            <div class="flex-1">
                <x-input :name="'name'" :label="'Nama Pelanggan'" :placeholder="'name'" :value="$customers->name" type="'text'"
                    :inputParentClass="'mb-3'" />
            </div>
            <div class="flex-1">
                <x-input :name="'email'" :label="'Email'" :placeholder="'email'" :value="$customers->email" type="'email'"
                    :inputParentClass="'mb-3'" />
            </div>
        </div>
        <div class="flex w-full gap-3 my-3">
            <div class="flex-1">
                <x-input :name="'code'" :label="'Kode Pelanggan'" :placeholder="'code'" :type="'text'" :value="$customers->code"
                    :inputParentClass="'mb-3'" />
            </div>
            <div class="flex-1">
                <x-input :name="'phone'" :label="'No Hp'" :placeholder="'phone'" :type="'number'" :value="$customers->phone"
                    :inputParentClass="'mb-3'" />
            </div>
        </div>
        <div class="flex w-full gap-3 my-3">
            <div class="flex-1">
                <x-input-textarea :name="'address'" :label="'Alamat'" :placeholder="'address'" :value="$customers->address" />
            </div>
        </div>
    </x-edit-input-field>
@endsection
