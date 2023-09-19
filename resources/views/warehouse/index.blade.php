@extends('layouts.layout')

@section('content')
    {{-- @dd($warehouse[0]->production->product->name) --}}
    <x-data-list :heads="['No', 'Product Name', 'RFID', 'Barcode', 'Quantity']" :isReadOnly="true">
        @foreach ($warehouse as $no => $warehouse)
            <tr class="text-sm bg-white drop-shadow-[0_0_15px_rgba(0,0,0,0.05)]">
                <td class="p-4 rounded-l-lg">{{ $no + 1 }}</td>
                <td class="p-4">{{ $warehouse->production->product->name }}</td>
                <td class="p-4">{{ $warehouse->production->product->rfid }}</td>
                <td class="p-4">{{ $warehouse->production->product->barcode }}</td>
                <td class="p-4 rounded-r-lg">{{ $warehouse->quantity }}</td>

            </tr>
        @endforeach
    </x-data-list>
@endsection
