@extends('layouts.layout')

@section('content')
    {{-- @dd($warehouse[0]->production->product->name) --}}
    <x-data-list :isReadOnly="true">
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
            <tbody id="body" class="text-center ">
                @foreach ($warehouse as $no => $warehouse)
                    <tr id="daftar-item" class="text-sm bg-white drop-shadow-[0_0_15px_rgba(0,0,0,0.05)]">
                        <td class="p-4 border-r rounded-l-lg border-slate-200">{{ $no + 1 }}</td>
                        <td class="p-4">{{ $warehouse->production->product->name }}</td>
                        <td class="p-4">{{ $warehouse->production->product->rfid }}</td>
                        <td class="p-4">{{ $warehouse->production->product->barcode }}</td>
                        <td class="p-4 rounded-r-lg">{{ $warehouse->quantity }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-list>
    <div class="h-[900px] xl:h-1 w-10 bg-yellow-400"></div>
@endsection
