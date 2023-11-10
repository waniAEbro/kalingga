@extends('layouts.layout')

@section('content')
    <p class="font-bold text-4xl text-center my-8">Presensi {{ $employee->employee_name }}</p>

    {{-- @dump($employee) --}}
    <div id='calendar'></div>
@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
    <script>
        const employee = {!! $employee !!}.presence.map(e => {
            const start = new Date(e.created_at)
            const end = new Date(e.updated_at)
            let color = ""
            let title = ""
            if (start.getHours() > 8 && start.getMinutes() > 0 && start.getSeconds() > 0) {
                title = "telat masuk"
                color = "red"
            } else if (start.getTime() == end.getTime()) {
                title = "Belum Absen pulang"
                color = "yellow"
            } else {
                title = "tepat waktu"
                color = "green"
            }
            return {
                title,
                start,
                end,
                color
            }
        })

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: employee,
                eventClick: function(info) {
                    const modal = document.querySelector('#modal');
                    document.querySelector('#modal-background').classList.remove('hidden');

                    modal.classList.remove('opacity-0', '-z-40');
                    modal.classList.add('opacity-100', 'z-40');

                    modal.innerHTML = `
            <div class="w-[500px] bg-white rounded-xl text-gray-800">
                <div class="py-[20px] px-[30px] w-full relative border-b-2 border-gray-200 flex justify-between items-center">
                    <div class="text-xl font-bold">Detail Presensi</div>
                    <div onclick="hideModal()" class="absolute flex items-center p-1 text-2xl transition-all rounded-full cursor-pointer right-5 hover:bg-slate-100"><ion-icon name="close-outline"></ion-icon>
                    </div>
                </div>

                <div class="px-[30px] py-[20px] text-sm">
                    <div class="grid grid-cols-[1fr_1fr] mb-1">
                        <div class="flex justify-between w-40 font-bold">Masuk<span> : </span></div>
                        <div class="">${info.event.start.getHours()}:${info.event.start.getMinutes()}:${info.event.start.getSeconds()}</div>
                    </div>
                    <div class="grid grid-cols-[1fr_1fr] mb-1">
                        <div class="flex justify-between w-40 font-bold">Pulang<span> : </span></div>
                        <div class="">${info.event.end == null ? "Belum Absen pulang" : info.event.end.getHours() + ":" + info.event.end.getMinutes() + ":" + info.event.end.getSeconds()}</div>
                    </div>
                    </div>
                    <div class="pb-[20px] px-[30px] w-full flex justify-end items-center">
                    <button onclick="hideModal()" class="py-2 px-5 border text-[#768498] text-sm rounded-lg hover:bg-[#F7F9F9]">Kembali</button>
                </div>
                </div>
            </div>
            `
                },
                eventMouseLeave: function(info) {
                    console.log(info)
                }
            });
            calendar.render();
        });
    </script>
@endpush
