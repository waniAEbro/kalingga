@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Buat Produk</h1>

    <x-create-input-field :action="'products'" :width="'w-full'">
        <div class="w-full">
            <h1 class="mb-3 text-xl font-bold">Komponen</h1>

            <table class="w-full text-left">
                <thead>
                    <tr class="border-b-2">
                        <th class="p-2 text-sm">#</th>
                        <th class="p-2 text-sm">Komponen</th>
                        <th class="p-2 text-sm">Jumlah</th>
                        <th class="p-2 text-sm">Unit</th>
                        <th class="p-2 text-sm">Harga Per Produk</th>
                        <th class="p-2 text-sm">Total</th>
                        <th class="p-2 text-sm"></th>
                    </tr>
                </thead>
                <tbody id="productBody">
                    <tr x-data="{ productEl: $el }" class="border-b">
                        <td id="number" class="p-2"></td>
                        <td class="w-40 p-2">
                            <x-ngetes x-on:click="getComponent(productEl); $nextTick(); set_subtotal($refs.quantity)"
                                :dataLists="$components->toArray()" :name="'component_id[]'" :id="'component_id'" />
                        </td>
                        <td class="p-2"><input step="0.001" x-ref="quantity" type="number" name="quantity[]"
                                onchange="set_subtotal(this)" value="0"
                                class="w-20 px-2 py-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300">
                        </td>
                        <td id="unit" class="p-2"></td>
                        <td id="price" class="p-2"></td>
                        <td id="subtotal" class="p-2"></td>
                        <td class="p-2">
                            <button type="button"
                                x-on:click="productEl.remove(); await $nextTick; set_total(); set_number()"
                                class="transition-all duration-300 rounded-full hover:bg-slate-100 active:bg-slate-200"><span
                                    class="p-2 text-r0 material-symbols-outlined">delete</span></button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <button type="button" x-data x-on:click="addNew(); set_number()"
                class="flex justify-center w-full py-2 text-sm transition duration-300 border-b border-dashed border-x hover:bg-slate-50 active:bg-sky-100">Tambah
                Data Baru</button>
        </div>

        <div class="divider"></div>

        <div class="flex w-full gap-3 px-">
            <div class="w-full">
                <h1 class="mb-3 text-xl font-bold">Product</h1>

                <div class="flex w-full gap-3">
                    <div class="flex-1">
                        <x-input :label="'Nama Produk'" :name="'name'" />
                    </div>
                    <div class="flex-1">
                        <x-input :label="'Logo'" :name="'logo'" />
                    </div>
                </div>

                <h1 class="my-3 font-bold">Kode</h1>
                <div class="flex w-full gap-3">
                    <x-input-with-desc :desc="'RFID'" :name="'rfid'" :type="'number'" />
                    <x-input-with-desc :desc="'Produk'" :name="'code'" :type="'text'" />
                    <x-input-with-desc :desc="'Barcode'" :name="'barcode'" :type="'number'" />
                </div>

                <h1 class="my-3 font-bold">Dimensi</h1>
                <div class="flex w-full gap-3">
                    <x-input-with-desc :desc="'Panjang'" :name="'length'" :type="'number'" />
                    <x-input-with-desc :desc="'Tinggi'" :name="'height'" :type="'number'" />
                    <x-input-with-desc :desc="'Lebar'" :name="'width'" :type="'number'" />
                </div>
            </div>

            <div class="divider divider-horizontal"></div>

            <div class="w-full">
                <h1 class="mb-3 text-xl font-bold">Pack</h1>

                <h1 class="my-3 font-bold">Dimensi Dalam</h1>
                <div class="flex w-full gap-3">
                    <x-input-with-desc :desc="'Panjang'" :name="'pack_inner_length'" :type="'number'" />
                    <x-input-with-desc :desc="'Tinggi'" :name="'pack_inner_height'" :type="'number'" />
                    <x-input-with-desc :desc="'Lebar'" :name="'pack_inner_width'" :type="'number'" />
                </div>

                <h1 class="my-3 font-bold">Dimensi Luar</h1>
                <div class="flex w-full gap-3">
                    <x-input-with-desc :desc="'Panjang'" :name="'pack_outer_length'" :type="'number'" oninput="set_volume()" />
                    <x-input-with-desc :desc="'Tinggi'" :name="'pack_outer_height'" :type="'number'" oninput="set_volume()" />
                    <x-input-with-desc :desc="'Lebar'" :name="'pack_outer_width'" :type="'number'" oninput="set_volume()" />
                </div>
                <div class="w-40 my-3">
                    <x-input :label="'Volume (m³)'" :name="'volume'" :type="'number'" readonly />
                </div>

                <h1 class="my-3 font-bold">Berat</h1>
                <div class="flex w-full gap-3">
                    <x-input-with-desc :desc="'NW'" :name="'pack_nw'" :type="'number'" />
                    <x-input-with-desc :desc="'GW'" :name="'pack_gw'" :type="'number'" />
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
                        :type="'number'" class="mb-3" />
                    <x-input oninput="set_total_produksi()" :label="'Harga Perakitan PRJ'" :desc="'Rp'" :name="'price_perakitan_prj'"
                        :type="'number'" class="mb-3" />
                    <x-input oninput="set_total_produksi()" :label="'Harga Grendo'" :desc="'Rp'" :name="'price_grendo'"
                        :type="'number'" class="mb-3" />
                    <x-input oninput="set_total_produksi()" :label="'Harga Obat'" :desc="'Rp'" :name="'price_obat'"
                        :type="'number'" class="mb-3" />
                    <x-input oninput="set_total_produksi()" :label="'Upah'" :desc="'Rp'" :name="'upah'"
                        :type="'number'" class="mb-2" />
                </div>

                <div class="flex-1 px-4 border-gray-200 biaya_packing border-x-2">
                    <h1 class="my-3 font-bold text-center">Biaya Packing</h1>

                    <x-input oninput="set_total_packing()" :label="'Harga Box'" :desc="'Rp'" :name="'pack_box_price'"
                        :type="'number'" class="mb-3" />
                    <x-input oninput="set_total_packing()" :label="'Box Hardware'" :desc="'Rp'" :name="'pack_box_hardware'"
                        :type="'number'" class="mb-3" />
                    <x-input oninput="set_total_packing()" :label="'Assembling'" :desc="'Rp'" :name="'pack_assembling'"
                        :type="'number'" class="mb-3" />
                    <x-input oninput="set_total_packing()" :label="'Stiker'" :desc="'Rp'" :name="'pack_stiker'"
                        :type="'number'" class="mb-3" />
                    <x-input oninput="set_total_packing()" :label="'Hagtag'" :desc="'Rp'" :name="'pack_hagtag'"
                        :type="'number'" class="mb-3" />
                    <x-input oninput="set_total_packing()" :label="'Maintenance'" :desc="'Rp'" :name="'pack_maintenance'"
                        :type="'number'" class="mb-3" />
                </div>

                <div class="flex-1 px-2 biaya_lain">
                    <h1 class="my-3 font-bold text-center">Biaya Lain-Lain</h1>

                    <x-input oninput="set_total_lain()" :label="'Overhead Pabrik'" :desc="'Rp'" :name="'biaya_overhead_pabrik'"
                        :type="'number'" class="mb-3" />
                    <x-input oninput="set_total_lain()" :label="'Listrik'" :desc="'Rp'" :name="'biaya_listrik'"
                        :type="'number'" class="mb-3" />
                    <x-input oninput="set_total_lain()" :label="'Pajak'" :desc="'Rp'" :name="'biaya_pajak'"
                        :type="'number'" class="mb-3" />
                    <x-input oninput="set_total_lain()" :label="'Export+Usaha'" :desc="'Rp'" :name="'biaya_ekspor'"
                        :type="'number'" class="mb-3" />
                </div>

            </div>

            <div class="divider"></div>

            <div class="flex w-full gap-2 biaya_biaya">
                <div class="flex-1 px-2">
                    <x-input readonly :label="'Total Produksi'" :desc="'Rp'" :name="'total_production'" :type="'number'"
                        class="" />
                </div>
                <div class="flex-1 px-4">
                    <x-input readonly :label="'Total Packing'" :desc="'Rp'" :name="'pack_cost'" :type="'number'"
                        class="" />
                </div>
                <div class="flex-1 px-2">
                    <x-input readonly :label="'Total Lain-Lain'" :desc="'Rp'" :name="'total_other_cost'" :type="'number'"
                        class="" />
                </div>
            </div>

            <div class="divider"></div>

            <div class="flex justify-end gap-3 mt-5">
                <div class="w-52">
                    <x-input-with-desc :desc="'Rp'" :label="'HPP'" :name="'hpp'" :type="'number'" />
                </div>

                <div class="w-52">
                    <x-input-with-desc :desc="'Rp'" :label="'Harga Jual'" :name="'sell_price'" :type="'number'" />
                </div>
            </div>
    </x-create-input-field>
