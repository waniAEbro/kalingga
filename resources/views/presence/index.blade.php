@extends('layouts.layout')

@section('content')
    <p class="font-bold text-4xl text-center my-8">Presensi bulan <span id="nama-bulan">
            {{ Carbon\Carbon::now()->locale('id')->isoFormat('MMMM') }}</span></p>
    <x-data-list>
        <div class="h-[500px] relative">
            <table class="w-full mt-5 border-separate table-fixed border-spacing-y-3">
            </table>
            <div id="pagination-wrapper" x-data class="absolute bottom-0 flex h-10 gap-2 text-sm"></div>
        </div>
    </x-data-list>
    <input type="month" id="bulan" oninput="changeDate(this)">
@endsection

@push('script')
    <script>
        function changeDate(element) {
            current_date = new Date(element.value)
            buildTable()
            document.querySelector("#nama-bulan").innerHTML = current_date.toLocaleString('id', {
                month: 'long'
            })
            document.querySelectorAll(".tanggal_cetak").forEach(e => {
                e.value = element.value
            })
        }

        function show(id) {
            window.location.href = `/presence/${id}`
        }

        let current_date = new Date()
        state.columnName = ["Nomor", "Nama Karyawan", "RFID", "Jumlah Masuk", "Aksi"]
        state.columnQuery = ["employee_name", "rfid",
            "presence.filter(e => new Date(e.created_at).getMonth() == current_date.getMonth() && new Date(e.created_at).getYear() == current_date.getYear()).length"
        ]
        state.menu = "presence"

        document.querySelector(".table-fixed").appendChild(buildHeader())

        const employees = {!! $employees !!}

        state.data = employees
        state.allData = employees
        paginate()
        pageNumber()
        buildTable()
    </script>
@endpush
