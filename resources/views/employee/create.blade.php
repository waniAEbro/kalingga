@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Buat Karyawan</h1>

    <x-create-input-field :action="'employee'" :width="'w-full'">
        <div class="flex w-full gap-3">
            <div class="flex-1">
                <x-input :name="'employee_name'" :label="'Nama Karyawan'" :placeholder="'nama'" :value="old('employee_name')" />
            </div>
        </div>
        <div class="flex w-full gap-3 my-3">
            <div class="flex-1">
                <x-input :name="'rfid'" :label="'RFID'" :placeholder="'rfid'" :value="old('rfid')" />
            </div>
        </div>
    </x-create-input-field>
@endsection
