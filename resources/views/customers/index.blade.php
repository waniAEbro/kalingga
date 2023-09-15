@extends('layouts.layout')

@section('content')
    <x-data-list :heads="['No', 'Customer Name', 'Email', 'Phone', 'Address', 'Code']">
        @foreach ($customers as $no => $customer)
            <tr class="text-sm bg-white drop-shadow-[0_0_15px_rgba(0,0,0,0.05)]">
                <td class="p-4 rounded-l-lg">{{ $no + 1 }}</td>
                <td class="p-4">{{ $customer->name }}</td>
                <td class="p-4">{{ $customer->email }}</td>
                <td class="p-4">{{ $customer->phone }}</td>
                <td class="p-4">{{ $customer->address }}</td>
                <td class="p-4">{{ $customer->code }}</td>
                <td class="p-4 rounded-r-lg">
                    <div class="flex items-center justify-center gap-3 border-l h-7 border-slate-200">
                        <a href="productions/{{ $customer->id }}/edit" class="flex items-center gap-1 text-slate-600"><span
                                class="text-lg"><ion-icon name="create-outline"></ion-icon></span>Edit</a>
                        <form action="productions / {{ $customer->id }}">
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
