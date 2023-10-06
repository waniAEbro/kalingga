@extends('layouts.layout')

@section('content')
    <x-data-list>
        <div class="h-[550px] relative">
            <table class="w-full mt-5 border-separate table-fixed border-spacing-y-3">
                <thead>
                    <tr class="text-center">
                        <th class="px-4 py-5 font-[500] w-14">No</th>
                        <th class="px-4 py-5 font-[500]">Nama Produk</th>
                        <th class="px-4 py-5 font-[500]">Kode Produk</th>
                        <th class="px-4 py-5 font-[500]">Kode RFID</th>
                        <th class="px-4 py-5 font-[500]">Harga Jual</th>
                        <th class="px-4 py-5 font-[500] w-[200px]">Aksi</th>
                    </tr>
                </thead>
                <tbody id="table-body" class="text-center ">
                    @foreach ($products as $no => $product)
                        <tr id="daftar-item" id="products"
                            class="text-sm bg-white drop-shadow-[0_0_15px_rgba(0,0,0,0.05)]">
                            <td class="id-item hidden">{{ $product->id }}</td>
                            <td class="p-4 border-r rounded-l-lg border-slate-200">{{ $no + 1 }}</td>
                            <td class="p-4 break-words">{{ $product->name }}</td>
                            <td class="p-4 break-words">{{ $product->code }}</td>
                            <td class="p-4 break-words">{{ $product->rfid }}</td>
                            <td class="p-4 break-words rupiah">{{ $product->sell_price }}</td>
                            <td class="p-4 rounded-r-lg">
                                <div class="flex items-center justify-center gap-3 border-l h-7 border-slate-200">
                                    <a href="/products/{{ $product->id }}/edit"
                                        class="flex items-center gap-1 text-slate-600"><span class="text-lg"><ion-icon
                                                name="create-outline"></ion-icon></span>Edit</a>
                                    <form action="/products/{{ $product->id }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="flex items-center gap-1 text-red-700"><span class="text-lg"><ion-icon
                                                    name="trash-outline"></ion-icon></span>Delete</button>
                                    </form>
                                </div>
                            </td>
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
        const products = {!! $products !!}

        state.querySet = products
        state.data = products

        buildTable()
    </script>
@endpush
