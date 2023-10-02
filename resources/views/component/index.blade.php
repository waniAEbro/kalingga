@extends('layouts.layout')

@section('content')
    <x-data-list :heads="['No', 'Nama Component', 'Unit', 'Harga Per Unit', 'Aksi']">
        @foreach ($components as $no => $component)
            <tr class="text-sm bg-white drop-shadow-[0_0_15px_rgba(0,0,0,0.05)]">
                <td class="p-4 border-r border-slate-200  rounded-l-lg">{{ $no + 1 }}</td>
                <td class="p-4 break-words">{{ $component->name }}</td>
                <td class="p-4 break-words">{{ $component->unit }}</td>
                <td class="p-4 break-words rupiah">{{ $component->price_per_unit }}</td>
                <td class="p-4 rounded-r-lg">
                    <div class="flex items-center justify-center gap-3 border-l h-7 border-slate-200">
                        <a href="/components/{{ $component->id }}/edit" class="flex items-center gap-1 text-slate-600"><span
                                class="text-lg"><ion-icon name="create-outline"></ion-icon></span>Edit</a>
                        <form action="/components/{{ $component->id }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="flex items-center gap-1 text-red-700"><span
                                    class="text-lg"><ion-icon name="trash-outline"></ion-icon></span>Hapus</button>

                        </form>
                    </div>

                </td>
            </tr>
        @endforeach
    </x-data-list>
@endsection
