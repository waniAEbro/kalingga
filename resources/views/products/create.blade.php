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
                                class="w-16 px-2 py-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300">
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
                    <x-input-with-desc :desc="'NW'" :name="'nw'" :type="'number'" />
                    <x-input-with-desc :desc="'GW'" :name="'gw'" :type="'number'" />
                </div>
            </div>
        </div>

        <div class="divider"></div>

        <div class="w-full">
            <h1 class="mb-3 text-xl font-bold">Biaya</h1>

            {{-- <h1 class="my-3 font-bold text-center">Biaya Produksi</h1>
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b-2">
                        <th class="p-2 text-sm">Harga Perakitan</th>
                        <th class="p-2 text-sm">Harga Perakitan PRJ</th>
                        <th class="p-2 text-sm">Harga Grendo</th>
                        <th class="p-2 text-sm">Harga Obat</th>
                        <th class="p-2 text-sm">Upah</th>
                        <th class="p-2 text-sm">Total</th>
                    </tr>
                </thead>
                <tbody id="productBody">
                    <tr class="border-b">
                        <td class="p-2"><x-input-with-desc :desc="'Rp'" :name="''" :type="'number'" />
                        </td>
                        <td class="p-2"><x-input-with-desc :desc="'Rp'" :name="''" :type="'number'" />
                        </td>
                        <td class="p-2"><x-input-with-desc :desc="'Rp'" :name="''" :type="'number'" />
                        </td>
                        <td class="p-2"><x-input-with-desc :desc="'Rp'" :name="''" :type="'number'" />
                        </td>
                        <td class="p-2"><x-input-with-desc :desc="'Rp'" :name="''" :type="'number'" />
                        </td>
                        <td class="p-2"><x-input-with-desc :desc="'Rp'" :name="'production_cost'" :type="'number'"
                                readonly />
                        </td>
                    </tr>
                </tbody>
            </table>

            <h1 class="my-3 font-bold text-center">Biaya Packing</h1>

            <div class="overflow-x-auto w-[980px]">

                <table class="text-left w-[1200px]">
                    <thead>
                        <tr class="border-b-2">
                            <th class="p-2 text-sm w-80">Harga Box 2023</th>
                            <th class="p-2 text-sm w-80">Box Hardware</th>
                            <th class="p-2 text-sm w-80">Assembling</th>
                            <th class="p-2 text-sm w-80">Stiker</th>
                            <th class="p-2 text-sm w-80">Hagtag</th>
                            <th class="p-2 text-sm w-80">Maintenance</th>
                            <th class="p-2 text-sm w-80">Total</th>
                        </tr>
                    </thead>
                    <tbody id="productBody">
                        <tr class="border-b">
                            <td class="p-2 w-80"><x-input-with-desc inputmode="numeric" :desc="'Rp'"
                                    :name="''" :type="'number'" />
                            </td>
                            <td class="p-2 w-80"><x-input-with-desc inputmode="numeric" :desc="'Rp'"
                                    :name="''" :type="'number'" />
                            </td>
                            <td class="p-2 w-80"><x-input-with-desc inputmode="numeric" :desc="'Rp'"
                                    :name="''" :type="'number'" />
                            </td>
                            <td class="p-2 w-80"><x-input-with-desc inputmode="numeric" :desc="'Rp'"
                                    :name="''" :type="'number'" />
                            </td>
                            <td class="p-2 w-80"><x-input-with-desc inputmode="numeric" :desc="'Rp'"
                                    :name="''" :type="'number'" />
                            </td>
                            <td class="p-2 w-80"><x-input-with-desc inputmode="numeric" :desc="'Rp'"
                                    :name="''" :type="'number'" />
                            </td>
                            <td class="p-2"><x-input-with-desc inputmode="numeric" :desc="'Rp'"
                                    :name="'production_cost'" :type="'number'" readonly />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h1 class="my-3 font-bold text-center">Biaya Lain-Lain</h1>

            <table class="w-full text-left">
                <thead>
                    <tr class="border-b-2">
                        <th class="p-2 text-sm">Overhead Pabrik</th>
                        <th class="p-2 text-sm">Listrik</th>
                        <th class="p-2 text-sm">Pajak</th>
                        <th class="p-2 text-sm">Export+Usaha</th>
                        <th class="p-2 text-sm">Total</th>
                    </tr>
                </thead>
                <tbody id="productBody">
                    <tr class="border-b">
                        <td class="p-2"><x-input-with-desc :desc="'Rp'" :name="''" :type="'number'" />
                        </td>
                        <td class="p-2"><x-input-with-desc :desc="'Rp'" :name="''" :type="'number'" />
                        </td>
                        <td class="p-2"><x-input-with-desc :desc="'Rp'" :name="''" :type="'number'" />
                        </td>
                        <td class="p-2"><x-input-with-desc :desc="'Rp'" :name="''"
                                :type="'number'" />
                        </td>
                        <td class="p-2"><x-input-with-desc :desc="'Rp'" :name="'production_cost'" :type="'number'"
                                readonly />
                        </td>
                    </tr>
                </tbody>
            </table> --}}

            <div class="flex w-full gap-2">
                <div class="flex-1 px-2">
                    <h1 class="my-3 font-bold text-center">Biaya Produksi</h1>

                    <x-input :label="'Harga Perakitan'" :desc="'Rp'" :name="''" :type="'number'" class="mb-3" />
                    <x-input :label="'Harga Perakitan PRJ'" :desc="'Rp'" :name="''" :type="'number'" class="mb-3" />
                    <x-input :label="'Harga Grendo'" :desc="'Rp'" :name="''" :type="'number'" class="mb-3" />
                    <x-input :label="'Harga Obat'" :desc="'Rp'" :name="''" :type="'number'" class="mb-3" />
                    <x-input :label="'Upah'" :desc="'Rp'" :name="''" :type="'number'" class="mb-2" />
                </div>

                <div class="flex-1 px-4 border-gray-200 border-x-2">
                    <h1 class="my-3 font-bold text-center">Biaya Packing</h1>

                    <x-input :label="'Harga Box'" :desc="'Rp'" :name="''" :type="'number'" class="mb-3" />
                    <x-input :label="'Box Hardware'" :desc="'Rp'" :name="''" :type="'number'" class="mb-3" />
                    <x-input :label="'Assembling'" :desc="'Rp'" :name="''" :type="'number'" class="mb-3" />
                    <x-input :label="'Stiker'" :desc="'Rp'" :name="''" :type="'number'" class="mb-3" />
                    <x-input :label="'Hagtag'" :desc="'Rp'" :name="''" :type="'number'" class="mb-3" />
                    <x-input :label="'Maintenance'" :desc="'Rp'" :name="''" :type="'number'" class="mb-3" />
                </div>

                <div class="flex-1 px-2">
                    <h1 class="my-3 font-bold text-center">Biaya Lain-Lain</h1>

                    <x-input :label="'Overhead Pabrik'" :desc="'Rp'" :name="''" :type="'number'" class="mb-3" />
                    <x-input :label="'Listrik'" :desc="'Rp'" :name="''" :type="'number'"
                        class="mb-3" />
                    <x-input :label="'Pajak'" :desc="'Rp'" :name="''" :type="'number'"
                        class="mb-3" />
                    <x-input :label="'Export+Usaha'" :desc="'Rp'" :name="''" :type="'number'"
                        class="mb-3" />
                </div>

            </div>

            <div class="divider"></div>

            <div class="flex w-full gap-2">
                <div class="flex-1 px-2">
                    <x-input :label="'Total Produksi'" :desc="'Rp'" :name="''" :type="'number'"
                        class="" />
                </div>
                <div class="flex-1 px-4">
                    <x-input :label="'Total Packing'" :desc="'Rp'" :name="''" :type="'number'"
                        class="" />
                </div>
                <div class="flex-1 px-2">
                    <x-input :label="'Total Lain-Lain'" :desc="'Rp'" :name="''" :type="'number'"
                        class="" />
                </div>
            </div>

            <div class="divider"></div>

            <div class="flex justify-end gap-3 mt-5">
                <div class="w-52">
                    <x-input-with-desc :desc="'Rp'" :label="'Harga Jual'" :name="'sell_price'" :type="'number'" />
                </div>
            </div>
    </x-create-input-field>
@endsection
@push('script')
    <script>
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

            let production_cost = parseInt(document.querySelector('#production_cost').value);
            let other_cost = parseInt(document.querySelector('#other_cost').value);
            let pack_cost = parseInt(document.querySelector('#pack_cost').value);

            total += production_cost + other_cost + pack_cost

            document.querySelector('#total_bill').value = total;
        }
    </script>
@endpush
