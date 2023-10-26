@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Buat Produk</h1>

    <x-create-input-field :action="'products'" :width="'w-full'">
        <div class="w-full">
            <h1 class="mb-3 text-xl font-bold">Komponen</h1>

            <table class="w-full text-sm text-left table-fixed">
                <thead>
                    <tr class="border-b-2">
                        <th class="w-20 p-2 text-center">#</th>
                        <th class="p-2">Komponen</th>
                        <th class="p-2">Jumlah</th>
                        <th class="p-2">Unit</th>
                        <th class="p-2">Harga Per Produk</th>
                        <th class="p-2">Subtotal</th>
                        <th class="w-20 p-2"></th>
                    </tr>
                </thead>
                <tbody id="table-components">
                    @if (old('component_id', []))
                        @foreach (old('component_id', []) as $index => $cp)
                            <tr x-data="{ component: $el }" class="border-b">
                                <td id="number-component" class="p-2 text-center"></td>
                                <td class="w-40 p-2">
                                    <x-select x-on:click="getComponent(component); $nextTick();" :dataLists="$components->toArray()"
                                        :name="'component_id[]'" :id="'component_id'" :value="$cp" />
                                    @error('component_id.' . $index)
                                        <div class="mt-1 text-xs text-red-400">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td class="p-2">
                                    <input step="0.001" x-ref="quantity" type="number" name="quantity[]" min="0"
                                        oninput="set_subtotal(this)" value="{{ old('quantity', [])[$index] }}"
                                        class="w-20 px-2 py-2 transition-all duration-100 border rounded outline-none input_quantity focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300">
                                    @error('quantity.' . $index)
                                        <div class="mt-1 text-xs text-red-400">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td id="unit" class="p-2"></td>
                                <td id="price" class="p-2"></td>
                                <td id="subtotal" class="p-2"></td>
                                <td id="comp" class="p-2">
                                    <button type="button"
                                        x-on:click="component.remove(); await $nextTick; set_total(); set_number_component(); componentDeleteBtnToggle()"
                                        class="transition-all duration-300 rounded-full comp-delete-btn hover:bg-slate-100 active:bg-slate-200"><span
                                            class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr x-data="{ component: $el }" class="border-b">
                            <td id="number-component" class="p-2 text-center"></td>
                            <td class="w-40 p-2">
                                <x-select x-on:click="getComponent(component); $nextTick();" :dataLists="$components->toArray()"
                                    :name="'component_id[]'" :id="'component_id'" />
                            </td>
                            <td class="p-2">
                                <input step="0.001" x-ref="quantity" type="number" name="quantity[]" min="0"
                                    oninput="set_subtotal(this)" value=""
                                    class="w-20 px-2 py-2 transition-all duration-100 border rounded outline-none input_quantity focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300">
                            </td>
                            <td id="unit" class="p-2"></td>
                            <td id="price" class="p-2"></td>
                            <td id="subtotal" class="p-2"></td>
                            <td id="comp" class="p-2">
                                <button type="button"
                                    x-on:click="component.remove(); await $nextTick; set_total(); set_number_component(); componentDeleteBtnToggle()"
                                    class="transition-all duration-300 rounded-full comp-delete-btn hover:bg-slate-100 active:bg-slate-200"><span
                                        class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                            </td>
                        </tr>
                    @endif

                </tbody>
            </table>

            <button type="button" x-data x-on:click="addNewComponent(); set_number_component(); componentDeleteBtnToggle()"
                class="flex justify-center w-full py-2 text-sm transition duration-300 border-b border-dashed border-x hover:bg-slate-50 active:bg-sky-100">Tambah
                Data Baru</button>

            <h1 class="mt-5 mb-3 text-xl font-bold">Pemasok</h1>

            <table class="w-full mt-5 text-sm text-left table-fixed">
                <thead>
                    <tr class="border-b-2">
                        <th class="w-20 p-2 text-center">#</th>
                        <th class="p-2 w-96">Pemasok</th>
                        <th class="p-2">Harga</th>
                        <th class="w-20 p-2"></th>
                    </tr>
                </thead>
                <tbody id="table-suppliers">
                    @if (old('supplier_id', []))
                        @foreach (old('supplier_id', []) as $index => $supplier)
                            <tr x-data="{ supplier: $el }" class="border-b">
                                <td id="number-supplier" class="p-2 text-center"></td>
                                <td class="p-2">
                                    <x-select x-on:click="$nextTick();" :dataLists="$suppliers->toArray()" :name="'supplier_id[]'"
                                        :id="'supplier_id'" :value="$supplier" />
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
                                <td id="suppl" class="p-2">
                                    <button type="button"
                                        x-on:click="supplier.remove(); set_total(); set_number_supplier(); supplierDeleteBtnToggle()"
                                        class="transition-all duration-300 rounded-full supplier-delete-btn hover:bg-slate-100 active:bg-slate-200"><span
                                            class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr x-data="{ supplier: $el }" class="border-b">
                            <td id="number-supplier" class="p-2 text-center"></td>
                            <td class="p-2">
                                <x-select x-on:click="$nextTick();" :dataLists="$suppliers->toArray()" :name="'supplier_id[]'"
                                    :id="'supplier_id'" />
                            </td>
                            <td class="p-2">
                                <x-input-with-desc :desc="'Rp'" :name="'price_supplier[]'" :type="'number'"
                                    :placeholder="'1000'" />
                            </td>
                            <td id="suppl" class="p-2">
                                <button type="button"
                                    x-on:click="supplier.remove(); set_total(); set_number_supplier(); supplierDeleteBtnToggle()"
                                    class="transition-all duration-300 rounded-full supplier-delete-btn hover:bg-slate-100 active:bg-slate-200"><span
                                        class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <button type="button" x-data x-on:click="addNewSupplier(); set_number_supplier(); supplierDeleteBtnToggle()"
                class="flex justify-center w-full py-2 text-sm transition duration-300 border-b border-dashed border-x hover:bg-slate-50 active:bg-sky-100">Add
                New</button>
        </div>

        <div class="divider"></div>

        <div class="flex w-full gap-3 px-">
            <div class="w-full">
                <h1 class="mb-3 text-xl font-bold">Product</h1>

                <div class="flex w-full gap-3">
                    <div class="flex-1">
                        <x-input :label="'Nama Produk'" :name="'name'" :value="old('name')" />
                    </div>
                    <div class="flex-1">
                        <x-input :label="'Logo'" :name="'logo'" :value="old('logo')" />
                    </div>
                </div>

                <h1 class="my-3 font-bold">Kode</h1>
                <div class="flex w-full gap-3">
                    <x-input-with-desc :desc="'RFID'" :name="'rfid'" :value="old('rfid')" />
                    <x-input-with-desc :desc="'Produk'" :name="'code'" :type="'text'" :value="old('code')" />
                    <x-input-with-desc :desc="'Barcode'" :name="'barcode'" :type="'number'" :value="old('barcode')" />
                </div>

                <h1 class="my-3 font-bold">Dimensi</h1>
                <div class="flex w-full gap-3">
                    <x-input-with-desc :desc="'Panjang'" :name="'length'" :type="'number'" :value="old('length')" />
                    <x-input-with-desc :desc="'Tinggi'" :name="'height'" :type="'number'" :value="old('height')" />
                    <x-input-with-desc :desc="'Lebar'" :name="'width'" :type="'number'" :value="old('width')" />
                </div>
            </div>

            <div class="divider divider-horizontal"></div>

            <div class="w-full">
                <h1 class="mb-3 text-xl font-bold">Pack</h1>

                <h1 class="my-3 font-bold">Dimensi Dalam</h1>
                <div class="flex w-full gap-3">
                    <x-input-with-desc :desc="'Panjang'" :name="'pack_inner_length'" :type="'number'" :value="old('pack_inner_length')" />
                    <x-input-with-desc :desc="'Tinggi'" :name="'pack_inner_height'" :type="'number'" :value="old('pack_inner_height')" />
                    <x-input-with-desc :desc="'Lebar'" :name="'pack_inner_width'" :type="'number'" :value="old('pack_inner_width')" />
                </div>

                <h1 class="my-3 font-bold">Dimensi Luar</h1>
                <div class="flex w-full gap-3">
                    <x-input-with-desc :desc="'Panjang'" :name="'pack_outer_length'" :type="'number'" oninput="set_volume()"
                        :value="old('pack_outer_length')" />
                    <x-input-with-desc :desc="'Tinggi'" :name="'pack_outer_height'" :type="'number'" oninput="set_volume()"
                        :value="old('pack_outer_height')" />
                    <x-input-with-desc :desc="'Lebar'" :name="'pack_outer_width'" :type="'number'" oninput="set_volume()"
                        :value="old('pack_outer_width')" />
                </div>
                <div class="w-40 my-3">
                    <x-input :label="'Volume (m³)'" :name="'volume'" :type="'number'" readonly />
                </div>

                <h1 class="my-3 font-bold">Berat</h1>
                <div class="flex w-full gap-3">
                    <x-input-with-desc :desc="'NW'" :name="'pack_nw'" :type="'number'" :value="old('pack_nw')" />
                    <x-input-with-desc :desc="'GW'" :name="'pack_gw'" :type="'number'" :value="old('pack_gw')" />
                </div>
            </div>
        </div>

        <div class="divider"></div>

        <div class="w-full">
            <h1 class="mb-3 text-xl font-bold">Biaya</h1>

            <div class="flex w-full gap-2">
                <div class="flex-1 px-2 biaya_produksi">
                    <h1 class="my-3 font-bold text-center">Biaya Produksi</h1>

                    <x-input oninput="set_total_produksi()" :label="'Harga Perakitan'" :desc="'Rp'" :name="'price_perakitan'"
                        :type="'number'" :inputParentClass="'mb-3'" :value="old('price_perakitan')" />
                    <x-input oninput="set_total_produksi()" :label="'Harga Perakitan PRJ'" :desc="'Rp'" :name="'price_perakitan_prj'"
                        :type="'number'" :inputParentClass="'mb-3'" :value="old('price_perakitan_prj')" />
                    <x-input oninput="set_total_produksi()" :label="'Harga Grendo'" :desc="'Rp'" :name="'price_grendo'"
                        :type="'number'" :inputParentClass="'mb-3'" :value="old('price_grendo')" />
                    <x-input oninput="set_total_produksi()" :label="'Harga Obat'" :desc="'Rp'" :name="'price_obat'"
                        :type="'number'" :inputParentClass="'mb-3'" :value="old('price_obat')" />
                    <x-input oninput="set_total_produksi()" :label="'Upah'" :desc="'Rp'" :name="'upah'"
                        :type="'number'" :value="old('upah')" />
                </div>

                <div class="flex-1 px-4 border-gray-200 biaya_packing border-x-2">
                    <h1 class="my-3 font-bold text-center">Biaya Packing</h1>

                    <x-input oninput="set_total_packing()" :label="'Harga Box'" :desc="'Rp'" :name="'pack_box_price'"
                        :type="'number'" :inputParentClass="'mb-3'" :value="old('pack_box_price')" />
                    <x-input oninput="set_total_packing()" :label="'Box Hardware'" :desc="'Rp'" :name="'pack_box_hardware'"
                        :type="'number'" :inputParentClass="'mb-3'" :value="old('pack_box_hardware')" />
                    <x-input oninput="set_total_packing()" :label="'Assembling'" :desc="'Rp'" :name="'pack_assembling'"
                        :type="'number'" :inputParentClass="'mb-3'" :value="old('pack_assembling')" />
                    <x-input oninput="set_total_packing()" :label="'Stiker'" :desc="'Rp'" :name="'pack_stiker'"
                        :type="'number'" :inputParentClass="'mb-3'" :value="old('pack_sticker')" />
                    <x-input oninput="set_total_packing()" :label="'Hagtag'" :desc="'Rp'" :name="'pack_hagtag'"
                        :type="'number'" :inputParentClass="'mb-3'" :value="old('pack_hagtag')" />
                    <x-input oninput="set_total_packing()" :label="'Maintenance'" :desc="'Rp'" :name="'pack_maintenance'"
                        :type="'number'" :value="old('pack_maintenance')" />
                </div>

                <div class="flex-1 px-2 biaya_lain">
                    <h1 class="my-3 font-bold text-center">Biaya Lain-Lain</h1>

                    <x-input oninput="set_total_lain()" :label="'Overhead Pabrik'" :desc="'Rp'" :name="'biaya_overhead_pabrik'"
                        :type="'number'" :inputParentClass="'mb-3'" :value="old('biaya_overhead_pabrik')" />
                    <x-input oninput="set_total_lain()" :label="'Listrik'" :desc="'Rp'" :name="'biaya_listrik'"
                        :type="'number'" :inputParentClass="'mb-3'" :value="old('biaya_listrik')" />
                    <x-input oninput="set_total_lain()" :label="'Pajak'" :desc="'Rp'" :name="'biaya_pajak'"
                        :type="'number'" :inputParentClass="'mb-3'" :value="old('biaya_pajak')" />
                    <x-input oninput="set_total_lain()" :label="'Export+Usaha'" :desc="'Rp'" :name="'biaya_ekspor'"
                        :type="'number'" :value="old('biaya_ekspor')" />
                </div>

            </div>

            <div class="divider"></div>

            <div class="flex w-full gap-2 biaya_biaya">
                <div class="flex-1 px-2">
                    <x-input readonly :label="'Total Produksi'" :desc="'Rp'" :name="'total_production'" :type="'number'"
                        class="" :value="old('total_production')" />
                </div>
                <div class="flex-1 px-4">
                    <x-input readonly :label="'Total Packing'" :desc="'Rp'" :name="'pack_cost'" :type="'number'"
                        class="" :value="old('pack_cost')" />
                </div>
                <div class="flex-1 px-2">
                    <x-input readonly :label="'Total Lain-Lain'" :desc="'Rp'" :name="'total_other_cost'" :type="'number'"
                        class="" :value="old('total_other_cost')" />
                </div>
            </div>

            <div class="divider"></div>

            <div class="flex justify-end gap-3 mt-5">
                <div class="w-52">
                    <x-input-with-desc :desc="'Rp'" :label="'HPP'" :name="'hpp'" :type="'number'" />
                </div>

                <div class="w-52">
                    <x-input-with-desc :desc="'Rp'" :label="'Harga Jual'" :name="'sell_price'" :type="'number'"
                        :value="old('sell_price')" />
                </div>
            </div>
    </x-create-input-field>
