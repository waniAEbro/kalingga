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
                <div class="w-full mt-2 mb-3">
                    <x-select x-on:click="getSupplier; await $nextTick();" :dataLists="$suppliers->toArray()" :name="'supplier_id'"
                        :id="'supplier_id'" :value="old('supplier_id')" :new="'newSupplierModal()'" />
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
                                        <x-select
                                            x-on:click="getComponent(component); await $nextTick(); set_subtotal($refs.quantity)"
                                            x-init="await $nextTick();
                                            setKomponen();" :dataLists="$components->toArray()" :name="'component_id[]'" :id="'component_id'"
                                            :value="$component" :new="'newComponentModal()'" />
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
                                        <button type="button"
                                            x-on:click="component.remove(); set_total(); set_number_component()"
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
        const products = {!! $products !!}
        const components = {!! $components !!};
        let selectedProduct = {}
        let componentsSelected = {}

        function addNewSupplier() {
            const tableBody = document.getElementById('table-body');
            const tableRow = document.createElement('tr');
            tableRow.setAttribute('x-data', '{ supplier: $el }')
            tableRow.className = 'border-b';
            tableRow.innerHTML = `
                                        <td id="modal-supplier-number" class="p-2 text-center"></td>
                                        <td class="p-2">
                                            <x-select x-on:click="$nextTick();" :dataLists="$suppliers->toArray()" :name="'supplier_id[]'" :id="'supplier_id'" />
                                        </td>
                                        <td class="p-2">
                                            <x-input-with-desc :desc="'Rp'" :name="'price_supplier[]'" :type="'number'" :placeholder="'1000'" />
                                        </td>
                                        <td id="aksi" class="p-2">
                                            <button type="button" x-on:click="supplier.remove(); set_modal_supplier_number(); supplierDeleteBtnToggle()"
                                                class="transition-all duration-300 rounded-full supplier-delete-btn hover:bg-slate-100 active:bg-slate-200"><span
                                                    class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                                        </td>
                                    `;

            tableBody.appendChild(tableRow);
            supplierDeleteBtnToggle();
        }

        function set_modal_supplier_number() {
            const numbers = document.querySelectorAll('#modal-supplier-number');
            numbers.forEach((number, i) => number.innerText = i + 1)
        }

        function deleteBtnToggle() {
            const deleteBtn = document.querySelectorAll('.delete-btn')
            if (deleteBtn.length == 1) {
                deleteBtn[0].style.display = "none"
            } else {
                deleteBtn.forEach(btn => btn.style.display = 'block')
            }
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

        function subTotalProduk(e) {
            const tr = e.parentElement.parentElement;
            const price = tr.querySelector('#price').innerText.replace(/[^0-9\.,]/g, '').replace(/\./g, '').replace(',',
                '.');
            const subtotal = tr.querySelector('#subtotal');
            subtotal.innerText = toRupiah(price * e.value);
            set_total();
        }


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
                // console.log(componentsSelected)
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
                                                :name="'component_id[]'" :id="'component_id'" :new="'newComponentModal()'" />
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
            componentDeleteBtnToggle();
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
                                                :name="'product_id[]'" :id="'product_id'" :new="'newProductModal()'" />
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

        function addNewComponentProduct() {
            const tableBody = document.getElementById('table-component-product');
            const tableRow = document.createElement('tr');
            tableRow.setAttribute('x-data', '{ component: $el }')
            tableRow.className = 'border-b';
            tableRow.innerHTML = `
                                        <td id="number-component-product" class="p-2 text-center"></td>
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
                                            <button type="button" x-on:click="component.remove(); set_total(); set_number_component_product(); componentDeleteBtnToggleProduct()"
                                                class="transition-all duration-300 rounded-full comp-delete-btn-product hover:bg-slate-100 active:bg-slate-200"><span
                                                    class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                                        </td>
                                    `;

            tableBody.appendChild(tableRow);
        }

        function addNewSupplierProduct() {
            const tableBody = document.getElementById('table-supplier-product');
            const tableRow = document.createElement('tr');
            tableRow.setAttribute('x-data', '{ supplier: $el }')
            tableRow.className = 'border-b';
            tableRow.innerHTML = `
                                        <td id="number-supplier-product" class="p-2 text-center"></td>
                                        <td class="p-2">
                                            <x-select x-on:click="$nextTick();" :dataLists="$suppliers->toArray()" :name="'supplier_id[]'" :id="'supplier_id'" />
                                        </td>
                                        <td class="p-2">
                                            <x-input-with-desc :desc="'Rp'" :name="'price_supplier[]'" :type="'number'" :placeholder="'1000'" />
                                        </td>
                                        <td id="suppl" class="p-2">
                                            <button type="button" x-on:click="supplier.remove(); set_total(); set_number_supplier_product(); supplierDeleteBtnToggleProduct()"
                                                class="transition-all duration-300 rounded-full supplier-delete-btn-product hover:bg-slate-100 active:bg-slate-200"><span
                                                    class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                                        </td>
                                    `;

            tableBody.appendChild(tableRow);
        }

        function set_number_component_product() {
            const numbers = document.querySelectorAll('#number-component-product');
            numbers.forEach((number, i) => number.innerText = i + 1)
        }

        function set_number_supplier_product() {
            const numbers = document.querySelectorAll('#number-supplier-product');
            numbers.forEach((number, i) => number.innerText = i + 1)
        }

        function supplierDeleteBtnToggleProduct() {
            const deleteBtn = document.querySelectorAll('.supplier-delete-btn-product')
            if (deleteBtn.length == 1) {
                deleteBtn[0].style.display = "none"
            } else {
                deleteBtn.forEach(btn => btn.style.display = 'block')
            }
        }

        function componentDeleteBtnToggleProduct() {
            const deleteBtn = document.querySelectorAll('.comp-delete-btn-product')
            if (deleteBtn.length == 1) {
                deleteBtn[0].style.display = "none"
            } else {
                deleteBtn.forEach(btn => btn.style.display = 'block')
            }
        }

        function set_total_produksi() {
            const el_biaya_produksi = document.querySelectorAll('.biaya_produksi input')
            const biaya_produksi = Array.from(el_biaya_produksi)
                .map(el => parseInt(el.value) || 0)
                .reduce((acc, curr) => acc + curr)
            const total_produksi = document.querySelector('input[name="total_production"]').value = biaya_produksi;

            set_total_product();
        }

        function set_total_packing() {
            const el_biaya_packing = document.querySelectorAll('.biaya_packing input')
            const biaya_packing = Array.from(el_biaya_packing)
                .map(el => parseInt(el.value) || 0)
                .reduce((acc, curr) => acc + curr)
            const total_packing = document.querySelector('input[name="pack_cost"]').value = biaya_packing;

            set_total_product();
        }

        function set_total_lain() {
            const el_biaya_lain = document.querySelectorAll('.biaya_lain input')
            const biaya_lain = Array.from(el_biaya_lain)
                .map(el => parseInt(el.value) || 0)
                .reduce((acc, curr) => acc + curr)
            const total_packing = document.querySelector('input[name="total_other_cost"]').value = biaya_lain;

            set_total_product();
        }

        function set_volume() {
            const packOuterLength = document.getElementById('pack_outer_length').value;
            const packOuterWidth = document.getElementById('pack_outer_width').value;
            const packOuterHeight = document.getElementById('pack_outer_height').value;
            const volume = document.getElementById('volume').value = packOuterHeight * packOuterLength * packOuterWidth;

        }

        function set_subtotal_product(element) {
            let tr = element.parentElement.parentElement;
            let price = tr.querySelector('#price-product-modal').textContent.replace(/[^0-9\.,]/g, '').replace(/\./g,
                '').replace(',', '.');
            let subtotal = tr.querySelector('#subtotal-product-modal');
            subtotal.textContent = toRupiah(0)
            if (price != "" && parseFloat(element.value) >= 0) {
                subtotal.textContent = toRupiah(parseInt(price) * parseFloat(element.value));
            } else {
                subtotal.textContent = toRupiah(0);
            }

            set_total_product();
        }

        function set_total_product() {
            let subtotals = document.querySelectorAll('#subtotal-product-modal');
            let total = 0;
            subtotals.forEach(subtotalElement => {
                let subtotalValue = parseFloat(subtotalElement.textContent.replace(/[^0-9\.,]/g, '').replace(/\./g,
                    '').replace(',', '.'));
                total += isNaN(subtotalValue) ? 0 : subtotalValue;
            })

            let production_cost = parseInt(document.querySelector('#total_production').value) || 0;
            let other_cost = parseInt(document.querySelector('#total_other_cost').value) || 0;
            let pack_cost = parseInt(document.querySelector('#pack_cost').value) || 0;

            total += production_cost + other_cost + pack_cost

            document.querySelector('#hpp').value = total;
        }

        function getComponentProduct(tr) {
            let components = {!! $components !!};
            const componentId = tr.querySelector('#component_id');

            if (componentId.value) {
                const component = components.find(component => component.id == componentId.value)
                tr.querySelector('#unit-product-modal').innerText = component.unit;
                tr.querySelector('#price-product-modal').innerText = toRupiah(component.price_per_unit);
            } else {
                tr.querySelector('#unit-product-modal').innerText = '';
                tr.querySelector('#price-product-modal').innerText = '';
                tr.querySelector('#subtotal-product-modal').innerText = "";
                tr.querySelector('.input_quantity').value = 0;
                set_total()
            }
        }

        function newSupplierModal() {
            const modal = document.querySelector('#modal');
            document.querySelector('#modal-background').classList.remove('hidden');

            modal.classList.remove('opacity-0', '-z-20');
            modal.classList.add('opacity-100', 'z-20');

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
                        <button type="button" onclick="createSupplier()"
                        class="py-2 px-5 border text-[#F7F9F9] text-sm rounded-lg save flex items-center justify-center gap-3">Simpan <span class="hidden loading loading-spinner loading-sm"></span></button>
                </div>
            </div>`
        }

        function newComponentModal() {
            const modal = document.querySelector('#modal');
            document.querySelector('#modal-background').classList.remove('hidden');

            modal.classList.remove('opacity-0', '-z-20');
            modal.classList.add('opacity-100', 'z-20');

            modal.innerHTML = `<div class="w-[700px] bg-white h-fit rounded-xl pb-20 relative">
                <div
                    class="py-[20px] px-[30px] w-full relative border-b-2 border-gray-200 flex justify-between items-center">
                    <div class="text-xl font-bold">Tambah Komponen Baru</div>
                    <div onclick="hideModal()"
                        class="absolute flex items-center p-1 text-2xl rounded-full cursor-pointer right-5 hover:bg-slate-100">
                        <ion-icon name="close-outline"></ion-icon>
                    </div>
                </div>

                <div class="px-[30px] pt-[20px]">
                    <div class="flex w-full gap-3">
                        <div class="flex-1">
                            <x-input :name="'component_name'" :label="'Nama Komponen'" :placeholder="'kayu'" :type="'text'"
                                :value="old('name')" />
                        </div>
                        <div class="flex-none">
                            <x-input :name="'component_unit'" :label="'Unit'" :placeholder="'m'" :value="old('unit')" />
                        </div>
                    </div>
                    <div class="flex w-full gap-3 my-3">
                        <div class="flex-1">
                            <x-input-with-desc :desc="'Rp'" :name="'price_per_unit'" :type="'number'"
                                :label="'Harga Per Unit'" :placeholder="'1000'" :value="old('price_per_unit')" />
                        </div>
                    </div>

                    <table class="w-full mt-5 text-left table-fixed">
                        <thead>
                            <tr class="border-y-2">
                                <th class="w-20 p-2 text-center">#</th>
                                <th class="p-2 w-60">Pemasok</th>
                                <th class="p-2">Harga</th>
                                <th class="w-20 p-2"></th>
                            </tr>
                        </thead>
                        <tbody id="table-body">

                            <tr x-data="{ supplier: $el }" class="border-b">
                                <td id="modal-supplier-number" class="p-2 text-center"></td>
                                <td class="p-2">
                                    <x-select x-on:click="$nextTick();" :dataLists="$suppliers->toArray()" :name="'supplier_id[]'"
                                        :id="'supplier_id_component'" />
                                </td>
                                <td class="p-2">
                                    <x-input-with-desc :desc="'Rp'" :name="'price_supplier_component'" :type="'number'"
                                        :placeholder="'1000'" />
                                </td>
                                <td id="aksi" class="p-2">
                                    <button type="button"
                                        x-on:click="supplier.remove(); set_modal_supplier_number(); supplierDeleteBtnToggle()"
                                        class="transition-all duration-300 rounded-full supplier-delete-btn hover:bg-slate-100 active:bg-slate-200"><span
                                            class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" x-data x-on:click="addNewSupplier(); set_modal_supplier_number()"
                        class="flex justify-center w-full py-2 text-sm transition duration-300 border-b border-dashed border-x hover:bg-slate-50 active:bg-sky-100">Add
                        New</button>
                </div>

                <div class="absolute flex gap-2 bottom-4 right-[30px]">
                    <button type="button" onclick="hideModal()"
                        class="py-2 px-5 border text-[#768498] text-sm rounded-lg hover:bg-[#F7F9F9]">Batalkan</button>
                    <button type="button" onclick="createComponent()"
                        class="py-2 px-5 border text-[#F7F9F9] text-sm rounded-lg save flex items-center justify-center gap-3">Simpan <span class="hidden loading loading-spinner loading-sm"></span></button>
                </div>
            </div>`
            set_modal_supplier_number();
            supplierDeleteBtnToggle();
        }

        function newProductModal() {
            const modal = document.querySelector('#modal');
            document.querySelector('#modal-background').classList.remove('hidden');

            modal.classList.remove('opacity-0', '-z-20');
            modal.classList.add('opacity-100', 'z-20');

            modal.innerHTML = `<div class="w-[1000px] bg-white h-fit rounded-xl pb-20 relative">
                <div
                    class="py-[20px] px-[30px] w-full relative border-b-2 border-gray-200 flex justify-between items-center">
                    <div class="text-xl font-bold">Tambah Produk Baru</div>
                    <div onclick="hideModal()"
                        class="absolute flex items-center p-1 text-2xl rounded-full cursor-pointer right-5 hover:bg-slate-100">
                        <ion-icon name="close-outline"></ion-icon>
                    </div>
                </div>

                <div class="px-[30px] pt-[20px] h-[400px] overflow-y-scroll overscroll-contain">
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
                            <tbody id="table-component-product">

                                <tr x-data="{ component: $el }" class="border-b">
                                    <td id="number-component-product" class="p-2 text-center"></td>
                                    <td class="w-40 p-2">
                                        <x-select x-on:click="getComponentProduct(component); $nextTick();" :dataLists="$components->toArray()"
                                            :name="'component_id[]'" :id="'component_id'" />
                                    </td>
                                    <td class="p-2">
                                        <input step="0.001" x-ref="quantity" type="number" name="quantity[]"
                                            min="0" oninput="set_subtotal_product(this)" value=""
                                            class="w-20 px-2 py-2 transition-all duration-100 border rounded outline-none input_quantity focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300">
                                    </td>
                                    <td id="unit-product-modal" class="p-2"></td>
                                    <td id="price-product-modal" class="p-2"></td>
                                    <td id="subtotal-product-modal" class="p-2"></td>
                                    <td id="comp" class="p-2">
                                        <button type="button"
                                            x-on:click="component.remove(); await $nextTick; set_total(); set_number_component_product(); componentDeleteBtnToggleProduct()"
                                            class="transition-all duration-300 rounded-full comp-delete-btn-product hover:bg-slate-100 active:bg-slate-200"><span
                                                class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                        <button type="button" x-data
                            x-on:click="addNewComponentProduct(); set_number_component_product(); componentDeleteBtnToggleProduct()"
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
                            <tbody id="table-supplier-product">

                                <tr x-data="{ supplier: $el }" class="border-b">
                                    <td id="number-supplier-product" class="p-2 text-center"></td>
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
                                            x-on:click="supplier.remove(); set_total(); set_number_supplier_product(); supplierDeleteBtnToggleProduct()"
                                            class="transition-all duration-300 rounded-full supplier-delete-btn-product hover:bg-slate-100 active:bg-slate-200"><span
                                                class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <button type="button" x-data
                            x-on:click="addNewSupplierProduct(); set_number_supplier_product(); supplierDeleteBtnToggleProduct()"
                            class="flex justify-center w-full py-2 text-sm transition duration-300 border-b border-dashed border-x hover:bg-slate-50 active:bg-sky-100">Add
                            New</button>
                    </div>

                    <div class="divider"></div>

                    <div class="flex w-full gap-3 px-">
                        <div class="w-full">
                            <h1 class="mb-3 text-xl font-bold">Product</h1>

                            <div class="flex w-full gap-3">
                                <div class="flex-1">
                                    <x-input :label="'Nama Produk'" :name="'name'" :value="0" />
                                </div>
                                <div class="flex-1">
                                    <x-input :label="'Logo'" :name="'logo'" :value="0" />
                                </div>
                            </div>

                            <h1 class="my-3 font-bold">Kode</h1>
                            <div class="flex w-full gap-3">
                                <x-input-with-desc :desc="'RFID'" :name="'rfid'" :value="0" />
                                <x-input-with-desc :desc="'Produk'" :name="'code'" :type="'text'"
                                    :value="0" />
                                <x-input-with-desc :desc="'Barcode'" :name="'barcode'" :type="'number'"
                                    :value="0" />
                            </div>

                            <h1 class="my-3 font-bold">Dimensi</h1>
                            <div class="flex w-full gap-3">
                                <x-input-with-desc :desc="'Panjang'" :name="'length'" :type="'number'"
                                    :value="0" />
                                <x-input-with-desc :desc="'Tinggi'" :name="'height'" :type="'number'"
                                    :value="0" />
                                <x-input-with-desc :desc="'Lebar'" :name="'width'" :type="'number'"
                                    :value="0" />
                            </div>
                        </div>

                        <div class="divider divider-horizontal"></div>

                        <div class="w-full">
                            <h1 class="mb-3 text-xl font-bold">Pack</h1>

                            <h1 class="my-3 font-bold">Dimensi Dalam</h1>
                            <div class="flex w-full gap-3">
                                <x-input-with-desc :desc="'Panjang'" :name="'pack_inner_length'" :type="'number'"
                                    :value="0" />
                                <x-input-with-desc :desc="'Tinggi'" :name="'pack_inner_height'" :type="'number'"
                                    :value="0" />
                                <x-input-with-desc :desc="'Lebar'" :name="'pack_inner_width'" :type="'number'"
                                    :value="0" />
                            </div>

                            <h1 class="my-3 font-bold">Dimensi Luar</h1>
                            <div class="flex w-full gap-3">
                                <x-input-with-desc :desc="'Panjang'" :name="'pack_outer_length'" :type="'number'"
                                    oninput="set_volume()" :value="0" />
                                <x-input-with-desc :desc="'Tinggi'" :name="'pack_outer_height'" :type="'number'"
                                    oninput="set_volume()" :value="0" />
                                <x-input-with-desc :desc="'Lebar'" :name="'pack_outer_width'" :type="'number'"
                                    oninput="set_volume()" :value="0" />
                            </div>
                            <div class="w-40 my-3">
                                <x-input :label="'Volume (m³)'" :name="'volume'" :type="'number'" :value="0"
                                    readonly />
                                <x-input :label="'CBM'" :name="'cbm'" :type="'number'" :value="0" />
                            </div>

                            <h1 class="my-3 font-bold">Berat</h1>
                            <div class="flex w-full gap-3">
                                <x-input-with-desc :desc="'NW'" :name="'pack_nw'" :type="'number'"
                                    :value="0" />
                                <x-input-with-desc :desc="'GW'" :name="'pack_gw'" :type="'number'"
                                    :value="0" />
                            </div>
                        </div>
                    </div>

                    <div class="divider"></div>

                    <div class="w-full">
                        <h1 class="mb-3 text-xl font-bold">Biaya</h1>

                        <div class="flex w-full gap-2">
                            <div class="flex-1 px-2 biaya_produksi">
                                <h1 class="my-3 font-bold text-center">Biaya Produksi</h1>

                                <x-input oninput="set_total_produksi()" :label="'Harga Perakitan'" :desc="'Rp'"
                                    :name="'price_perakitan'" :type="'number'" :inputParentClass="'mb-3'" :value="0" />
                                <x-input oninput="set_total_produksi()" :label="'Harga Perakitan PRJ'" :desc="'Rp'"
                                    :name="'price_perakitan_prj'" :type="'number'" :inputParentClass="'mb-3'" :value="0" />
                                <x-input oninput="set_total_produksi()" :label="'Harga Grendo'" :desc="'Rp'"
                                    :name="'price_grendo'" :type="'number'" :inputParentClass="'mb-3'" :value="0" />
                                <x-input oninput="set_total_produksi()" :label="'Harga Obat'" :desc="'Rp'"
                                    :name="'price_obat'" :type="'number'" :inputParentClass="'mb-3'" :value="0" />
                                <x-input oninput="set_total_produksi()" :label="'Upah'" :desc="'Rp'"
                                    :name="'upah'" :type="'number'" :value="0" />
                            </div>

                            <div class="flex-1 px-4 border-gray-200 biaya_packing border-x-2">
                                <h1 class="my-3 font-bold text-center">Biaya Packing</h1>

                                <x-input oninput="set_total_packing()" :label="'Harga Box'" :desc="'Rp'"
                                    :name="'pack_box_price'" :type="'number'" :inputParentClass="'mb-3'" :value="0" />
                                <x-input oninput="set_total_packing()" :label="'Box Hardware'" :desc="'Rp'"
                                    :name="'pack_box_hardware'" :type="'number'" :inputParentClass="'mb-3'" :value="0" />
                                <x-input oninput="set_total_packing()" :label="'Assembling'" :desc="'Rp'"
                                    :name="'pack_assembling'" :type="'number'" :inputParentClass="'mb-3'" :value="0" />
                                <x-input oninput="set_total_packing()" :label="'Stiker'" :desc="'Rp'"
                                    :name="'pack_stiker'" :type="'number'" :inputParentClass="'mb-3'" :value="0" />
                                <x-input oninput="set_total_packing()" :label="'Hagtag'" :desc="'Rp'"
                                    :name="'pack_hagtag'" :type="'number'" :inputParentClass="'mb-3'" :value="0" />
                                <x-input oninput="set_total_packing()" :label="'Maintenance'" :desc="'Rp'"
                                    :name="'pack_maintenance'" :type="'number'" :value="0" />
                            </div>

                            <div class="flex-1 px-2 biaya_lain">
                                <h1 class="my-3 font-bold text-center">Biaya Lain-Lain</h1>

                                <x-input oninput="set_total_lain()" :label="'Overhead Pabrik'" :desc="'Rp'"
                                    :name="'biaya_overhead_pabrik'" :type="'number'" :inputParentClass="'mb-3'" :value="0" />
                                <x-input oninput="set_total_lain()" :label="'Listrik'" :desc="'Rp'"
                                    :name="'biaya_listrik'" :type="'number'" :inputParentClass="'mb-3'" :value="0" />
                                <x-input oninput="set_total_lain()" :label="'Pajak'" :desc="'Rp'"
                                    :name="'biaya_pajak'" :type="'number'" :inputParentClass="'mb-3'" :value="0" />
                                <x-input oninput="set_total_lain()" :label="'Export+Usaha'" :desc="'Rp'"
                                    :name="'biaya_ekspor'" :type="'number'" :value="0" />
                            </div>

                        </div>

                        <div class="divider"></div>

                        <div class="flex w-full gap-2 biaya_biaya">
                            <div class="flex-1 px-2">
                                <x-input readonly :label="'Total Produksi'" :desc="'Rp'" :name="'total_production'"
                                    :type="'number'" class="" :value="0" />
                            </div>
                            <div class="flex-1 px-4">
                                <x-input readonly :label="'Total Packing'" :desc="'Rp'" :name="'pack_cost'"
                                    :type="'number'" class="" :value="0" />
                            </div>
                            <div class="flex-1 px-2">
                                <x-input readonly :label="'Total Lain-Lain'" :desc="'Rp'" :name="'total_other_cost'"
                                    :type="'number'" class="" :value="0" />
                            </div>
                        </div>

                        <div class="divider"></div>

                        <div class="flex justify-end gap-3 mt-5">
                            <div class="w-52">
                                <x-input-with-desc :desc="'Rp'" :label="'HPP'" :name="'hpp'"
                                    :type="'number'" :value="0" />
                            </div>

                            <div class="w-52">
                                <x-input-with-desc :desc="'Rp'" :label="'Harga Jual'" :name="'sell_price'"
                                    :type="'number'" :value="0" />
                            </div>

                            <div class="w-52">
                                <x-input-with-desc :desc="'$'" :label="'Harga Jual Dollar'" :name="'sell_price_usd'"
                                    :type="'number'" :value="0" />
                            </div>
                        </div>
                    </div>

                    <div class="absolute flex gap-2 bottom-4 right-[30px]">
                        <button type="button" onclick="hideModal()"
                            class="py-2 px-5 border text-[#768498] text-sm rounded-lg hover:bg-[#F7F9F9]">Batalkan</button>
                        <button type="button" onclick="hideModal()"
                            class="py-2 px-5 border text-[#F7F9F9] text-sm rounded-lg save">Simpan</button>
                    </div>
                </div>
            </div>`
            componentDeleteBtnToggleProduct();
            supplierDeleteBtnToggleProduct();
            set_number_supplier_product();
            set_number_component_product();
        }

        async function createComponent() {
            const name = document.getElementById('component_name').value
            const unit = document.getElementById('component_unit').value
            const price_per_unit = document.getElementById('price_per_unit').value
            const supplier_id = Array.from(document.querySelectorAll('#supplier_id_component')).map(e => e.value)
            const price_supplier = Array.from(document.querySelectorAll('#price_supplier_component')).map(e => e.value)
            const loading = document.querySelector('.loading');
            loading.classList.remove('hidden')

            try {
                const response = await fetch("/api/component", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({
                        name,
                        price_per_unit,
                        unit,
                        supplier_id,
                        price_supplier
                    })
                })

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const responseData = await response.json(); // Mengambil data JSON dari respons
                console.log('Data berhasil terkirim:', responseData);
                toastr.success(`${name} berhasil ditambahkan ke Komponen`)
            } catch (error) {
                console.error('Terjadi kesalahan', error)
            }

            loading.classList.add('hidden')
            hideModal()
        }

        async function createSupplier() {
            const name = document.getElementById('supplier_name_modal').value
            const email = document.getElementById('supplier_email_modal').value
            const phone = document.getElementById('supplier_phone_modal').value
            const code = document.getElementById('supplier_code_modal').value
            const address = document.getElementById('supplier_address_modal').value

            console.log('name', name)
            console.log('email', email)
            console.log('phone', phone)
            console.log('code', code)
            console.log('address', address)

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

                const responseData = await response.json(); // Mengambil data JSON dari respons

                let responseBaru = {}

                responseData.forEach(e => {
                    responseBaru[e.id] = e.name
                })

                document.querySelector(".supplier_id")._x_dataStack[0].list = responseBaru

                document.querySelector(".supplier_id")._x_dataStack[0].selectedkey = responseData[responseData.length -
                    1].id

                document.querySelector(".supplier_id")._x_dataStack[0].selectedlabel = responseData[responseData
                    .length - 1].name

                toastr.success(`${name} berhasil ditambahkan ke Supplier`)
                loading.classList.add('hidden')
                hideModal()
            } catch (error) {
                console.error('Terjadi kesalahan', error)
            }

        }
    </script>
@endpush
