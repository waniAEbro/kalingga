@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Buat Komponen</h1>

    <x-edit-input-field :items="$componentedit" :action="'components'" :width="'w-full'">
        <div class="flex w-full gap-3">
            <div class="flex-1">
                <x-input :name="'name'" :label="'Nama Komponen'" :placeholder="'kayu'" :type="'text'" :value="old('name') ?? $componentedit->name" />
            </div>
            <div class="flex-none">
                <x-input :name="'unit'" :label="'Unit'" :placeholder="'m'" :value="old('unit') ?? $componentedit->unit" />
            </div>
        </div>
        <div class="flex w-full gap-3 my-3">
            <div class="flex-1">
                <x-input-with-desc :desc="'Rp'" :name="'price_per_unit'" :type="'number'" :label="'Harga Per Unit'"
                    :placeholder="'1000'" :value="old('price_per_unit') ?? $componentedit->price_per_unit" />
            </div>
        </div>

        <table class="w-full mt-5 text-left table-fixed">
            <thead>
                <tr class="border-y-2">
                    <th class="w-20 p-2 text-center">#</th>
                    <th class="p-2 w-96">Pemasok</th>
                    <th class="p-2">Harga</th>
                    <th class="w-20 p-2"></th>
                </tr>
            </thead>
            <tbody id="table-body">
                @if (old('supplier_id', []))
                    @foreach (old('supplier_id', []) as $index => $supplier)
                        <tr x-data="{ supplier: $el }" class="border-b">
                            <td id="number" class="p-2 text-center"></td>
                            <td class="p-2">
                                <x-select :dataLists="$suppliers->toArray()" :name="'supplier_id[]'" :id="'supplier_id'"
                                    :value="$supplier" :new="'newSupplierModal(supplier)'" />
                                @error('supplier_id.' . $index)
                                    <div class="mt-1 text-xs text-red-400">{{ $message }}</div>
                                @enderror
                            </td>

                            <td class="p-2">
                                <x-input-with-desc :desc="'Rp'" :name="'price_supplier[]'" :type="'number'"
                                    :placeholder="'1000'" :value="old('price_supplier', [])[$index]" />
                                @error('price_supplier.' . $index)
                                    <div class="mt-1 text-xs text-red-400">{{ $message }}</div>
                                @enderror
                            </td>

                            <td id="aksi" class="p-2">
                                <button type="button" x-on:click="supplier.remove(); set_number(); deleteBtnToggle()"
                                    class="transition-all duration-300 rounded-full delete-btn hover:bg-slate-100 active:bg-slate-200"><span
                                        class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                            </td>
                        </tr>
                    @endforeach
                @else
                @foreach ($componentedit->suppliers as $supplier)
                    <tr x-data="{ supplier: $el }" class="border-b">
                        <td id="number" class="p-2 text-center"></td>
                        <td class="p-2">
                            <x-select :value="$supplier->id" :label="$supplier->name" :dataLists="$suppliers->toArray()" :name="'supplier_id[]'" :id="'supplier_id'"
                                :new="'newSupplierModal(supplier)'" />
                        </td>
                        <td class="p-2">
                            <x-input-with-desc :value="$supplier->pivot->price_per_unit" :desc="'Rp'" :name="'price_supplier[]'" :type="'number'"
                                :placeholder="'1000'" />
                        </td>
                        <td id="aksi" class="p-2">
                            <button type="button" x-on:click="supplier.remove(); set_number(); deleteBtnToggle()"
                                class="transition-all duration-300 rounded-full delete-btn hover:bg-slate-100 active:bg-slate-200"><span
                                    class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <button type="button" x-data
            x-on:click="addNewSupplier(); set_number(); deleteBtnToggle(); await $nextTick(); setNewSuppliers()"
            class="flex justify-center w-full py-2 text-sm transition duration-300 border-b border-dashed border-x hover:bg-slate-50 active:bg-sky-100">Add
            New</button>
    </x-edit-input-field>
@endsection

