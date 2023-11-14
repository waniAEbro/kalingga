@extends('layouts.layout')

@section('content')
    <x-data-list>
        <div class="h-[500px] relative">
            <table class="w-full mt-5 border-separate table-fixed border-spacing-y-3">
            </table>
            <div id="pagination-wrapper" x-data class="absolute bottom-0 flex h-10 gap-2 text-sm"></div>
        </div>
    </x-data-list>
@endsection

@push('script')
    <script>
        state.columnName = ["Nomor", "Nama Karyawan", "RFID", "Aksi"]
        state.columnQuery = ["employee_name", "rfid"]
        state.menu = "employee"

        document.querySelector(".table-fixed").appendChild(buildHeader())

        const employee = {!! $employee !!}

        state.data = employee
        state.allData = employee
        paginate()
        pageNumber()
        buildTable()

        function show(id) {
            const component = employee.find(data => data.id === id);
            const modal = document.querySelector('#modal');
            document.querySelector('#modal-background').classList.remove('hidden');

            modal.classList.remove('opacity-0', '-z-40');
            modal.classList.add('opacity-100', 'z-40');

            modal.innerHTML = `
            <div class="w-[500px] bg-white rounded-xl text-gray-800">
                <div class="py-[20px] px-[30px] w-full relative border-b-2 border-gray-200 flex justify-between items-center">
                    <div class="text-xl font-bold">Detail Karyawan</div>
                    <div onclick="hideModal()" class="absolute flex items-center p-1 text-2xl transition-all rounded-full cursor-pointer right-5 hover:bg-slate-100"><ion-icon name="close-outline"></ion-icon>
                    </div>
                </div>

                <div class="px-[30px] py-[20px] text-sm">
                    <div class="grid grid-cols-[1fr_1fr] mb-1">
                        <div class="flex justify-between w-40 font-bold">Nama<span> : </span></div>
                        <div class="">${component.employee_name}</div>
                    </div>
                    <div class="grid grid-cols-[1fr_1fr] mb-1">
                        <div class="flex justify-between w-40 font-bold">Kode RFID<span> : </span></div>
                        <div class="">${component.rfid}</div>
                    </div>
                    </div>
                    <div class="pb-[20px] px-[30px] w-full flex justify-end items-center">
                    <button onclick="hideModal()" class="py-2 px-5 border text-[#768498] text-sm rounded-lg hover:bg-[#F7F9F9]">Kembali</button>
                </div>
                </div>
            </div>
            `
        }
    </script>
@endpush
