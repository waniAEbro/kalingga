@extends('layouts.layout')

@section('content')
    <div class="flex gap-5 mb-10">
        <div class="relative flex items-end justify-center w-full h-40 group">
            <div
                class="w-[90%] group-hover:scale-110 transition duration-500 h-20 bg-slate-50 shadow-[0px_3px_20px_#0000000b] rounded-xl z-0">
            </div>
            <div
                class="w-full group-hover:scale-110 transition duration-500 h-40 p-5 rounded-xl shadow-[0px_3px_20px_#0000000b] absolute -top-3 bg-white">
                <ion-icon class="text-3xl text-red-500" name="today-outline"></ion-icon>
                <h1 id="pembayaran_jatuh_tempo" class="font-bold text-2xl mt-4 text-[#1E293B]"></h1>
                <div class="text-[#707E94] mt-2">Pembayaran Jatuh Tempo</div>
            </div>
        </div>
        <div class="relative flex items-end justify-center w-full h-40 group">
            <div
                class="w-[90%] group-hover:scale-110 transition duration-500 h-20 bg-slate-50 shadow-[0px_3px_20px_#0000000b] rounded-xl z-0">
            </div>
            <div
                class="w-full group-hover:scale-110 transition duration-500 h-40 p-5 rounded-xl shadow-[0px_3px_20px_#0000000b] absolute -top-3 bg-white">
                <ion-icon class="text-3xl text-yellow-500" name="time-outline"></ion-icon>
                <h1 id="pembayaran_belum_selesai" class="font-bold text-2xl mt-4 text-[#1E293B]"></h1>
                <div class="text-[#707E94] mt-2">Pembayaran Belum Selesai</div>
            </div>
        </div>
        <div class="relative flex items-end justify-center w-full h-40 group">
            <div
                class="w-[90%] group-hover:scale-110 transition duration-500 h-20 bg-slate-50 shadow-[0px_3px_20px_#0000000b] rounded-xl z-0">
            </div>
            <div
                class="w-full group-hover:scale-110 transition duration-500 h-40 p-5 rounded-xl shadow-[0px_3px_20px_#0000000b] absolute -top-3 bg-white">
                <ion-icon class="text-3xl text-green-600" name="checkmark-done-circle-outline"></ion-icon>
                <h1 id="pembayaran_lunas" class="font-bold text-2xl mt-4 text-[#1E293B]"></h1>
                <div class="text-[#707E94] mt-2">Pembayaran Lunas</div>
            </div>
        </div>
    </div>

    <x-data-list>
        <div class="h-[580px] relative">
            <table class="w-full mt-5 border-separate table-fixed border-spacing-y-3">
            </table>
            <div id="pagination-wrapper" class="absolute bottom-0 flex h-10 gap-2 my-5 text-sm"></div>
        </div>
    </x-data-list>
@endsection
@push('script')
    <script>
        state.columnName = ["Nomor", "Nama Supplier", "Tangggal Transaksi", "Jatuh Tempo", "Status", "Sisa Stansaksi",
            "Total Transaksi", "Aksi"
        ]
        state.columnQuery = ["supplier.name", "emailpurchase_date", "due_date", "status", "remain_bill", "total_bill"]
        state.menu = "purchases"

        document.querySelector(".table-fixed").appendChild(buildHeader())

        const purchases = {!! $purchases !!}

        state.data = purchases
        state.allData = purchases

        paginate()
        pageNumber()
        buildTable()

        set_belum_selesai()
        set_jatuh_tempo()
        set_lunas()

        function set_belum_selesai() {
            let filteredData = purchases.filter(item => {
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
            let lunas = purchases.reduce((total, data) => {
                let paid = data.histories.reduce((acc, cur) => cur.payment + acc, 0)

                return total + paid
            }, 0)

            document.getElementById("pembayaran_lunas").innerText = toRupiah(lunas);
            console.log(toRupiah(lunas))
        }

        function set_jatuh_tempo() {
            let filteredData = purchases.filter(item => {
                let dueDate = new Date(item.due_date)
                return dueDate < currentDate
            })

            let jatuh_tempo = 0

            if (filteredData.length > 0) {
                jatuh_tempo = filteredData.reduce((total, data) => total + data.remain_bill, 0)
            }

            document.getElementById("pembayaran_jatuh_tempo").innerText = toRupiah(jatuh_tempo);
            console.log(toRupiah(jatuh_tempo))
        }
    </script>
@endpush
