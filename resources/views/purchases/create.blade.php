@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Create Purchases</h1>

    <x-create-input-field :action="'purchases'" :width="'w-full'">
        <div class="flex gap-5 text-sm">
            <div>
                <label for="purchase_date" class="block text-sm">Tanggal Pembelian</label>
                <x-input type="date" :name="'purchase_date'" :inputParentClass="'mb-3'" :value="old('purchase_date') ?? Carbon\Carbon::now()->format('Y-m-d')" />

                <label for="due_date" class="block text-sm">Tanggal Jatuh Tempo</label>
                <x-input type="date" :name="'due_date'" :inputParentClass="'mb-3'" :value="old('due_date') ?? Carbon\Carbon::now()->format('Y-m-d')" />

                <label for="supplier_id" class="block text-sm">Pemasok</label>
                <div class="w-40 mt-2 mb-3">
                    <x-select x-on:click="getSupplier; await $nextTick();" :dataLists="$suppliers->toArray()" :name="'supplier_id'"
                        :id="'supplier_id'" :value="old('supplier_id')" />
                        @error('supplier_id')
                        <div class="mt-1 text-xs text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <x-input :name="'supplier_address'" :label="'Alamat Pemasok'" readonly class="mb-3 bg-slate-100" />

                <x-input :name="'supplier_email'" :label="'Email Pemasok'" readonly class="mb-3 bg-slate-100" />

                <x-input :name="'supplier_phone'" :label="'No Hp Pemasok'" readonly class="mb-3 bg-slate-100" />

                <x-input :name="'code'" :type="'text'" :label="'Kode Pembelian'" :inputParentClass="'mb-3'" :value="old('code')" />

                <x-input :name="'method'" :type="'text'" :label="'Metode Pembayaran'" :inputParentClass="'mb-3'" :value="old('method') ?? 0" />

                <x-input :name="'beneficiary_bank'" :type="'text'" :label="'Beneficiary\'s Bank'" :inputParentClass="'mb-3'" :value="old('beneficiary_bank') ?? 0" />

                <x-input :name="'beneficiary_ac_usd'" :type="'text'" :label="'Beneficiary A/C USD'" :inputParentClass="'mb-3'" :value="old('beneficiary_ac_usd') ?? 0" />

                <x-input :name="'bank_address'" :type="'text'" :label="'Bank Address'" :inputParentClass="'mb-3'" :value="old('bank_address') ?? 0" />

                <x-input :name="'swift_code'" :type="'text'" :label="'Swift Code'" :inputParentClass="'mb-3'" :value="old('swift_code') ?? 0" />

                <x-input :name="'beneficiary_name'" :type="'text'" :label="'Beneificiary Name'" :inputParentClass="'mb-3'" :value="old('beneficiary_name') ?? 0" />

                <x-input :name="'beneficiary_address'" :type="'text'" :label="'Beneficiary\'s Address'" :inputParentClass="'mb-3'" :value="old('beneficiary_address') ?? 0" />

                <x-input :name="'phone'" :type="'text'" :label="'Phone'" :inputParentClass="'mb-3'" :value="old('phone') ?? 0" />

                <div class="flex w-full gap-3 my-3">
                    <div class="flex-1">
                        <x-input-textarea :name="'location'" :label="'Lokasi Pengiriman'" :placeholder="'location'" :value="old('location') ?? 0" />
                    </div>
                </div>
            </div>

            <div class="divider divider-horizontal"></div>

            <div class="w-full">
                <h1 class="mb-3 text-xl font-bold">Komponen</h1>

                <table class="w-full text-left table-fixed">
                    <thead>
                        <tr class="border-b-2">
                            <th class="w-10 p-2 text-center">#</th>
                            <th class="p-2">Komponen</th>
                            <th class="w-20 p-2">Jumlah</th>
                            <th class="w-10 p-2">Unit</th>
                            <th class="p-2">Harga</th>
                            <th class="p-2">Subtotal</th>
                            <th class="w-20 p-2"></th>
                        </tr>
                    </thead>
                    <tbody id="table-component">
                        @if (old('component_id', []))
                            @foreach (old('component_id', []) as $index => $component)
                                <tr x-data="{ component: $el }" class="border-b">
                                    <td id="number-component" class="p-2 text-center"></td>
                                        <td class="w-40 p-2">
                                            <x-select x-on:click="getComponent(component); await $nextTick(); set_subtotal($refs.quantity)" x-init="await $nextTick(); setKomponen();" :dataLists="$components->toArray()"
                                                :name="'component_id[]'" :id="'component_id'" :value="$component" />
                                                @error('component_id.' . $index)
                                            <div class="mt-1 text-xs text-red-400">{{ $message }}</div>
                                        @enderror
                                        </td>
                                        <td class="p-2"><input x-ref="quantity" type="number" name="quantity[]"
                                                oninput="set_subtotal(this)" value="0" step="0.0001"
                                                class="w-16 px-2 py-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300">
                                        </td>
                                        <td id="unit" class="p-2"></td>
                                        <td id="price" class="p-2"></td>
                                        <td id="subtotal" class="p-2"></td>
                                        <td class="p-2">
                                            <button type="button" x-on:click="component.remove(); set_total(); set_number_component()"
                                                class="transition-all duration-300 rounded-full hover:bg-slate-100 active:bg-slate-200"><span
                                                    class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                                        </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

                <button type="button" x-data x-on:click="addNewComponent(); set_number_component()"
                    class="flex justify-center w-full py-2 text-sm transition duration-300 border-b border-dashed border-x hover:bg-slate-50 active:bg-sky-100">Add
                    New</button>

                <h1 class="mt-5 mb-3 text-xl font-bold">Produk</h1>

                <table class="w-full text-left table-fixed">
                    <thead>
                        <tr class="border-b-2">
                            <th class="w-10 p-2 text-center">#</th>
                            <th class="p-2">Produk</th>
                            <th class="w-20 p-2">Jumlah</th>
                            <th class="p-2">Harga</th>
                            <th class="p-2">Subtotal</th>
                            <th class="w-20 p-2"></th>
                        </tr>
                    </thead>
                    <tbody id="table-product">
                    </tbody>
                </table>

                <button type="button" x-data x-on:click="addNewProduct(); set_number_product()"
                    class="flex justify-center w-full py-2 text-sm transition duration-300 border-b border-dashed border-x hover:bg-slate-50 active:bg-sky-100">Add
                    New</button>

                <div class="flex justify-end gap-3 mt-10">
                    <div class="w-40">
                        <x-input :label="'Total'" :name="'total_bill'" :placeholder="'Total Bayar'" :type="'number'" readonly />
                    </div>
                    <div class="w-40">
                        <x-input :label="'Bayar'" :name="'paid'" :placeholder="'Bayar'" :type="'number'"
                            :value="old('paid')" oninput="batasBayar(this)" />
                    </div>
                </div>
            </div>
        </div>
    </x-create-input-field>
