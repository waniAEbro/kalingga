@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Create Supplier</h1>

    <x-create-input-field :action="'suppliers'" :width="'w-full'">
        <div class="flex w-full gap-3">
            <div class="flex-1">
                <x-input name="name" :label="'Nama Pemasok'" :placeholder="'name'" :type="'text'" class="mb-3" :value="old('name')" />
            </div>
            <div class="flex-1">
                <x-input name="email" :label="'Email'" :placeholder="'email'" :type="'email'" class="mb-3" :value="old('email')"/>
            </div>
        </div>
        <div class="flex w-full gap-3 my-3">
            <div class="flex-1">
                <x-input name="code" :label="'Kode Pemasok'" :placeholder="'code'" :type="'text'" class="mb-3" :value="old('code')"/>
            </div>
            <div class="flex-1">
                <x-input name="phone" :label="'No Hp'" :placeholder="'phone'" :type="'number'" class="mb-3" :value="old('phone') "/>
            </div>
        </div>
        <div class="flex w-full gap-3 my-3">
            <div class="flex-1">
                <x-input-textarea :name="'address'" :label="'Alamat'" :placeholder="'address'" :value="old('address')" />
            </div>
        </div>
    </x-create-input-field>
@endsection
