@extends('layouts.layout')

@section('content')
    <x-data-list>
        <div class="h-[550px] relative">

            <table class="w-full mt-5 border-separate table-fixed border-spacing-y-3">
            </table>
            <div id="pagination-wrapper" class="absolute bottom-0 flex h-10 gap-2 my-5 text-sm"></div>
        </div>
    </x-data-list>
@endsection

@push('script')
    <script>
        state.columnName = ["Nomor", "Nama Customer", "Email", "Nomor Telepon", "Alamat", "Kode", "Aksi"]
        state.columnQuery = ["name", "email", "phone", "address", "code"]
        state.menu = "customers"

        document.querySelector(".table-fixed").appendChild(buildHeader())

        const customers = {!! $customers !!}

        state.data = customers
        state.allData = customers

        paginate()
        pageNumber()
        buildTable()
    </script>
@endpush
