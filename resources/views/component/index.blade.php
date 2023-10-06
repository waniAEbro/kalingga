@extends('layouts.layout')

@section('content')
    <x-data-list>
        <div class="h-[550px] relative m-5">
            <p id="loading">Loading</p>
            <table class="w-full mt-5 border-separate table-fixed border-spacing-y-3">
            </table>
            <div id="pagination-wrapper" class="absolute bottom-0 flex h-10 gap-2 my-5 text-sm"></div>
        </div>
    </x-data-list>
@endsection

@push('script')
    <script>
        state.columnName = ["Nomor", "Nama Komponen", "Satuan", "Harga Per Satuan", "Aksi"]
        state.columnQuery = ["name", "unit", "price_per_unit"]
        state.menu = "components"

        document.querySelector(".table-fixed").appendChild(buildHeader())

        fetch("/api/components/getdata").then(response => response.json()).then(response => {
            document.getElementById('loading').classList.add('hidden');
            state.data = response
            state.allData = response
            paginate()
            pageNumber()
            buildTable()
        })
    </script>
@endpush
