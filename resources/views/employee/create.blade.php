@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Buat Karyawan</h1>

    <x-create-input-field :action="'employee'" :width="'w-full'">
        <div class="flex w-full gap-3">
            <div class="flex-1">
                <x-input :name="'employee_id'" :label="'ID Karyawan'" :placeholder="'id'" :type="'text'" :value="old('employee_id')" />
            </div>
            <div class="flex-none">
                <x-input :name="'employee_name'" :label="'Nama Karyawan'" :placeholder="'nama'" :value="old('employee_name')" />
            </div>
        </div>
        <div class="flex w-full gap-3 my-3">
            <div class="flex-1">
                <x-input :name="'rfid'" :label="'RFID'"
                    :placeholder="'rfid'" :value="old('rfid')" />
            </div>
        </div>
    </x-create-input-field>
@endsection

@push('script')
    <script>
        set_number();
        deleteBtnToggle();

        function set_number() {
            const numbers = document.querySelectorAll('#number');
            numbers.forEach((number, i) => number.innerText = i + 1)
        }

        function deleteBtnToggle() {
            const deleteBtn = document.querySelectorAll('.delete-btn')
            const aksi = document.querySelectorAll('#aksi')
            if (aksi.length == 1) {
                deleteBtn[0].classList.add('hidden')
            } else {
                deleteBtn.forEach(btn => btn.classList.remove('hidden'))
            }
        }

    </script>
@endpush