@endsection
@push('script')
    <script>
        componentDeleteBtnToggle();
        supplierDeleteBtnToggle();

        function addNewSupplier() {
            const tableBody = document.getElementById('table-suppliers');
            const tableRow = document.createElement('tr');
            tableRow.setAttribute('x-data', '{ supplier: $el }')
            tableRow.className = 'border-b';
            tableRow.innerHTML = `
                                        <td id="number-supplier" class="p-2 text-center"></td>
                                        <td class="p-2">
                                            <x-select x-on:click="$nextTick();" :dataLists="$suppliers->toArray()" :name="'supplier_id[]'" :id="'supplier_id'" />
                                        </td>
                                        <td class="p-2">
                                            <x-input-with-desc :desc="'Rp'" :name="'price_supplier[]'" :type="'number'" :placeholder="'1000'" />
                                        </td>
                                        <td id="suppl" class="p-2">
                                            <button type="button" x-on:click="supplier.remove(); set_total(); set_number_supplier(); supplierDeleteBtnToggle()"
                                                class="transition-all supplier-delete-btn duration-300 rounded-full hover:bg-slate-100 active:bg-slate-200"><span
                                                    class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                                        </td>
                                    `;

            tableBody.appendChild(tableRow);
        }

        function set_total_produksi() {
            const el_biaya_produksi = document.querySelectorAll('.biaya_produksi input')
            const biaya_produksi = Array.from(el_biaya_produksi)
                .map(el => parseInt(el.value) || 0)
                .reduce((acc, curr) => acc + curr)
            const total_produksi = document.querySelector('input[name="total_production"]').value = biaya_produksi;

            set_total();
        }

        function set_total_packing() {
            const el_biaya_packing = document.querySelectorAll('.biaya_packing input')
            const biaya_packing = Array.from(el_biaya_packing)
                .map(el => parseInt(el.value) || 0)
                .reduce((acc, curr) => acc + curr)
            const total_packing = document.querySelector('input[name="pack_cost"]').value = biaya_packing;

            set_total();
        }

        function set_total_lain() {
            const el_biaya_lain = document.querySelectorAll('.biaya_lain input')
            const biaya_lain = Array.from(el_biaya_lain)
                .map(el => parseInt(el.value) || 0)
                .reduce((acc, curr) => acc + curr)
            const total_packing = document.querySelector('input[name="total_other_cost"]').value = biaya_lain;

            set_total();
        }



        function set_volume() {
            const packOuterLength = document.getElementById('pack_outer_length').value;
            const packOuterWidth = document.getElementById('pack_outer_width').value;
            const packOuterHeight = document.getElementById('pack_outer_height').value;
            const volume = document.getElementById('volume').value = packOuterHeight * packOuterLength * packOuterWidth;

        }


        function getComponent(tr) {
            let components = {!! $components !!};
            const componentId = tr.querySelector('#component_id');

            if (componentId.value) {
                const component = components.find(component => component.id == componentId.value)
                tr.querySelector('#unit').innerText = component.unit;
                tr.querySelector('#price').innerText = toRupiah(component.price_per_unit);
            } else {
                tr.querySelector('#unit').innerText = '';
                tr.querySelector('#price').innerText = '';
                tr.querySelector('#subtotal').innerText = "";
                tr.querySelector('.input_quantity').value = 0;
                set_total()
            }
        }

        function set_number_component() {
            const numbers = document.querySelectorAll('#number-component');
            numbers.forEach((number, i) => number.innerText = i + 1)
        }

        set_number_component();

        function set_number_supplier() {
            const numbers = document.querySelectorAll('#number-supplier');
            numbers.forEach((number, i) => number.innerText = i + 1)
        }

        set_number_supplier();

        function addNewComponent() {
            const tableBody = document.getElementById('table-components');
            const tableRow = document.createElement('tr');
            tableRow.setAttribute('x-data', '{ component: $el }')
            tableRow.className = 'border-b';
            tableRow.innerHTML = `
                                        <td id="number-component" class="p-2 text-center"></td>
                                        <td class="w-40 p-2">
                                            <x-select x-on:click="getComponent(component); await $nextTick(); set_subtotal($refs.quantity)" :dataLists="$components->toArray()"
                                                :name="'component_id[]'" :id="'component_id'" />
                                        </td>
                                        <td class="p-2">
                                            <input step="0.001" x-ref="quantity" type="number" name="quantity[]"
                                                oninput="set_subtotal(this)" value=""
                                                class="w-20 px-2 py-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300">
                                        </td>
                                        <td id="unit" class="p-2"></td>
                                        <td id="price" class="p-2"></td>
                                        <td id="subtotal" class="p-2"></td>
                                        <td id="comp" class="p-2">
                                            <button type="button" x-on:click="component.remove(); set_total(); set_number_component(); componentDeleteBtnToggle()"
                                                class="transition-all comp-delete-btn duration-300 rounded-full hover:bg-slate-100 active:bg-slate-200"><span
                                                    class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                                        </td>
                                    `;

            tableBody.appendChild(tableRow);
        }

        function set_subtotal(element) {
            let tr = element.parentElement.parentElement;
            let price = tr.querySelector('#price').textContent.replace(/[^0-9\.,]/g, '').replace(/\./g,
                '').replace(',', '.');
            let subtotal = tr.querySelector('#subtotal');
            subtotal.textContent = toRupiah(0)
            if (price != "" && parseFloat(element.value) >= 0) {
                subtotal.textContent = toRupiah(parseInt(price) * parseFloat(element.value));
            } else {
                subtotal.textContent = toRupiah(0);
            }

            set_total();
        }

        function set_total() {
            let subtotals = document.querySelectorAll('#subtotal');
            let total = 0;
            subtotals.forEach(subtotalElement => {
                let subtotalValue = parseFloat(subtotalElement.textContent.replace(/[^0-9\.,]/g, '').replace(/\./g,
                    '').replace(',', '.'));
                console.log(subtotalElement.textContent.replace(/[^0-9\.,]/g, '').replace(/\./g,
                    '').replace(',', '.'))
                total += isNaN(subtotalValue) ? 0 : subtotalValue;
            })

            let production_cost = parseInt(document.querySelector('#total_production').value) || 0;
            let other_cost = parseInt(document.querySelector('#total_other_cost').value) || 0;
            let pack_cost = parseInt(document.querySelector('#pack_cost').value) || 0;

            total += production_cost + other_cost + pack_cost

            document.querySelector('#hpp').value = total;
        }

        function componentDeleteBtnToggle() {
            const deleteBtn = document.querySelectorAll('.comp-delete-btn')
            if (deleteBtn.length == 1) {
                deleteBtn[0].style.display = "none"
            } else {
                deleteBtn.forEach(btn => btn.style.display = 'block')
            }
        }

        function supplierDeleteBtnToggle() {
            const deleteBtn = document.querySelectorAll('.supplier-delete-btn')
            if (deleteBtn.length == 1) {
                deleteBtn[0].style.display = "none"
            } else {
                deleteBtn.forEach(btn => btn.style.display = 'block')
            }
        }
    </script>
@endpush
