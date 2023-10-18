{{-- @dd($sales) --}}
@extends('layouts.layout')

@section('content')
    <div class="text-xl font-bold mb-10">Penjualan</div>
    <div class="flex gap-5 mb-10">
        <div class="relative flex items-end justify-center w-full h-40 group">
            <div
                class="w-[90%] group-hover:scale-110 transition duration-500 h-20 bg-slate-50 shadow-[0px_3px_20px_#0000000b] rounded-xl z-0">
            </div>
            <div
                class="w-full group-hover:scale-110 transition duration-500 h-40 p-5 rounded-xl shadow-[0px_3px_20px_#0000000b] absolute -top-3 bg-white">
                <ion-icon class="text-3xl text-red-500" name="today-outline"></ion-icon>
                <h1 id="sale_pembayaran_jatuh_tempo" class="font-bold text-2xl mt-4 text-[#1E293B]"></h1>
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
                <h1 id="sale_pembayaran_belum_selesai" class="font-bold text-2xl mt-4 text-[#1E293B]"></h1>
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
                <h1 id="sale_pembayaran_lunas" class="font-bold text-2xl mt-4 text-[#1E293B]"></h1>
                <div class="text-[#707E94] mt-2">Pembayaran Lunas</div>
            </div>
        </div>
    </div>

    <div class="text-xl font-bold mb-10">Pembelian</div>
    <div class="flex gap-5 mb-20">
        <div class="relative flex items-end justify-center w-full h-40 group">
            <div
                class="w-[90%] group-hover:scale-110 transition duration-500 h-20 bg-slate-50 shadow-[0px_3px_20px_#0000000b] rounded-xl z-0">
            </div>
            <div
                class="w-full group-hover:scale-110 transition duration-500 h-40 p-5 rounded-xl shadow-[0px_3px_20px_#0000000b] absolute -top-3 bg-white">
                <ion-icon class="text-3xl text-red-500" name="today-outline"></ion-icon>
                <h1 id="purchase_pembayaran_jatuh_tempo" class="font-bold text-2xl mt-4 text-[#1E293B]"></h1>
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
                <h1 id="purchase_pembayaran_belum_selesai" class="font-bold text-2xl mt-4 text-[#1E293B]"></h1>
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
                <h1 id="purchase_pembayaran_lunas" class="font-bold text-2xl mt-4 text-[#1E293B]"></h1>
                <div class="text-[#707E94] mt-2">Pembayaran Lunas</div>
            </div>
        </div>
    </div>

@endsection
@push('script')
    <script>
        const sales = {!! $sales !!}
        const purchases = {!! $purchases !!}

        let currentDate = new Date();

        sale_set_belum_selesai()
        sale_set_jatuh_tempo()
        sale_set_lunas()

        purchase_set_belum_selesai()
        purchase_set_lunas()
        purchase_set_jatuh_tempo()

        document.querySelectorAll(".rupiah").forEach(element => {
            element.innerText = toRupiah(element.innerText)
        });

        function sale_set_belum_selesai() {
            let filteredData = sales.filter(item => {
                let dueDate = new Date(item.due_date);
                return dueDate > currentDate;
            });

            let belum_selesai = 0

            if (filteredData.length > 0) {
                belum_selesai = filteredData.reduce((total, data) => total + data.remain_bill, 0)
            }

            document.getElementById("sale_pembayaran_belum_selesai").innerText = toRupiah(belum_selesai);
            console.log(toRupiah(belum_selesai))
        }

        function sale_set_lunas() {
            let lunas = sales.reduce((total, data) => {
                let paid = data.histories.reduce((acc, cur) => cur.payment + acc, 0)

                return total + paid
            }, 0)

            document.getElementById("sale_pembayaran_lunas").innerText = toRupiah(lunas);
            console.log(toRupiah(lunas))
        }

        function sale_set_jatuh_tempo() {
            let filteredData = sales.filter(item => {
                let dueDate = new Date(item.due_date)
                return dueDate < currentDate
            })

            let jatuh_tempo = 0

            if (filteredData.length > 0) {
                jatuh_tempo = filteredData.reduce((total, data) => total + data.remain_bill, 0)
            }

            document.getElementById("sale_pembayaran_jatuh_tempo").innerText = toRupiah(jatuh_tempo);
            console.log(toRupiah(jatuh_tempo))
        }

        function purchase_set_belum_selesai() {
            let filteredData = purchases.filter(item => {
                let dueDate = new Date(item.due_date);
                return dueDate > currentDate;
            });

            let belum_selesai = 0

            if (filteredData.length > 0) {
                belum_selesai = filteredData.reduce((total, data) => total + data.remain_bill, 0)
            }

            document.getElementById("purchase_pembayaran_belum_selesai").innerText = toRupiah(belum_selesai);
        }

        function purchase_set_lunas() {
            let lunas = purchases.reduce((total, data) => {
                let paid = data.histories.reduce((acc, cur) => cur.payment + acc, 0)

                return total + paid
            }, 0)

            document.getElementById("purchase_pembayaran_lunas").innerText = toRupiah(lunas);
            console.log(toRupiah(lunas))
        }

        function purchase_set_jatuh_tempo() {
            let filteredData = purchases.filter(item => {
                let dueDate = new Date(item.due_date)
                return dueDate < currentDate
            })

            let jatuh_tempo = 0

            if (filteredData.length > 0) {
                jatuh_tempo = filteredData.reduce((total, data) => total + data.remain_bill, 0)
            }

            document.getElementById("purchase_pembayaran_jatuh_tempo").innerText = toRupiah(jatuh_tempo);
            console.log(toRupiah(jatuh_tempo))
        }

    </script>
@endpush
