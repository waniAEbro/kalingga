@extends('layouts.layout')

@section('content')
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
        const productions = {!! $productions !!}

        state.columnName = ["Nomor", "Kode", "Nama Produk", "Jumlah Belum Selesai", "Jumlah Sudah Selesai", "Jumlah Total",
            "Aksi"
        ]
        state.columnQuery = ["code", "product.name", "quantity_not_finished", "quantity_finished",
            "sale.product.find(el => el.id == data.product_id).pivot.quantity)"
        ]
        state.menu = "productions"

        document.querySelector(".table-fixed").appendChild(buildHeader())

        state.data = productions
        state.allData = productions

        paginate()
        pageNumber()
        buildTable()
    </script>
@endpush
