@extends('layouts.layout')

@section('content')
    <x-data-list>
        <div class="h-[550px] relative">

            <table class="w-full mt-5 border-separate table-fixed border-spacing-y-3">
            </table>
            <div id="pagination-wrapper" class="absolute bottom-0 flex h-10 gap-2 my-5 text-sm"></div>
        </div>
    </x-data-list>
@endsection

@push('script')
    <script>
        state.columnName = ["Nomor", "Nama Customer", "Email", "Nomor Telepon", "Kode", "Aksi"]
        state.columnQuery = ["name", "email", "phone", "code"]
        state.menu = "customers"

        document.querySelector(".table-fixed").appendChild(buildHeader())

        const customers = {!! $customers !!}

        state.data = customers
        state.allData = customers

        paginate()
        pageNumber()
        buildTable()

        function show(id) {
            const customer = customers.find(data => data.id === id);

            const modal = document.querySelector('#modal');
            document.querySelector('#modal-background').classList.remove('hidden');

            modal.classList.remove('opacity-0', '-z-20');
            modal.classList.add('opacity-100', 'z-20');

            modal.innerHTML = `
                <div class="w-[400px] px-[18px] py-[24px] text-gray-700">
                    <div class="relative flex justify-between">
                        <div class="text-lg font-bold">Detail Pelanggan</div>
                        <div onclick="hideModal()" class="absolute top-0 right-0 flex items-center justify-center p-1 transition-all rounded-full cursor-pointer hover:bg-slate-200 bg-slate-100">
                            <ion-icon size="small" name="close-outline"></ion-icon>    
                        </div>
                    </div>
        
                    <div class="divider"></div>
        
                    <div>
                        <div class="grid grid-cols-[0.7fr_1.3fr] mb-1">
                            <div class="font-bold ">Nama</div>
                            <div class="">: ${customer.name}</div>
                        </div>
                        <div class="grid grid-cols-[0.7fr_1.3fr] mb-1">
                            <div class="font-bold ">Email</div>
                            <div class="">: ${customer.email}</div>
                        </div>
                        <div class="grid grid-cols-[0.7fr_1.3fr] mb-1">
                            <div class="font-bold ">No Hp</div>
                            <div class="">: ${customer.phone}</div>
                        </div>
                        <div class="grid grid-cols-[0.7fr_1.3fr] mb-1">
                            <div class="font-bold ">Kode Pelanggan</div>
                            <div class="">: ${customer.code}</div>
                        </div>
                        <div class="grid grid-cols-[0.7fr_1.3fr]">
                            <div class="font-bold ">Alamat</div>
                            <div class="">: ${customer.address}</div>
                        </div>
                    </div>
                </div>
            `
        }
    </script>
@endpush
