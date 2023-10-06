@extends('layouts.layout')

@section('content')
    {{-- @dd($warehouse[0]->production->product->name) --}}
    <x-data-list :isReadOnly="true">
        <div class="h-[550px] relative">
            <table class="w-full mt-5 border-separate table-fixed border-spacing-y-3">
            </table>
            <div id="pagination-wrapper" class="absolute bottom-0 flex h-10 gap-2 my-5 text-sm"></div>
        </div>
    </x-data-list>
@endsection

@push('script')
    <script>
        state.columnName = ["Nomor", "Nama Produk", "RFID", "Barcode", "Jumlah", "Aksi"]
        state.columnQuery = ["production.product.name", "production.product.rfid", "production.product.barcode", "quantity"]
        state.menu = "warehouse"

        document.querySelector(".table-fixed").appendChild(buildHeader())

        const warehouse = {!! $warehouse !!}

        state.data = warehouse
        state.allData = warehouse

        paginate()
        pageNumber()
        buildTable()
    </script>
@endpush