@push('script')
    <script>
        let suppliers = {!! $suppliers !!}
        let suppliersSelected = {}

        suppliers.forEach(s => {
            suppliersSelected[s.id] = s.name
        })

        set_number();
        deleteBtnToggle();

        function newSupplierModal(supplierRow) {
            const modal = document.querySelector('#modal');
            document.querySelector('#modal-background').classList.remove('hidden');

            modal.classList.remove('opacity-0', '-z-40');
            modal.classList.add('opacity-100', 'z-40');

            modal.innerHTML = `<div class="w-[600px] bg-white h-fit rounded-xl pb-20 relative">
                <div
                    class="py-[20px] px-[30px] w-full relative border-b-2 border-gray-200 flex justify-between items-center">
                    <div class="text-xl font-bold">Tambah Pemasok Baru</div>
                    <div onclick="hideModal()"
                        class="absolute flex items-center p-1 text-2xl rounded-full cursor-pointer right-5 hover:bg-slate-100">
                        <ion-icon name="close-outline"></ion-icon>
                    </div>
                </div>

                <div class="px-[30px] pt-[20px]">
                    <div class="flex w-full gap-3">
                        <div class="flex-1">
                            <x-input :label="'Nama Pemasok'" :placeholder="'name'" :type="'text'"
                                :inputParentClass="'mb-3'" :name="'supplier_name_modal'" />
                        </div>
                        <div class="flex-1">
                            <x-input :label="'Email'" :placeholder="'email'" :type="'email'"
                                :inputParentClass="'mb-3'" :name="'supplier_email_modal'" />
                        </div>
                    </div>
                    <div class="flex w-full gap-3 my-3">
                        <div class="flex-1">
                            <x-input :label="'Kode Pemasok'" :placeholder="'code'" :type="'text'"
                                :inputParentClass="'mb-3'" :name="'supplier_code_modal'" />
                        </div>
                        <div class="flex-1">
                            <x-input :label="'No Hp'" :placeholder="'phone'" :type="'number'"
                                :inputParentClass="'mb-3'" :name="'supplier_phone_modal'" />
                        </div>
                    </div>
                    <div class="flex w-full gap-3 my-3">
                        <div class="flex-1">
                            <x-input-textarea :name="'supplier_address_modal'" :label="'Alamat'" :placeholder="'address'"
                                 />
                        </div>
                    </div>
                </div>

                <div class="absolute flex gap-2 bottom-4 right-[30px]">
                    <button type="button" onclick="hideModal()"
                        class="py-2 px-5 border text-[#768498] text-sm rounded-lg hover:bg-[#F7F9F9]">Batalkan</button>
                        <button id="create-supplier" onmouseover="toggleSupplierSaveButtonState()" type="button"
                        class="py-2 px-5 border text-[#F7F9F9] text-sm rounded-lg save flex items-center justify-center gap-3">Simpan <span class="hidden loading loading-spinner loading-sm"></span></button>
                </div>
            </div>`
            console.log('pas buat modal', supplierRow)
            document.getElementById('create-supplier').addEventListener('click', () => {
                console.log('pas klik save', supplierRow)
                createSupplier(supplierRow)
            })
        }

        function addNewSupplier() {
            const tableBody = document.getElementById('table-body');
            const tableRow = document.createElement('tr');
            tableRow.setAttribute('x-data', '{ supplier: $el }')
            tableRow.className = 'border-b';
            tableRow.innerHTML = `
                                        <td id="number" class="p-2 text-center"></td>
                                        <td class="p-2">
                                            <x-select x-init="await $nextTick(); setNewSuppliers()" :dataLists="$suppliers->toArray()" :name="'supplier_id[]'" :id="'supplier_id'" :new="'newSupplierModal(supplier)'" />
                                        </td>
                                        <td class="p-2">
                                            <x-input-with-desc :desc="'Rp'" :name="'price_supplier[]'" :type="'number'" :placeholder="'1000'" />
                                        </td>
                                        <td id="aksi" class="p-2">
                                            <button type="button" x-on:click="supplier.remove(); set_number(); deleteBtnToggle()"
                                                class="transition-all duration-300 rounded-full delete-btn hover:bg-slate-100 active:bg-slate-200"><span
                                                    class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                                        </td>
                                    `;

            tableBody.appendChild(tableRow);
        }

        function set_number() {
            const numbers = document.querySelectorAll('#number');
            numbers.forEach((number, i) => number.innerText = i + 1)
        }

        function deleteBtnToggle() {
            const deleteBtn = document.querySelectorAll('.delete-btn')
            const aksi = document.querySelectorAll('#aksi')
            if (aksi.length == 1) {
                deleteBtn[0].classList.add('hidden')
            } else {
                deleteBtn.forEach(btn => btn.classList.remove('hidden'))
            }
        }



        function setNewSuppliers() {
            document.querySelectorAll(".supplier_id").forEach(e => {
                e._x_dataStack[0].list = suppliersSelected
            })
        }

        async function createSupplier(supplierRow) {
            const name = document.getElementById('supplier_name_modal').value
            const email = document.getElementById('supplier_email_modal').value
            const phone = document.getElementById('supplier_phone_modal').value
            const code = document.getElementById('supplier_code_modal').value
            const address = document.getElementById('supplier_address_modal').value

            const loading = document.querySelector('.loading');
            loading.classList.remove('hidden')

            try {
                const response = await fetch("/api/suppliers", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({
                        name,
                        email,
                        phone,
                        code,
                        address
                    })
                })

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                suppliers = await response.json(); // Mengambil data JSON dari respons
                console.log('dalam create supplier', supplierRow)
                const supplierId = supplierRow.querySelector('#supplier_id')
                const supplierClass = supplierRow.querySelector('.supplier_id')
                suppliersSelected = {}

                suppliers.forEach(e => {
                    suppliersSelected[e.id] = e.name
                })

                setNewSuppliers()

                supplierClass._x_dataStack[0].selectedkey = suppliers[suppliers.length - 1].id
                supplierClass._x_dataStack[0].selectedlabel = suppliers[suppliers.length - 1].name
                supplierId.value = suppliers[suppliers.length - 1].name

                toastr.success(`${name} berhasil ditambahkan ke Supplier`)
                loading.classList.add('hidden')
                hideModal()
            } catch (error) {
                console.error('Terjadi kesalahan', error)
            }

        }

        function toggleSupplierSaveButtonState() {
            const name = document.getElementById('supplier_name_modal').value
            const email = document.getElementById('supplier_email_modal').value
            const code = document.getElementById('supplier_code_modal').value
            const phone = document.getElementById('supplier_phone_modal').value
            const address = document.getElementById('supplier_address_modal').value
            const saveButton = document.getElementById('create-supplier')

            if (name && email && code && phone && address) {
                saveButton.disabled = false
                saveButton.style.cursor = 'pointer'
            } else {
                saveButton.disabled = true
                saveButton.style.cursor = "not-allowed"
            }
        }
    </script>
@endpush
