@extends('layouts.layout')

@section('content')
    <div class="flex relative gap-5 mb-10">
        <div
            class="w-full peer/satu hover:scale-110 transition duration-500 h-40 p-5 rounded-xl shadow-[0px_3px_20px_#0000000b] bg-white z-10">
            <ion-icon class="text-3xl text-yellow-400" name="today-outline"></ion-icon>
            <h1 class="font-bold text-2xl mt-4 text-[#1E293B]"></h1>
            <div id="pembayaran_jatuh_tempo" class="text-[#707E94] mt-2">Pembayaran Jatuh Tempo</div>
        </div>
        <div
            class="w-[300px] peer-hover/satu:scale-110 transition duration-500 h-20 bg-slate-50 shadow-[0px_3px_20px_#0000000b] absolute rounded-xl -bottom-3 left-4">
        </div>

        <div
            class="w-full peer/dua hover:scale-110 duration-500 h-40 p-5 rounded-xl shadow-[0px_3px_20px_#0000000b] bg-white z-10">
            <ion-icon class="text-3xl text-red-600" name="time-outline"></ion-icon>
            <h1 class="font-bold text-2xl mt-4 text-[#1E293B]"></h1>
            <div id="pembayara_belum_selesai" class="text-[#707E94] mt-2">Pembayaran Belum Selesai</div>
        </div>
        <div
            class="w-[300px] peer-hover/dua:scale-110 duration-500 h-20 bg-slate-50 shadow-[0px_3px_20px_#0000000b] absolute rounded-xl -bottom-3 left-[367px]">
        </div>


        <div
            class="w-full peer/tiga hover:scale-110 duration-500 h-40 p-5 rounded-xl shadow-[0px_3px_20px_#0000000b] bg-white z-10">
            <ion-icon class="text-3xl text-green-600" name="checkmark-done-circle-outline"></ion-icon>
            <h1 class="font-bold text-2xl mt-4 text-[#1E293B]"></h1>
            <div id="pembayaran_lunas" class="text-[#707E94] mt-2">Pembayaran Lunas</div>
        </div>
        <div
            class="w-[300px] peer-hover/tiga:scale-110 duration-500 h-20 bg-slate-50 shadow-[0px_3px_20px_#0000000b] absolute rounded-xl -bottom-3 left-[720px]">
        </div>
    </div>
    {{-- <div class="flex m-8 space-x-5">
        <div class="flex-1 rounded-lg overflow-hidden border-2 border-yellow-500 shadow-lg shadow-yellow-300">
            <div class="border-b-2 border-yellow-500 px-6 py-4 mb-2 mt-2 ">
                <div class="font-bold text-xl mb-2 text-center">Pembayaran Belum Selesai</div>
            </div>
            <div class="px-6 pt-4 pb-4 text-center">
                <p id="pembayaran_belum_selesai"></p>
            </div>
        </div>
        <div class="flex-1 rounded-lg overflow-hidden border-2 border-red-500 shadow-lg shadow-red-300">
            <div class="border-b-2 border-red-500 px-6 py-4 mb-2 mt-2 ">
                <div class="font-bold text-xl mb-2 text-center">Pembayaran Jatuh Tempo</div>
            </div>
            <div class="px-6 pt-4 pb-4 text-center">
                <p id="pembayaran_jatuh_tempo"></p>
            </div>
        </div>
        <div class="flex-1 rounded-lg overflow-hidden border-2 border-green-500 shadow-lg shadow-green-300">
            <div class="border-b-2 border-green-500 px-6 py-4 mb-2 mt-2 ">
                <div class="font-bold text-xl mb-2 text-center">Penjualan Lunas</div>
            </div>
            <div class="px-6 pt-4 pb-4 text-center">
                <p id="pembayaran_lunas"></p>
            </div>
        </div>
    </div> --}}
    <x-data-list :heads="['No', 'Date', 'Customer', 'Due Date', 'Status', 'Remaining Bill', 'Total']">
        @foreach ($sales as $no => $sale)
            <tr class="text-sm bg-white drop-shadow-[0_0_15px_rgba(0,0,0,0.05)]">
                <td class="p-4 rounded-l-lg">{{ $no + 1 }}</td>
                <td class="p-4">{{ $sale->sale_date }}</td>
                <td class="p-4">{{ $sale->customer->name }}</td>
                <td class="p-4">{{ $sale->due_date }}</td>
                <td class="p-4">{{ $sale->status }}</td>
                <td class="p-4 rupiah">{{ $sale->remain_bill }}</td>
                <td class="p-4 rupiah">{{ $sale->total_bill }}</td>
                <td class="p-4 rounded-r-lg">
                    <div class="flex items-center justify-center gap-3 border-l h-7 border-slate-200">
                        <a href="/sales/{{ $sale->id }}/edit" class="flex items-center gap-1 text-slate-600"><span
                                class="text-lg"><ion-icon name="create-outline"></ion-icon></span>Edit</a>
                        <form action="/sales/{{ $sale->id }}">
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
@push('script')
    <script>
        let sales = {!! $sales !!}

        let currentDate = new Date();

        function set_belum_selesai() {
            let filteredData = sales.filter(item => {
                let dueDate = new Date(item.due_date);
                return dueDate > currentDate;
            });

            let belum_selesai = 0

            if (filteredData.length > 0) {
                belum_selesai = filteredData.reduce((total, data) => total + data.remain_bill, 0)
            }

            document.getElementById("pembayaran_belum_selesai").innerText = toRupiah(belum_selesai);
        }

        function set_lunas() {
            let lunas = sales.reduce((total, data) => total + data.paid, 0)

            document.getElementById("pembayaran_lunas").innerText = toRupiah(lunas);
        }

        function set_jatuh_tempo() {
            let filteredData = sales.filter(item => {
                let dueDate = new Date(item.due_date)
                return dueDate < currentDate
            })

            let jatuh_tempo = 0

            if (filteredData.length > 0) {
                jatuh_tempo = filteredData.reduce((total, data) => total + data.remain_bill, 0)
            }

            document.getElementById("pembayaran_jatuh_tempo").innerText = toRupiah(jatuh_tempo);
        }

        set_belum_selesai()
        set_jatuh_tempo()
        set_lunas()

        document.querySelectorAll(".rupiah").forEach(element => {
            element.innerText = toRupiah(element.innerText)
        });
    </script>
@endpush
