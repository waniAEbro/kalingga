@extends('layouts.layout')

@section('content')
    <x-data-list :heads="['No', 'Supplier ID', 'Purchase Date', 'Due Date', 'Status', 'Remaining Bill', 'Total Bill', 'Paid']">
        @foreach ($purchases as $no => $purchase)
            <tr class="text-sm bg-white drop-shadow-[0_0_15px_rgba(0,0,0,0.05)]">
                <td class="p-4 rounded-l-lg">{{ $no + 1 }}</td>
                <td class="p-4">{{ $purchase->supplier_id }}</td>
                <td class="p-4">{{ $purchase->purchase_date }}</td>
                <td class="p-4">{{ $purchase->due_date }}</td>
                <td class="p-4">{{ $purchase->status }}</td>
                <td class="p-4">{{ $purchase->remain_bill }}</td>
                <td class="p-4">{{ $purchase->total_bill }}</td>
                <td class="p-4">{{ $purchase->paid }}</td>
                <td class="p-4 rounded-r-lg">
                    <div class="flex items-center justify-center gap-3 border-l h-7 border-slate-200">
                        <a href="/purchases/{{ $purchase->id }}/edit" class="flex items-center gap-1 text-slate-600"><span
                                class="text-lg"><ion-icon name="create-outline"></ion-icon></span>Edit</a>
                        <form action="/purchases/{{ $purchase->id }}">
                            @csrf
                            @method('delete')
                            <button class="flex items-center gap-1 text-red-700"><span class="text-lg"><ion-icon
                                        name="trash-outline"></ion-icon></span>Delete</button>

                        </form>
                    </div>

                </td>
            </tr>
        @endforeach
    </x-data-list>
@endsection
