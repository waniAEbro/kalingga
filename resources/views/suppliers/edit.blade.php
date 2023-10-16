@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Edit Supplier</h1>

    <x-edit-input-field :action="'suppliers'" :items="$suppliers" :width="'w-full'">
        <div class="flex w-full gap-3">
            <div class="flex-1">
                <x-input :name="'name'" :label="'Nama Pemasok'" :placeholder="'name'" :value="$suppliers->name" :type="'text'"
                    :inputParentClass="'mb-3'" />
            </div>
            <div class="flex-1">
                <x-input :name="'email'" :label="'Email'" :placeholder="'email'" :value="$suppliers->email" :type="'email'"
                    :inputParentClass="'mb-3'" />
            </div>
        </div>
        <div class="flex w-full gap-3 my-3">
            <div class="flex-1">
                <x-input :name="'code'" :label="'Kode Pemasok'" :placeholder="'Code'" :value="$suppliers->code" :inputParentClass="'mb-3'" />
            </div>
            <div class="flex-1">
                <x-input :name="'phone'" :label="'No Hp'" :placeholder="'phone'" :value="$suppliers->phone" :inputParentClass="'mb-3'" />
            </div>
        </div>
        <div class="flex w-full gap-3 my-3">
            <div class="flex-1">
                <x-input-textarea :name="'address'" :label="'Alamat'" :placeholder="'address'" :value="$suppliers->address" />
            </div>
        </div>
    </x-edit-input-field>
@endsection