@endsection
@push('script')
    <script>
        function subTotalProduk(e) {
            const tr = e.parentElement.parentElement;
            const price = tr.querySelector('#price').innerText.replace(/[^0-9\.,]/g, '').replace(/\./g, '').replace(',',
                '.');
            const subtotal = tr.querySelector('#subtotal');
            subtotal.innerText = toRupiah(price * e.value);
            set_total();
        }

        const products = {!! $products !!}
        const components = {!! $components !!};
        let selectedProduct = {}
        let componentsSelected = {}


        function getProduct(tr) {
            const value = tr.querySelector("#product_id").value

            if (value) {
                const product = products.find(product => product.id == value)
                const price = tr.querySelector('#price').innerText = toRupiah(product.suppliers.find(supplier => supplier
                    .id == document.getElementById('supplier_id').value).pivot.price_per_unit);
            } else {
                const price = tr.querySelector('#price').innerText = '';
            }
        }

        function setProduk() {
            document.querySelectorAll(".product_id").forEach(element => {
                element._x_dataStack[0].list = selectedProduct
            })
        }

        function getSupplier() {
            let suppliers = {!! $suppliers !!}
            const supplierId = document.getElementById('supplier_id')
            const supplier = suppliers.find(supplier => supplier.id == supplierId.value)

            if (supplier) {
                const supplierAddress = document.getElementById('supplier_address').value = supplier.address;
                const supplierEmail = document.getElementById('supplier_email').value = supplier.email;
                const supplierPhone = document.getElementById('supplier_phone').value = supplier.phone;

                document.getElementById("table-component").innerHTML = ""
                document.getElementById("table-product").innerHTML = ""
                // document.getElementById("table-products").innerHTML = `<tr onclick="addProduct()">
            //             <td colspan="5" class="p-3 text-center border-t border-b ">Add Product</td>
            //         </tr>`
                componentsSelected = {}
                productsSelected = {}
                components.filter(element => {
                    return element.suppliers.find(element => element.id == supplierId.value)
                }).forEach(element => {
                    componentsSelected[element.id] = element.name
                })
                products.filter(element => {
                    return element.suppliers.find(element => element.id == supplierId.value)
                }).forEach(element => {
                    selectedProduct[element.id] = element.name
                })
            } else {
                const supplierAddress = document.getElementById('supplier_address').value = '';
                const supplierEmail = document.getElementById('supplier_email').value = '';
                const supplierPhone = document.getElementById('supplier_phone').value = '';

                document.getElementById("table-component").innerHTML = ""
                document.getElementById("table-product").innerHTML = ""
                componentsSelected = {}
                selectedProduct = {}
            }
        }

        function getComponent(tr) {

            const componentId = tr.querySelector('#component_id');

            if (componentId.value) {
                const component = components.find(component => component.id == componentId.value)
                const unit = tr.querySelector('#unit').innerText = component.unit;
                const price = tr.querySelector('#price').innerText = toRupiah(component.suppliers.find(supplier =>
                    supplier.id == document.getElementById('supplier_id').value).pivot.price_per_unit);
            } else {
                const unit = tr.querySelector('#unit').innerText = '';
                const price = tr.querySelector('#price').innerText = '';
            }
        }

        function set_number_component() {
            const numbers = document.querySelectorAll('#number-component');
            numbers.forEach((number, i) => number.innerText = i + 1)
        }


        function set_number_product() {
            const numbers = document.querySelectorAll('#number-product');
            numbers.forEach((number, i) => number.innerText = i + 1)
        }

        // set_number_component();
        // set_number_product();

        function addNewComponent() {
            const tableComponent = document.getElementById('table-component');
            const componentRow = document.createElement('tr');
            componentRow.setAttribute('x-data', '{ component: $el }')
            componentRow.className = 'border-b';
            componentRow.innerHTML = `
                                        <td id="number-component" class="p-2 text-center"></td>
                                        <td class="w-40 p-2">
                                            <x-select x-on:click="getComponent(component); await $nextTick(); set_subtotal($refs.quantity)" x-init="await $nextTick(); setKomponen();" :dataLists="$components->toArray()"
                                                :name="'component_id[]'" :id="'component_id'" />
                                        </td>
                                        <td class="p-2"><input x-ref="quantity" type="number" name="quantity[]"
                                                oninput="set_subtotal(this)" value="0" step="0.0001"
                                                class="w-16 px-2 py-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300">
                                        </td>
                                        <td id="unit" class="p-2"></td>
                                        <td id="price" class="p-2"></td>
                                        <td id="subtotal" class="p-2"></td>
                                        <td class="p-2">
                                            <button type="button" x-on:click="component.remove(); set_total(); set_number_component()"
                                                class="transition-all duration-300 rounded-full hover:bg-slate-100 active:bg-slate-200"><span
                                                    class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                                        </td>
                                    `;

            tableComponent.appendChild(componentRow);
        }

        function addNewProduct() {
            const tableProduct = document.getElementById('table-product');
            const productRow = document.createElement('tr');
            productRow.setAttribute('x-data', '{ product: $el }')
            productRow.className = 'border-b';
            productRow.innerHTML = `
                                        <td id="number-product" class="p-2 text-center"></td>
                                        <td class="w-40 p-2">
                                            <x-select x-on:click="getProduct(product); await $nextTick(); setProduk();"  x-init="await $nextTick(); setProduk();" :dataLists="$products->toArray()"
                                                :name="'product_id[]'" :id="'product_id'" />
                                        </td>
                                        <td class="p-2"><input type="number" name="quantity_product[]"
                                                oninput="subTotalProduk(this)" value="0" step="0.0001"
                                                class="w-16 px-2 py-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300">
                                        </td>
                                        <td id="price" class="p-2"></td>
                                        <td id="subtotal" class="p-2"></td>
                                        <td class="p-2">
                                            <button type="button" x-on:click="product.remove(); set_total(); set_number_product()"
                                                class="transition-all duration-300 rounded-full hover:bg-slate-100 active:bg-slate-200"><span
                                                    class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                                        </td>
                                    `;

            tableProduct.appendChild(productRow);
        }

        function setKomponen() {
            document.querySelectorAll(".component_id").forEach(element => {
                element._x_dataStack[0].list = componentsSelected
            })
        }

        function set_subtotal(element) {
            element.value < 0 ? element.value = 0 : element.value;
            let tr = element.parentElement.parentElement;
            let price = tr.querySelector('#price').textContent.replace(/[^0-9\.,]/g, '').replace(/\./g,
                '').replace(',', '.');
            let subtotal = tr.querySelector('#subtotal');
            subtotal.textContent = toRupiah(price * element.value);

            set_total();
        }

        function set_total() {
            let subtotals = document.querySelectorAll('#subtotal');
            let total = 0;
            subtotals.forEach(subtotalElement => {
                let subtotalValue = parseFloat(subtotalElement.textContent.replace(/[^0-9\.,]/g, '').replace(/\./g,
                    '').replace(',', '.'));
                total += isNaN(subtotalValue) ? 0 : subtotalValue;

                document.querySelector('#total_bill').value = total || null;
            })
        }

        function batasBayar(bayarEl) {
            const total = parseInt(document.querySelector('#total_bill').value);
            const bayar = parseInt(bayarEl.value);

            bayarEl.value = bayar > total ? total : bayar
        }
    </script>
@endpush
