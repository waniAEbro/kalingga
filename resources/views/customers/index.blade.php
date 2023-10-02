@extends('layouts.layout')

@section('content')
    <x-data-list>
        <table class="w-full mt-5 border-separate table-fixed border-spacing-y-3">
            <thead>
                <tr class="text-center">
                    <th class="px-4 py-5 font-[500] w-14">No</th>
                    <th class="px-4 py-5 font-[500]">Nama Pelanggan</th>
                    <th class="px-4 py-5 font-[500]">Email</th>
                    <th class="px-4 py-5 font-[500]">No Hp</th>
                    <th class="px-4 py-5 font-[500]">Alamat</th>
                    <th class="px-4 py-5 font-[500]">Kode Pelanggan</th>
                    <th class="px-4 py-5 font-[500] w-[200px]">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center ">
                @foreach ($customers as $no => $customer)
                    <tr class="text-sm bg-white drop-shadow-[0_0_15px_rgba(0,0,0,0.05)]">
                        <td class="p-4 border-r rounded-l-lg border-slate-200">{{ $no + 1 }}</td>
                        <td class="p-4 break-words">{{ $customer->name }}</td>
                        <td class="p-4 break-words">{{ $customer->email }}</td>
                        <td class="p-4 break-words">{{ $customer->phone }}</td>
                        <td class="p-4 break-words">{{ $customer->address }}</td>
                        <td class="p-4 break-words">{{ $customer->code }}</td>
                        <td class="p-4 rounded-r-lg">
                            <div class="flex items-center justify-center gap-3 border-l h-7 border-slate-200">
                                <a href="/customers/{{ $customer->id }}/edit"
                                    class="flex items-center gap-1 text-slate-600"><span class="text-lg"><ion-icon
                                            name="create-outline"></ion-icon></span>Edit</a>
                                <form action="/customers/{{ $customer->id }}" method="POST">
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
    </x-data-list>
@endsection
