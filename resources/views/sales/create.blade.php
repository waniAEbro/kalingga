@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Create Sales</h1>

    <x-create-input-field :action="'sales'" :width="'w-full'">
        <div class="flex gap-5">
            <div>
                <label for="sale_date" class="block text-sm">Tanggal Penjualan</label>
                <x-input type="date" :name="'sale_date'" :inputParentClass="'mb-3'" :value="old('sale_date') ?? Carbon\Carbon::now()->format('Y-m-d')" />

                <label for="due_date" class="block text-sm">Tanggal Jatuh Tempo</label>
                <x-input type="date" :name="'due_date'" :inputParentClass="'mb-3'" :value="old('due_date') ?? Carbon\Carbon::now()->format('Y-m-d')" />

                <label for="customer_id" class="block text-sm">Pelanggan</label>
                <div class="mt-2 mb-3">
                    <x-select x-on:click="getCustomer" :dataLists="$customers->toArray()" :name="'customer_id'" :id="'customer_id'"
                        :value="old('customer_id') ?? 0" :new="'newCustomerModal()'" />
                    @error('customer_id')
                        <div class="mt-1 text-xs text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <x-input :name="'customer_address'" :label="'Alamat Pelanggan'" readonly :inputParentClass="'mb-3'" />

                <x-input :name="'customer_email'" :label="'Email Pelanggan'" readonly :inputParentClass="'mb-3'" />

                <x-input :name="'customer_phone'" :label="'No Hp Pelanggan'" readonly :inputParentClass="'mb-3'" />

                <x-input :name="'code'" :type="'text'" :label="'Kode Penjualan'" :inputParentClass="'mb-3'" :value="old('code') ?? 0" />

                <x-input :name="'method'" :type="'text'" :label="'Metode Pembayaran'" :inputParentClass="'mb-3'" :value="old('method') ?? 0" />

                <x-input :name="'beneficiary_bank'" :type="'text'" :label="'Beneficiary\'s Bank'" :inputParentClass="'mb-3'" :value="old('beneficiary_bank') ?? 0" />

                <x-input :name="'beneficiary_ac_usd'" :type="'text'" :label="'Beneficiary A/C USD'" :inputParentClass="'mb-3'" :value="old('beneficiary_ac_usd') ?? 0" />

                <x-input :name="'bank_address'" :type="'text'" :label="'Bank Address'" :inputParentClass="'mb-3'" :value="old('bank_address') ?? 0" />

                <x-input :name="'swift_code'" :type="'text'" :label="'Swift Code'" :inputParentClass="'mb-3'" :value="old('swift_code') ?? 0" />

                <x-input :name="'beneficiary_name'" :type="'text'" :label="'Swift Code'" :inputParentClass="'mb-3'" :value="old('beneficiary_name') ?? 0" />

                <x-input :name="'beneficiary_address'" :type="'text'" :label="'Beneficiary\'s Address'" :inputParentClass="'mb-3'" :value="old('beneficiary_address') ?? 0" />

                <x-input :name="'phone'" :type="'text'" :label="'Phone'" :inputParentClass="'mb-3'" :value="old('phone') ?? 0" />

                <div class="flex w-full gap-3 my-3">
                    <div class="flex-1">
                        <x-input-textarea :name="'location'" :label="'Lokasi Pengiriman'" :placeholder="'location'" :value="old('location') ?? 0" />
                    </div>
                </div>
            </div>

            <div class="divider divider-horizontal"></div>

            <div class="w-full text-sm">
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
                        @if (old('product_id', []))
                            @foreach (old('product_id', []) as $index => $product)
                                <tr x-data="{ product: $el }" class="border-b">
                                    <td id="number-product" class="p-2 text-center"></td>
                                    <td class="w-40 p-2">
                                        <x-select x-on:click="getProduct(product); await $nextTick(); setProduk();"
                                            :dataLists="$products->toArray()" :name="'product_id[]'" :value="$product" :id="'product_id'"
                                            :new="'newProductModal(product); await $nextTick(); setSupplierListInProduct(); setComponentListInProduct(); '" />
                                        @error('product_id.' . $index)
                                            <div class="mt-1 text-xs text-red-400">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td class="p-2"><input x-ref="quantity" type="number" name="quantity_product[]"
                                            oninput="subTotalProduk(this)" value="{{ old('quantity_product', [])[$index] }}"
                                            x-init="getProduct(product);
                                            await $nextTick();
                                            subTotalProduk($refs.quantity)" step="1"
                                            class="w-16 px-2 py-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300">
                                        @error('quantity_product.' . $index)
                                            <div class="mt-1 text-xs text-red-400">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td id="price" class="p-2"></td>
                                    <td id="subtotal" class="p-2"></td>
                                    <td class="p-2">
                                        <button type="button"
                                            x-on:click="product.remove(); set_total(); set_number_product(); productDeleteBtnToggle()"
                                            class="transition-all duration-300 rounded-full product-delete-btn hover:bg-slate-100 active:bg-slate-200"><span
                                                class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr x-data="{ product: $el }" class="border-b">
                                <td id="number-product" class="p-2 text-center"></td>
                                <td class="w-40 p-2">
                                    <x-select x-on:click="getProduct(product); await $nextTick(); setProduk();"
                                        :dataLists="$products->toArray()" :name="'product_id[]'" :id="'product_id'" :new="'newProductModal(product); await $nextTick(); setSupplierListInProduct(); setComponentListInProduct(); '" />
                                </td>
                                <td class="p-2"><input x-ref="quantity" type="number" name="quantity_product[]"
                                        oninput="subTotalProduk(this)" value="0" x-init="getProduct(product);
                                        await $nextTick();
                                        subTotalProduk($refs.quantity)" step="1"
                                        class="w-16 px-2 py-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300">
                                </td>
                                <td id="price" class="p-2"></td>
                                <td id="subtotal" class="p-2"></td>
                                <td class="p-2">
                                    <button type="button"
                                        x-on:click="product.remove(); set_total(); set_number_product(); productDeleteBtnToggle()"
                                        class="transition-all duration-300 rounded-full product-delete-btn hover:bg-slate-100 active:bg-slate-200"><span
                                            class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                <button type="button" x-data
                    x-on:click="addNewProduct(); set_number_product(); await $nextTick(); setProduk(); productDeleteBtnToggle()"
                    class="flex justify-center w-full py-2 text-sm transition duration-300 border-b border-dashed border-x hover:bg-slate-50 active:bg-sky-100">Add
                    New</button>

                <div class="flex justify-end gap-3 mt-10">
                    <div class="w-40">
                        <x-input :label="'Total'" :name="'total_bill'" :placeholder="'Total Bayar'" :type="'number'" readonly />
                    </div>
                    <div class="w-40">
                        <x-input :label="'Bayar'" :name="'paid'" :placeholder="'Bayar'" :type="'number'"
                            :value="old('paid') ?? null" onInput="update_bill(this)" />
                        {{-- @error('quantity.' . $index)
                                            <div class="mt-1 text-xs text-red-400">{{ $message }}</div>
                                        @enderror --}}
                    </div>
                </div>
            </div>
        </div>
    </x-create-input-field>
