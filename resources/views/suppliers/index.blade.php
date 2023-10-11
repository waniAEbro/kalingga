@extends('layouts.layout')

@section('content')
    {{-- @dd($suppliers) --}}
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
        state.menu = "suppliers"

        document.querySelector(".table-fixed").appendChild(buildHeader())

        const suppliers = {!! $suppliers !!}

        state.data = suppliers
        state.allData = suppliers

        paginate()
        pageNumber()
        buildTable()

        function show(id) {
            const supplier = suppliers.find(data => data.id === id);

            const modal = document.querySelector('#modal');
            document.querySelector('#modal-background').classList.remove('hidden');

            modal.classList.remove('opacity-0', '-z-20');
            modal.classList.add('opacity-100', 'z-20');

            modal.innerHTML = `
                <div class="w-[400px] px-[18px] py-[24px] text-gray-700">
                    <div class="flex justify-between relative">
                        <div class="text-lg font-bold">Component Details</div>
                        <div onclick="hideModal()" class="absolute top-0 right-0 p-1 transition-all cursor-pointer hover:bg-slate-200 bg-slate-100 rounded-full flex justify-center items-center">
                            <ion-icon size="small" name="close-outline"></ion-icon>    
                        </div>
                    </div>
        
                    <div class="divider"></div>
        
                    <div>
                        <div class="grid grid-cols-[0.7fr_1.3fr] mb-3">
                            <div class="mb-3 font-bold">Nama</div>
                            <div class="mb-3">: ${supplier.name}</div>
                        </div>
                        <div class="grid grid-cols-[0.7fr_1.3fr] mb-3">
                            <div class="mb-3 font-bold">Email</div>
                            <div class="mb-3">: ${supplier.email}</div>
                        </div>
                        <div class="grid grid-cols-[0.7fr_1.3fr] mb-3">
                            <div class="mb-3 font-bold">No Hp</div>
                            <div class="mb-3">: ${supplier.phone}</div>
                        </div>
                        <div class="grid grid-cols-[0.7fr_1.3fr] mb-3">
                            <div class="mb-3 font-bold">Kode Pemasok</div>
                            <div class="mb-3">: ${supplier.code}</div>
                        </div>
                        <div class="grid grid-cols-[0.7fr_1.3fr]">
                            <div class="mb-3 font-bold">Alamat</div>
                            <div class="mb-3">: ${supplier.address}</div>
                        </div>
                    </div>
                </div>
            `
        }
    </script>
@endpush
