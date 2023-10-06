@extends('layouts.layout')

@section('content')
    <x-data-list>
        <div class="h-[550px] relative">
            <table class="w-full mt-5 border-separate table-fixed border-spacing-y-3">
                <thead>
                    <tr class="text-center">
                        <th class="px-4 py-5 font-[500] w-14">No</th>
                        <th class="px-4 py-5 font-[500]">Nama Komponen</th>
                        <th class="px-4 py-5 font-[500]">Unit</th>
                        <th class="px-4 py-5 font-[500]">Harga Per Unit</th>
                        <th class="px-4 py-5 font-[500] w-[200px]">Aksi</th>
                    </tr>
                </thead>
                <tbody id="table-body" class="text-center ">
                    @foreach ($components as $no => $component)
                        <tr id="daftar-item" class="text-sm bg-white drop-shadow-[0_0_15px_rgba(0,0,0,0.05)]">
                            <td class="id-item hidden">{{ $component->id }}</td>
                            <td class="p-4 border-r rounded-l-lg border-slate-200">{{ $no + 1 }}</td>
                            <td class="p-4 break-words">{{ $component->name }}</td>
                            <td class="p-4 break-words">{{ $component->unit }}</td>
                            <td class="p-4 break-words rupiah">{{ $component->price_per_unit }}</td>
                            <td class="p-4 rounded-r-lg">
                                <div class="flex items-center justify-center gap-3 border-l h-7 border-slate-200">
                                    <a href="/components/{{ $component->id }}/edit"
                                        class="flex items-center gap-1 text-slate-600"><span class="text-lg"><ion-icon
                                                name="create-outline"></ion-icon></span>Edit</a>
                                    <form action="/components/{{ $component->id }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="flex items-center gap-1 text-red-700"><span
                                                class="text-lg"><ion-icon
                                                    name="trash-outline"></ion-icon></span>Hapus</button>
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
        const components = {!! $components !!}

        state.querySet = components
        state.data = components

        buildTable()
    </script>
@endpush