@endsection

@push('script')
    <script>
        let customers = {!! $customers !!}
        let components = {!! $components !!};
        let products = {!! $products !!}
        let suppliers = {!! $suppliers !!}

        let customersSelected = {}
        let selectedProduct = {}
        let componentsSelected = {}
        let suppliersSelected = {}

        components.forEach(c => componentsSelected[c.id] = c.name)
        products.forEach(p => selectedProduct[p.id] = p.name)
        suppliers.forEach(s => suppliersSelected[s.id] = s.name)

        // set_number();
        set_number_product();
        productDeleteBtnToggle();

        function addNewComponentProduct() {
            const tableBody = document.getElementById('table-component-product');
            const tableRow = document.createElement('tr');
            tableRow.setAttribute('x-data', '{ component: $el }')
            tableRow.className = 'border-b';
            tableRow.innerHTML = `
                                        <td id="number-component-product" class="p-2 text-center"></td>
                                        <td class="w-40 p-2">
                                            <x-select x-on:click="getComponentProduct(component); set_subtotal_product(component)" :dataLists="$components->toArray()"
                                                :name="'component_id[]'" :id="'component_id'" />
                                        </td>
                                        <td class="p-2">
                                            <input step="0.001" x-ref="quantity" type="number" name="quantity[]"
                                                oninput="set_subtotal_product(this)" value=""
                                                class="w-20 px-2 py-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300">
                                        </td>
                                        <td id="unit-product-modal" class="p-2"></td>
                                        <td id="price-product-modal" class="p-2"></td>
                                        <td id="subtotal-product-modal" class="p-2"></td>
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
                                        <x-select x-on:click="$nextTick();" :dataLists="$suppliers->toArray()" :name="'supplier_id[]'"
                                            :id="'supplier_id'" />
                                    </td>
                                    <td class="p-2">
                                        <x-input-with-desc :desc="'Rp'" :name="'price_supplier'" :type="'number'"
                                            :placeholder="'1000'" />
                                    </td>
                                    <td id="suppl" class="p-2">
                                        <button type="button"
                                            x-on:click="supplier.remove(); set_total(); set_number_supplier_product(); supplierDeleteBtnToggleProduct()"
                                            class="transition-all duration-300 rounded-full supplier-delete-btn-product hover:bg-slate-100 active:bg-slate-200"><span
                                                class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                                    </td>
                                    `;

            tableBody.appendChild(tableRow);
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
                                                :name="'product_id[]'" :id="'product_id'" :new="'newProductModal(product); await $nextTick(); setSupplierListInProduct(); setComponentListInProduct(); '" />
                                        </td>
                                        <td class="p-2"><input id="quantity" type="number" name="quantity_product[]"
                                                oninput="subTotalProduk(this)" value="0" step="1"
                                                class="w-16 px-2 py-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300">
                                        </td>
                                        <td id="price" class="p-2"></td>
                                        <td id="subtotal" class="p-2"></td>
                                        <td class="p-2">
                                            <button type="button" x-on:click="product.remove(); set_total(); set_number_product(); productDeleteBtnToggle()"
                                                class="transition-all duration-300 rounded-full product-delete-btn hover:bg-slate-100 active:bg-slate-200"><span
                                                    class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                                        </td>
                                    `;

            tableProduct.appendChild(productRow);
        }

        function newCustomerModal() {
            const modal = document.querySelector('#modal');
            document.querySelector('#modal-background').classList.remove('hidden');

            modal.classList.remove('opacity-0', '-z-40');
            modal.classList.add('opacity-100', 'z-40');

            modal.innerHTML = `<div class="w-[600px] bg-white h-fit rounded-xl pb-20 relative">
                <div
                    class="py-[20px] px-[30px] w-full relative border-b-2 border-gray-200 flex justify-between items-center">
                    <div class="text-xl font-bold">Tambah Customer Baru</div>
                    <div onclick="hideModal()"
                        class="absolute flex items-center p-1 text-2xl rounded-full cursor-pointer right-5 hover:bg-slate-100">
                        <ion-icon name="close-outline"></ion-icon>
                    </div>
                </div>

                <div class="px-[30px] pt-[20px]">
                    <div class="flex w-full gap-3">
                        <div class="flex-1">
                            <x-input :label="'Nama Pelanggan'" :placeholder="'name'" :type="'text'"
                                :inputParentClass="'mb-3'" :name="'name'" />
                        </div>
                        <div class="flex-1">
                            <x-input :label="'Email'" :placeholder="'email'" :type="'email'"
                                :inputParentClass="'mb-3'" :name="'email'" />
                        </div>
                    </div>
                    <div class="flex w-full gap-3 my-3">
                        <div class="flex-1">
                            <x-input :label="'Kode Pelanggan'" :placeholder="'code'" :type="'text'"
                                :inputParentClass="'mb-3'" :name="'code'" />
                        </div>
                        <div class="flex-1">
                            <x-input :label="'No Hp'" :placeholder="'phone'" :type="'number'"
                                :inputParentClass="'mb-3'" :name="'phone'" />
                        </div>
                    </div>
                    <div class="flex w-full gap-3 my-3">
                        <div class="flex-1">
                            <x-input-textarea :name="'address'" :label="'Alamat'" :placeholder="'address'"
                                 />
                        </div>
                    </div>
                </div>

                <div class="absolute flex gap-2 bottom-4 right-[30px]">
                    <button type="button" onclick="hideModal()"
                        class="py-2 px-5 border text-[#768498] text-sm rounded-lg hover:bg-[#F7F9F9]">Batalkan</button>
                        <button id="create-customer" type="button" x-on:click="createCustomer()" onmouseover="toggleCustomerSaveButtonState()"
                        class="py-2 px-5 border text-[#F7F9F9] text-sm rounded-lg save flex items-center justify-center gap-3">Simpan <span class="hidden loading loading-spinner loading-sm"></span></button>
                </div>
            </div>`
        }

        async function createCustomer() {
            const modal = document.getElementById('modal')

            const name = modal.querySelector('#name').value
            const email = modal.querySelector('#email').value
            const phone = modal.querySelector('#phone').value
            const code = modal.querySelector('#code').value
            const address = modal.querySelector('#address').value

            const loading = modal.querySelector('.loading');
            loading.classList.remove('hidden')

            try {
                const response = await fetch("/api/customers", {
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

                customers = await response.json();

                if (!response.ok) {
                    throw customers;
                }

                const customerId = document.getElementById("customer_id")
                const customerClass = document.querySelector('.customer_id')
                console.log('customers', customers)

                let customersSelected = {}

                customers.forEach(e => {
                    customersSelected[e.id] = e.name
                })



                customerClass._x_dataStack[0].list = customersSelected
                customerClass._x_dataStack[0].selectedkey = customers[customers.length - 1].id
                customerClass._x_dataStack[0].selectedlabel = customers[customers.length - 1].name
                customerId.value = customers[customers.length - 1].id

                getCustomer();

                toastr.success(`${name} berhasil ditambahkan ke Customer`)
                loading.classList.add('hidden')
                hideModal()
            } catch (error) {
                console.error('Terjadi kesalahan', error)
            }

        }


        async function createProduct(productRow) {
            const modal = document.querySelector('#modal');

            const component_id = Array.from(modal.querySelectorAll('#component_id')).map(e => e.value)
            const quantity = Array.from(modal.querySelectorAll('#quantity')).map(e => e.value)
            const supplier_id = Array.from(modal.querySelectorAll('#supplier_id')).map(e => e.value)
            const price_supplier = Array.from(modal.querySelectorAll('#price_supplier')).map(e => e.value)

            const name = modal.querySelector('#name').value
            const logo = modal.querySelector('#logo').value
            const rfid = modal.querySelector('#rfid').value
            const code = modal.querySelector('#code').value
            const barcode = modal.querySelector('#barcode').value

            const length = modal.querySelector('#length').value
            const width = modal.querySelector('#width').value
            const height = modal.querySelector('#height').value

            const pack_inner_length = modal.querySelector('#pack_inner_length').value
            const pack_inner_width = modal.querySelector('#pack_inner_width').value
            const pack_inner_height = modal.querySelector('#pack_inner_height').value
            const pack_outer_length = modal.querySelector('#pack_outer_length').value
            const pack_outer_width = modal.querySelector('#pack_outer_width').value
            const pack_outer_height = modal.querySelector('#pack_outer_height').value
            const volume = modal.querySelector('#volume').value
            const cbm = modal.querySelector('#cbm').value
            const pack_nw = modal.querySelector('#pack_nw').value
            const pack_gw = modal.querySelector('#pack_gw').value

            const price_perakitan = modal.querySelector('#price_perakitan').value
            const price_perakitan_prj = modal.querySelector('#price_perakitan_prj').value
            const price_grendo = modal.querySelector('#price_grendo').value
            const price_obat = modal.querySelector('#price_obat').value
            const upah = modal.querySelector('#upah').value

            const pack_box_price = modal.querySelector('#pack_box_price').value
            const pack_box_hardware = modal.querySelector('#pack_box_hardware').value
            const pack_assembling = modal.querySelector('#pack_assembling').value
            const pack_stiker = modal.querySelector('#pack_stiker').value
            const pack_hagtag = modal.querySelector('#pack_hagtag').value
            const pack_maintenance = modal.querySelector('#pack_maintenance').value

            const biaya_overhead_pabrik = modal.querySelector('#biaya_overhead_pabrik').value
            const biaya_listrik = modal.querySelector('#biaya_listrik').value
            const biaya_pajak = modal.querySelector('#biaya_pajak').value
            const biaya_ekspor = modal.querySelector('#biaya_ekspor').value

            const total_production = modal.querySelector('#total_production').value
            const pack_cost = modal.querySelector('#pack_cost').value
            const total_other_cost = modal.querySelector('#total_other_cost').value

            const sell_price = modal.querySelector('#sell_price').value
            const sell_price_usd = modal.querySelector('#sell_price_usd').value
            const hpp = modal.querySelector('#hpp').value

            const loading = document.querySelector('.loading');
            loading.classList.remove('hidden')

            try {
                const response = await fetch("/api/product", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({
                        component_id,
                        quantity,
                        supplier_id,
                        price_supplier,
                        name,
                        logo,
                        rfid,
                        code,
                        barcode,
                        length,
                        width,
                        height,
                        pack_inner_height,
                        pack_inner_length,
                        pack_inner_width,
                        pack_outer_length,
                        pack_outer_width,
                        pack_outer_height,
                        volume,
                        cbm,
                        pack_nw,
                        pack_gw,
                        price_perakitan,
                        price_perakitan_prj,
                        price_grendo,
                        price_obat,
                        upah,
                        pack_box_price,
                        pack_box_hardware,
                        pack_assembling,
                        pack_stiker,
                        pack_hagtag,
                        pack_maintenance,
                        biaya_overhead_pabrik,
                        biaya_listrik,
                        biaya_pajak,
                        biaya_ekspor,
                        pack_cost,
                        total_production,
                        total_other_cost,
                        sell_price,
                        sell_price_usd,
                        hpp
                    })
                })

                products = await response.json(); // Mengambil data JSON dari respons

                if (!response.ok) {
                    throw products;
                }


                if (products.rfid || products.code) throw products;

                const supplierId = document.querySelector("#supplier_id").value
                const productId = productRow.querySelector('#product_id')
                const productClass = productRow.querySelector('.product_id')
                selectedProduct = {}

                products.forEach(e => {
                    selectedProduct[e.id] = e.name
                })

                productClass._x_dataStack[0].selectedkey = products[products.length - 1].id
                productClass._x_dataStack[0].selectedlabel = products[products.length - 1].name
                productId.value = products[products.length - 1].id

                setProduk()

                getProduct(productRow)
                subTotalProduk(productRow.querySelector('#quantity'))

                toastr.success(`${name} berhasil ditambahkan ke Produk`)
                loading.classList.add('hidden')
                hideModal()
            } catch (error) {
                loading.classList.add('hidden')
                modal.querySelector('#rfid-error').innerHTML = error.errors.rfid || ''
                modal.querySelector('#code-error').innerHTML = error.errors.code || ''
            }
        }

        function newProductModal(productRow) {
            const modal = document.querySelector('#modal');
            document.querySelector('#modal-background').classList.remove('hidden');

            modal.classList.remove('opacity-0', '-z-40');
            modal.classList.add('opacity-100', 'z-40');

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
                                        <x-select x-on:click="getComponentProduct(component); set_subtotal_product(component)" :dataLists="$components->toArray()"
                                            :name="'component_id[]'" :id="'component_id'" />
                                    </td>
                                    <td class="p-2">
                                        <input id="quantity" step="0.001" x-ref="quantity" type="number" name="quantity[]"
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
                            x-on:click="addNewComponentProduct(); set_number_component_product(); componentDeleteBtnToggleProduct(); await $nextTick(); setComponentListInProduct() "
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
                                        <x-input-with-desc :desc="'Rp'" :name="'price_supplier'" :type="'number'"
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
                            x-on:click="addNewSupplierProduct(); set_number_supplier_product(); supplierDeleteBtnToggleProduct(); await $nextTick(); setSupplierListInProduct(); "
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
                                <div>
                                    <x-input-with-desc :desc="'RFID'" :name="'rfid'" :value="0" />
                                    <div id="rfid-error" class="mt-1 text-xs italic text-red-500"></div>
                                </div>
                                <div>
                                    <x-input-with-desc :desc="'Produk'" :name="'code'" :type="'text'"
                                    :value="0" />
                                    <div id="code-error" class="mt-1 text-xs italic text-red-500"></div>
                                </div>
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
                        <button onmouseover="toggleProductSaveButtonState()" id="create-product" type="button" 
                        class="py-2 px-5 border text-[#F7F9F9] text-sm rounded-lg save flex items-center justify-center gap-3">Simpan <span class="hidden loading loading-spinner loading-sm"></span></button>
                    </div>
                </div>
            </div>`

            document.getElementById('create-product').addEventListener('click', () => {
                createProduct(productRow)
            })

            componentDeleteBtnToggleProduct();
            supplierDeleteBtnToggleProduct();
            set_number_supplier_product();
            set_number_component_product();
        }

        function toggleCustomerSaveButtonState() {
            const modal = document.getElementById('modal')

            const name = modal.querySelector('#name').value
            const email = modal.querySelector('#email').value
            const phone = modal.querySelector('#phone').value
            const code = modal.querySelector('#code').value
            const address = modal.querySelector('#address').value

            const saveButton = document.getElementById('create-customer')

            if (name && email && code && phone && address) {
                saveButton.disabled = false
                saveButton.style.cursor = 'pointer'
            } else {
                saveButton.disabled = true
                saveButton.style.cursor = "not-allowed"
            }
        }

        function getCustomer() {
            console.log('getcustomer')
            const customerId = document.getElementById('customer_id')
            console.log('customerId', customerId)
            const customer = customers.find(customer => customer.id == customerId.value)
            console.log('customer', customer)
            // customers.forEach(customer => console.log(customer.id))
            // console.log(customer)
            if (customer) {
                console.log('ada')
                const customerAddress = document.getElementById('customer_address').value = customer.address;
                const customerEmail = document.getElementById('customer_email').value = customer.email;
                const customerPhone = document.getElementById('customer_phone').value = customer.phone;

            } else {
                console.log('tak ada')
                const customerAddress = document.getElementById('customer_address').value = '';
                const customerEmail = document.getElementById('customer_email').value = '';
                const customerPhone = document.getElementById('customer_phone').value = '';
            }
        }

        function getComponentProduct(tr) {
            const componentId = tr.querySelector('#component_id');
            console.log('componentId', componentId)
            console.log('components', components)
            if (componentId.value) {
                const component = components.find(component => component.id == componentId.value)
                console.log('component', component)
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

        function getProduct(tr) {
            const productId = tr.querySelector('#product_id');

            if (productId.value) {
                const product = products.find(product => product.id == productId.value)
                const price = tr.querySelector('#price').innerText = toRupiah(product.sell_price);
            } else {
                const unit = tr.querySelector('#unit').innerText = '';
                const price = tr.querySelector('#price').innerText = '';
            }
        }

        function setProduk() {
            document.querySelectorAll(".product_id").forEach(element => {
                element._x_dataStack[0].list = selectedProduct
            })
        }

        function set_number_product() {
            const numbers = document.querySelectorAll('#number-product');
            numbers.forEach((number, i) => number.innerText = i + 1)
        }

        function set_number_component_product() {
            const numbers = document.querySelectorAll('#number-component-product');
            numbers.forEach((number, i) => number.innerText = i + 1)
        }

        function set_number_supplier_product() {
            const numbers = document.querySelectorAll('#number-supplier-product');
            numbers.forEach((number, i) => number.innerText = i + 1)
        }

        function subTotalProduk(e) {
            console.log(e)
            const tr = e.parentElement.parentElement;
            const price = tr.querySelector('#price').innerText.replace(/[^0-9\.,]/g, '').replace(/\./g, '').replace(',',
                '.');
            const subtotal = tr.querySelector('#subtotal');
            subtotal.innerText = toRupiah(parseInt(price) * parseFloat(e.value));
            console.log('price', parseInt(price))
            console.log('e.value', parseFloat(e.value))
            console.log('price * e.value', parseInt(price) * parseFloat(e.value))
            console.log(subtotal)
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
            // console.log('total', total)
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

        function productDeleteBtnToggle() {
            const deleteBtn = document.querySelectorAll('.product-delete-btn')
            if (deleteBtn.length == 1) {
                deleteBtn[0].style.display = "none"
            } else {
                deleteBtn.forEach(btn => btn.style.display = 'block')
            }
        }


        function setSupplierListInProduct() {
            const modal = document.querySelector('#modal')
            let supplierList = {}

            suppliers.forEach(s => supplierList[s.id] = s.name)

            modal.querySelectorAll('.supplier_id').forEach(e => {
                e._x_dataStack[0].list = supplierList
            })
        }

        function setComponentListInProduct() {
            const modal = document.querySelector('#modal')
            let componentList = {}

            components.forEach(c => componentList[c.id] = c.name)

            modal.querySelectorAll('.component_id').forEach(e => {
                e._x_dataStack[0].list = componentList
            })
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

        function toggleProductSaveButtonState() {
            const modal = document.querySelector('#modal');

            const component_id = Array.from(modal.querySelectorAll('#component_id')).map(e => e.value)
            const quantity = Array.from(modal.querySelectorAll('#quantity')).map(e => e.value)
            const supplier_id = Array.from(modal.querySelectorAll('#supplier_id')).map(e => e.value)
            const price_supplier = Array.from(modal.querySelectorAll('#price_supplier')).map(e => e.value)

            const name = modal.querySelector('#name').value
            const logo = modal.querySelector('#logo').value
            const rfid = modal.querySelector('#rfid').value
            const code = modal.querySelector('#code').value
            const barcode = modal.querySelector('#barcode').value

            const length = modal.querySelector('#length').value
            const width = modal.querySelector('#width').value
            const height = modal.querySelector('#height').value

            const pack_inner_length = modal.querySelector('#pack_inner_length').value
            const pack_inner_width = modal.querySelector('#pack_inner_width').value
            const pack_inner_height = modal.querySelector('#pack_inner_height').value
            const pack_outer_length = modal.querySelector('#pack_outer_length').value
            const pack_outer_width = modal.querySelector('#pack_outer_width').value
            const pack_outer_height = modal.querySelector('#pack_outer_height').value
            const volume = modal.querySelector('#volume').value
            const cbm = modal.querySelector('#cbm').value
            const pack_nw = modal.querySelector('#pack_nw').value
            const pack_gw = modal.querySelector('#pack_gw').value

            const price_perakitan = modal.querySelector('#price_perakitan').value
            const price_perakitan_prj = modal.querySelector('#price_perakitan_prj').value
            const price_grendo = modal.querySelector('#price_grendo').value
            const price_obat = modal.querySelector('#price_obat').value
            const upah = modal.querySelector('#upah').value

            const pack_box_price = modal.querySelector('#pack_box_price').value
            const pack_box_hardware = modal.querySelector('#pack_box_hardware').value
            const pack_assembling = modal.querySelector('#pack_assembling').value
            const pack_stiker = modal.querySelector('#pack_stiker').value
            const pack_hagtag = modal.querySelector('#pack_hagtag').value
            const pack_maintenance = modal.querySelector('#pack_maintenance').value

            const biaya_overhead_pabrik = modal.querySelector('#biaya_overhead_pabrik').value
            const biaya_listrik = modal.querySelector('#biaya_listrik').value
            const biaya_pajak = modal.querySelector('#biaya_pajak').value
            const biaya_ekspor = modal.querySelector('#biaya_ekspor').value

            const total_production = modal.querySelector('#total_production').value
            const pack_cost = modal.querySelector('#pack_cost').value
            const total_other_cost = modal.querySelector('#total_other_cost').value

            const sell_price = modal.querySelector('#sell_price').value
            const sell_price_usd = modal.querySelector('#sell_price_usd').value
            const hpp = modal.querySelector('#hpp').value
            const saveButton = document.getElementById('create-product')

            const productsList = [component_id,
                quantity,
                supplier_id,
                price_supplier,
                name,
                logo,
                rfid,
                code,
                barcode,
                length,
                width,
                height,
                pack_inner_height,
                pack_inner_length,
                pack_inner_width,
                pack_outer_length,
                pack_outer_width,
                pack_outer_height,
                volume,
                cbm,
                pack_nw,
                pack_gw,
                price_perakitan,
                price_perakitan_prj,
                price_grendo,
                price_obat,
                upah,
                pack_box_price,
                pack_box_hardware,
                pack_assembling,
                pack_stiker,
                pack_hagtag,
                pack_maintenance,
                biaya_overhead_pabrik,
                biaya_listrik,
                biaya_pajak,
                biaya_ekspor,
                pack_cost,
                total_production,
                total_other_cost,
                sell_price,
                sell_price_usd,
                hpp
            ]

            let save = productsList.every((p) => ((typeof p === 'object' && p[0]) || (typeof p !== 'object' && p)))

            if (save) {
                saveButton.disabled = false
                saveButton.style.cursor = 'pointer'
            } else {
                saveButton.disabled = true
                saveButton.style.cursor = "not-allowed"
            }
        }
    </script>
@endpush
