@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Edit Karyawan</h1>

    <x-edit-input-field :action="'employee'" :items="$employee" :width="'w-full'">
        <div class="flex w-full gap-3">
            <div class="flex-1">
                <x-input :name="'employee_id'" :label="'ID Karyawan'" :placeholder="'id'" :value="$employee->employee_id" type="'text'"
                    :inputParentClass="'mb-3'" />
            </div>
            <div class="flex-1">
                <x-input :name="'employee_name'" :label="'Nama Karyawan'" :placeholder="'nama'" :value="$employee->employee_name" type="'text'"
                    :inputParentClass="'mb-3'" />
            </div>
        </div>
        <div class="flex w-full gap-3 my-3">
            <div class="flex-1">
                <x-input :name="'rfid'" :label="'RFID'" :placeholder="'code'" :type="'text'" :value="$employee->rfid"
                    :inputParentClass="'mb-3'" />
            </div>
        </div>
    </x-edit-input-field>
@endsection
