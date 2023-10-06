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
        state.columnName = ["Nomor", "Nama Produk", "Kode Produk", "RFID", "Harga Jual", "Aksi"]
        state.columnQuery = ["name", "code", "rfid", "sell_price"]
        state.menu = "products"

        document.querySelector(".table-fixed").appendChild(buildHeader())

        const products = {!! $products !!}

        state.data = products
        state.allData = products

        paginate()
        pageNumber()
        buildTable()
    </script>
@endpush
