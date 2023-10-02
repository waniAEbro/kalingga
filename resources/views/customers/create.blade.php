@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Create Customer</h1>

    <x-create-input-field :action="'customers'" :width="'w-full'">
        <div class="flex w-full gap-3">
            <div class="flex-1">
                <x-input :name="'name'" :label="'Nama Pelanggan'" :placeholder="'name'" :type="'text'" class="mb-3" />
            </div>
            <div class="flex-1">
                <x-input :name="'email'" :label="'Email'" :placeholder="'email'" :type="'email'" class="mb-3" />
            </div>
        </div>
        <div class="flex w-full gap-3 my-3">
            <div class="flex-1">
                <x-input :name="'code'" :label="'Kode Pelanggan'" :placeholder="'code'" :type="'text'" class="mb-3" />
            </div>
            <div class="flex-1">
                <x-input :name="'phone'" :label="'No Hp'" :placeholder="'phone'" :type="'number'" class="mb-3" />
            </div>
        </div>
        <div class="flex w-full my-3">
            <div class="flex-1">
                <x-input-textarea :name="'address'" :label="'Alamat'" :placeholder="'address'" />
            </div>
        </div>
    </x-create-input-field>
@endsection
