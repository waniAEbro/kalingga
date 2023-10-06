@extends('layouts.layout')

@section('content')
    {{-- @dd($suppliers) --}}
    <x-data-list>
        <div class="h-[550px] relative">
            <table class="w-full mt-5 border-separate table-fixed border-spacing-y-3">
                <thead>
                    <tr class="text-center">
                        <th class="px-4 py-5 font-[500] w-14">No</th>
                        <th class="px-4 py-5 font-[500]">Nama Pemasok</th>
                        <th class="px-4 py-5 font-[500]">Email</th>
                        <th class="px-4 py-5 font-[500]">No Hp</th>
                        <th class="px-4 py-5 font-[500]">Alamat</th>
                        <th class="px-4 py-5 font-[500] w-[200px]">Aksi</th>
                    </tr>
                </thead>
                <tbody id="table-body" class="text-center ">
                    @foreach ($suppliers as $no => $supplier)
                        <tr id="daftar-item" class="text-sm bg-white drop-shadow-[0_0_15px_rgba(0,0,0,0.05)]">
                            <td class="id-item hidden">{{ $supplier->id }}</td>
                            <td class="p-4 border-r rounded-l-lg border-slate-200">{{ $no + 1 }}</td>
                            <td class="p-4 break-words">{{ $supplier->name }}</td>
                            <td class="p-4 break-words">{{ $supplier->email }}</td>
                            <td class="p-4 break-words">{{ $supplier->phone }}</td>
                            <td class="p-4 break-words">{{ $supplier->address }}</td>
                            <td class="p-4 rounded-r-lg">
                                <div class="flex items-center justify-center gap-3 border-l h-7 border-slate-200">
                                    <a href="/suppliers/${list.id}/edit"
                                        class="flex items-center gap-1 text-slate-600"><span class="text-lg"><ion-icon
                                                name="create-outline"></ion-icon></span>Edit</a>
                                    <form action="/suppliers/${list.id}" method="POST">
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
        state.columnName = ["Nomor", "Nama Customer", "Email", "Nomor Telepon", "Alamat", "Kode", "Aksi"]
        state.columnQuery = ["name", "email", "phone", "address", "code"]
        state.menu = "suppliers"

        document.querySelector(".table-fixed").appendChild(buildHeader())

        const suppliers = {!! $suppliers !!}

        state.data = suppliers
        state.allData = suppliers

        paginate()
        pageNumber()
        buildTable()
    </script>
@endpush
