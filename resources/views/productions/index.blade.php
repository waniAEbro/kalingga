@extends('layouts.layout')

@section('content')
    <x-data-list :isReadOnly="true">
        <div class="h-[550px] relative">
            <table class="w-full mt-5 border-separate table-fixed border-spacing-y-3">
                <thead>
                    <tr class="text-center">
                        <th class="px-4 py-5 font-[500] w-14">No</th>
                        <th class="px-4 py-5 font-[500]">Kode Produksi</th>
                        <th class="px-4 py-5 font-[500]">Nama Produk</th>
                        <th class="px-4 py-5 font-[500]">Belum Selesai</th>
                        <th class="px-4 py-5 font-[500]">Selesai</th>
                        <th class="px-4 py-5 font-[500]">Total Produksi</th>
                        <th class="px-4 py-5 font-[500] w-[200px]">Aksi</th>
                    </tr>
                </thead>
                <tbody id="table-body" class="text-center ">
                    @foreach ($productions as $no => $production)
                        <tr id="daftar-item" class="text-sm bg-white drop-shadow-[0_0_15px_rgba(0,0,0,0.05)]">
                            <td class="p-4 border-r rounded-l-lg border-slate-200">{{ $no + 1 }}</td>
                            <td class="p-4 break-words">{{ $production->code }}</td>
                            <td class="p-4 break-words">{{ $production->product->name }}</td>
                            <td class="p-4 break-words">{{ $production->quantity_not_finished }}</td>
                            <td class="p-4 break-words">{{ $production->quantity_finished }}</td>
                            <td class="p-4 break-words">
                                {{ $production->sale->product->find($production->product_id)->pivot->quantity }}
                            </td>
                            <td class="p-4 rounded-r-lg">
                                <div class="flex items-center justify-center gap-3 border-l h-7 border-slate-200">
                                    <a href="/productions/{{ $production->id }}/edit"
                                        class="flex items-center gap-1 text-slate-600"><span class="text-lg"><ion-icon
                                                name="create-outline"></ion-icon></span>Edit</a>
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
        const productions = {!! $productions !!}

        state.queryState = productions
        state.data = productions

        buildTable()
    </script>
@endpush
