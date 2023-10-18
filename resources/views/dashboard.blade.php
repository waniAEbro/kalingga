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
@endsection
