@extends('layouts.layout')

@section('content')
    {{-- @dd($warehouse[0]->production->product->name) --}}
    <x-data-list :isReadOnly="true">
        <div class="h-[550px] relative">
            <table class="w-full mt-5 border-separate table-fixed border-spacing-y-3">
                <thead>
                    <tr class="text-center">
                        <th class="px-4 py-5 font-[500] w-14">No</th>
                        <th class="px-4 py-5 font-[500]">Nama Produk</th>
                        <th class="px-4 py-5 font-[500]">Kode RFID</th>
                        <th class="px-4 py-5 font-[500]">Barcode</th>
                        <th class="px-4 py-5 font-[500]">Kuantitas</th>
                    </tr>
                </thead>
                <tbody id="table-body" class="text-center ">
                    @foreach ($warehouse as $no => $wh)
                        <tr id="daftar-item" class="text-sm bg-white  drop-shadow-[0_0_15px_rgba(0,0,0,0.05)]">
                            <td class="id-item hidden">{{ $wh->id }}</td>
                            <td class="p-4 border-r rounded-l-lg border-slate-200">{{ $no + 1 }}</td>
                            <td class="p-4">{{ $wh->production->product->name }}</td>
                            <td class="p-4">{{ $wh->production->product->rfid }}</td>
                            <td class="p-4">{{ $wh->production->product->barcode }}</td>
                            <td class="p-4 rounded-r-lg">{{ $wh->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
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

        const warehouses = {!! $warehouses !!}

        state.data = warehouses
        state.allData = warehouses

        paginate()
        pageNumber()
        buildTable()
    </script>
@endpush
