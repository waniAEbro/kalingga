@extends('layouts.layout')

@push('head')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0- 
     alpha/css/bootstrap.css"
        rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@endpush

@section('content')
    {{-- @dd($warehouse[0]->production->product->name) --}}
    <div id="popup" class="absolute top-10 right-10 z-50">

    </div>
    <x-data-list :isReadOnly="true">
        <div class="h-[550px] relative">
            <table class="w-full mt-5 border-separate table-fixed border-spacing-y-3">
            </table>
            <div id="pagination-wrapper" class="absolute bottom-0 flex h-10 gap-2 my-5 text-sm"></div>
        </div>
    </x-data-list>
@endsection

@push('script')
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('f25045053f0f4e32da39', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            document.querySelector(".warehouses-length").innerText = data.message.count

            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            if (data.message.action == "in") {
                toastr.success(`${data.message.product_name} berhasil ditambahkan ke warehouse`)
            } else {
                toastr.success(`${data.message.product_name} keluar dari warehouse`)
            }



        });

        function removeAlert(el) {
            console.log('el', el)
            setTimeout(() => {
                el.remove()
            }, 5000);
        }
    </script>
    <script>
        state.columnName = ["Nomor", "Nama Produk", "RFID", "Barcode", "Quantity"]
        state.columnQuery = ["name", "rfid", "barcode", "warehouses.length"]
        state.menu = "warehouse"

        document.querySelector(".table-fixed").appendChild(buildHeader())

        const products = {!! $products !!}

        state.data = products
        state.allData = products

        paginate()
        pageNumber()
        buildTable()

        function show(id) {
            const wh = products.find(data => data.id === id);

            const modal = document.querySelector('#modal');
            document.querySelector('#modal-background').classList.remove('hidden');

            modal.classList.remove('opacity-0', '-z-20');
            modal.classList.add('opacity-100', 'z-20');

            modal.innerHTML = `
                <div class="w-[400px] bg-white rounded-xl text-gray-800">
                    <div class="py-[20px] px-[30px] w-full relative border-b-2 border-gray-200 flex justify-between items-center">
                        <div class="text-xl font-bold">Detail Warehouse</div>
                        <div onclick="hideModal()" class="absolute flex items-center p-1 text-2xl transition-all rounded-full cursor-pointer right-5 hover:bg-slate-100"><ion-icon name="close-outline"></ion-icon>
                        </div>
                    </div>
        
                    <div class="px-[30px] py-[20px] text-sm">
                        <div class="grid grid-cols-[1fr_1fr] mb-1">
                            <div class="font-bold w-40 flex justify-between">Nama Produk<div>:</div></div>
                            <div class="">${wh.production.product.name}</div>
                        </div>
                        <div class="grid grid-cols-[1fr_1fr] mb-1">
                            <div class="font-bold w-40 flex justify-between">RFID<div>:</div></div>
                            <div class="">${wh.production.product.rfid}</div>
                        </div>
                        <div class="grid grid-cols-[1fr_1fr] mb-1">
                            <div class="font-bold w-40 flex justify-between">Barcode<div>:</div></div>
                            <div class="">${wh.production.product.barcode}</div>
                        </div>
                        <div class="grid grid-cols-[1fr_1fr] mb-1">
                            <div class="font-bold w-40 flex justify-between">Jumlah<div>:</div></div>
                            <div class="">${wh.quantity}</div>
                        </div>
                    </div>

                    <div class="py-[20px] px-[30px] w-full flex justify-end items-center">
                        <button onclick="hideModal()" class="py-2 px-5 border text-[#768498] text-sm rounded-lg hover:bg-[#F7F9F9]">Kembali</button>
                    </div>
                </div>
            `
        }
    </script>
@endpush