@endsection
@push('script')
    <script>
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
                const unit = tr.querySelector('#unit').innerText = component.unit;
                const price = tr.querySelector('#price').innerText = component.price_per_unit_buy;
            } else {
                const unit = tr.querySelector('#unit').innerText = '';
                const price = tr.querySelector('#price').innerText = '';
            }
        }

        function set_number() {
            const numbers = document.querySelectorAll('#number');
            numbers.forEach((number, i) => number.innerText = i + 1)
        }

        set_number();

        function addNew() {
            const productBody = document.getElementById('productBody');
            const productRow = document.createElement('tr');
            productRow.setAttribute('x-data', '{ productEl: $el }')
            productRow.className = 'border-b';
            productRow.innerHTML = `
                                        <td id="number" class="p-2"></td>
                                        <td class="w-40 p-2">
                                            <x-ngetes x-on:click="getComponent(productEl); await $nextTick(); set_subtotal($refs.quantity)" :dataLists="$components->toArray()"
                                                :name="'component_id[]'" :id="'component_id'" />
                                        </td>
                                        <td class="p-2"><input step="0.001" x-ref="quantity" type="number" name="quantity[]"
                                                onchange="set_subtotal(this)" value="0"
                                                class="w-16 px-2 py-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300">
                                        </td>
                                        <td id="unit" class="p-2"></td>
                                        <td id="price" class="p-2"></td>
                                        <td id="subtotal" class="p-2"></td>
                                        <td class="p-2">
                                            <button type="button" x-on:click="productEl.remove(); set_total(); set_number()"
                                                class="transition-all duration-300 rounded-full hover:bg-slate-100 active:bg-slate-200"><span
                                                    class="p-2 text-r0 material-symbols-outlined">delete</span></button>
                                        </td>
                                    `;

            productBody.appendChild(productRow);
        }

        function set_subtotal(element) {
            let tr = element.parentElement.parentElement;
            let price = tr.querySelector('#price').textContent;
            let subtotal = tr.querySelector('#subtotal');
            subtotal.textContent = price * element.value;

            set_total();
        }

        function set_total() {
            let subtotals = document.querySelectorAll('#subtotal');
            let total = 0;
            subtotals.forEach(subtotalElement => {
                let subtotalValue = parseFloat(subtotalElement.textContent);
                total += isNaN(subtotalValue) ? 0 : subtotalValue;
            })

            let production_cost = parseInt(document.querySelector('#total_production').value) || 0;
            let other_cost = parseInt(document.querySelector('#total_other_cost').value) || 0;
            let pack_cost = parseInt(document.querySelector('#pack_cost').value) || 0;

            total += production_cost + other_cost + pack_cost

            document.querySelector('#hpp').value = total;
        }
    </script>
@endpush
