@extends('layouts.layout')

@section('content')
    <form action="/purchases" method="POST">
        @csrf

        <div class="text-[18px] font-medium">Buat Pembelian</div>

        <div x-data="{ open: true }" class="mt-5 bg-white rounded-lg w-full">
            <div x-on:click="open = !open"
                class="p-5 cursor-pointer active:bg-gray-50 transition-all items-center font-medium flex gap-5">
                <ion-icon :class="open ? 'rotate-0' : '-rotate-90'" class="transition-all"
                    name="chevron-down-outline"></ion-icon>
                <div>Data Transaksi</div>
            </div>
            <div x-show="open" x-transition class="mx-5 border-t border-slate-200 pb-5">
                <div class="mt-10 grid text-sm grid-cols-2 gap-[110px]">
                    <div>
                        <div class="flex justify-between">
                            <div class="font-medium">Tanggal Pembelian</div>
                            <input id="purchase_date" name="purchase_date" type="text"
                                class="py-2 px-4 outline-none border-slate-200 border w-[255px] rounded"
                                value="{{ old('purchase_date') ?? Carbon\Carbon::now()->format('Y-m-d') }}">
                        </div>
                        <div class="flex justify-between mt-7">
                            <div class="font-medium">Kode Pembelian</div>
                            <input id="code" name="code" type="text"
                                class="py-2 px-4 outline-none border-slate-200 border w-[255px] rounded"
                                value="{{ old('code') ?? 0 }}">
                        </div>
                        <div class="flex justify-between mt-7">
                            <div class="font-medium">Beneficiary's Bank</div>
                            <input id="beneficiary_bank" name="beneficiary_bank" type="text"
                                class="py-2 px-4 outline-none border-slate-200 border w-[255px] rounded"
                                value="{{ old('beneficiary_bank') ?? 0 }}">
                        </div>
                        <div class="flex justify-between mt-7">
                            <div class="font-medium">Bank Address</div>
                            <input id="bank_address" name="bank_address" type="text"
                                class="py-2 px-4 outline-none border-slate-200 border w-[255px] rounded"
                                value="{{ old('bank_address') ?? 0 }}">
                        </div>
                        <div class="flex justify-between mt-7">
                            <div class="font-medium">Beneficiary Name</div>
                            <input id="beneficiary_name" name="beneficiary_name" type="text"
                                class="py-2 px-4 outline-none border-slate-200 border w-[255px] rounded"
                                value="{{ old('beneficiary_name') ?? 0 }}">
                        </div>
                        <div class="flex justify-between mt-7">
                            <div class="font-medium">Phone</div>
                            <input id="phone" name="phone" type="text"
                                class="py-2 px-4 outline-none border-slate-200 border w-[255px] rounded"
                                value="{{ old('phone') ?? 0 }}">
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between">
                            <div class="font-medium">Tanggal Jatuh Tempo</div>
                            <input id="due_date" name="due_date" type="text"
                                class="py-2 px-4 outline-none border-slate-200 border w-[255px] rounded"
                                value="{{ old('due_date') ?? Carbon\Carbon::now()->format('Y-m-d') }}">
                        </div>
                        <div class="flex justify-between mt-7">
                            <div class="font-medium">Metode Pembayaran</div>
                            <input id="method" name="method" type="text"
                                class="py-2 px-4 outline-none border-slate-200 border w-[255px] rounded"
                                value="{{ old('method') ?? 0 }}">
                        </div>
                        <div class="flex justify-between mt-7">
                            <div class="font-medium">Beneficiary A/C USD</div>
                            <input id="beneficiary_ac_usd" name="beneficiary_ac_usd" type="text"
                                class="py-2 px-4 outline-none border-slate-200 border w-[255px] rounded"
                                value="{{ old('bank_address') ?? 0 }}">
                        </div>
                        <div class="flex justify-between mt-7">
                            <div class="font-medium">Swift Code</div>
                            <input id="swift_code" name="swift_code" type="text"
                                class="py-2 px-4 outline-none border-slate-200 border w-[255px] rounded"
                                value="{{ old('swift_code') ?? 0 }}">
                        </div>
                        <div class="flex justify-between mt-7">
                            <div class="font-medium">Beneficiary's Address</div>
                            <input id="beneficiary_address" name="beneficiary_address" type="text"
                                class="py-2 px-4 outline-none border-slate-200 border w-[255px] rounded"
                                value="{{ old('beneficiary_address') ?? 0 }}">
                        </div>
                        <div class="flex justify-between mt-7">
                            <div class="font-medium">Lokasi Pengiriman</div>
                            <textarea name="location" id="location" cols="30" rows="10"
                                class="py-2 px-4 outline-none border-slate-200 border w-[255px] rounded">{{ old('location') ?? 0 }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div x-data="{ open: true }" class="mt-5 bg-white rounded-lg w-full">
            <div x-on:click="open = !open"
                class="p-5 cursor-pointer active:bg-gray-50 transition-all items-center font-medium flex gap-5">
                <ion-icon :class="open ? 'rotate-0' : '-rotate-90'" class="transition-all"
                    name="chevron-down-outline"></ion-icon>
                <div>Data Supplier</div>
            </div>
            <div x-show="open" x-transition class="mx-5 border-t border-slate-200 pb-5">
                <div class="mt-10 grid text-sm grid-cols-2 gap-[110px]">
                    <div>
                        <div class="flex justify-between">
                            <div class="font-medium">Nama Supplier</div>
                            <div class="w-[255px]">
                                <x-select x-on:click="getSupplier()" :dataLists="$suppliers->toArray()" :name="'supplier_id'" :id="'supplier_id'"
                                    :value="old('supplier_id')" :new="'newSupplierModal()'" />
                                @error('supplier_id')
                                    <div class="mt-1 text-xs text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex justify-between mt-7">
                            <div class="font-medium">Informasi Supplier</div>
                            <input id="supplier_email" name="supplier_email" type="text"
                                class="py-2 px-4 outline-none border-slate-200 border w-[255px] bg-gray-100 rounded"
                                placeholder="Email" readonly>
                        </div>
                        <div class="flex justify-between mt-7">
                            <div></div>
                            <input id="supplier_phone" name="supplier_phone" type="text"
                                class="py-2 px-4 outline-none border-slate-200 border w-[255px] bg-gray-100 rounded"
                                placeholder="No Hp" readonly>
                        </div>
                        <div class="flex justify-between mt-7">
                            <div></div>
                            <textarea name="supplier_address" id="supplier_address" cols="30" rows="10"
                                class="py-2 px-4 outline-none border-slate-200 border w-[255px] bg-gray-100 rounded" placeholder="Alamat"
                                readonly></textarea>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div x-data="{ open: true }" class="mt-5 bg-white rounded-lg w-full">
            <div x-on:click="open = !open"
                class="p-5 cursor-pointer active:bg-gray-50 transition-all items-center font-medium flex gap-5">
                <ion-icon :class="open ? 'rotate-0' : '-rotate-90'" class="transition-all"
                    name="chevron-down-outline"></ion-icon>
                <div>Data Keranjang</div>
            </div>
            <div x-show="open" x-transition class="mx-5 border-t border-slate-200 pb-5 text-sm">
                <div class="mt-10 flex justify-between">
                    <div class="font-medium">Komponen</div>
                    <div>
                        <table class="w-[790px] table-fixed mb-2">
                            <thead>
                                <tr class="bg-gray-100 border border-gray-200">
                                    <th class="py-3 font-medium text-start w-14"></th>
                                    <th class="py-3 font-medium text-start w-[255px]">Nama</th>
                                    <th class="py-3 font-medium text-start w-[75px]">Jumlah</th>
                                    <th class="py-3 font-medium text-start w-16">Unit</th>
                                    <th class="py-3 font-medium text-start">Harga</th>
                                    <th class="py-3 font-medium text-start">Subtotal</th>
                                    <th class="py-3 font-medium text-start w-14"></th>
                                </tr>
                            </thead>

                            <tbody id="table-component">
                                @if (old('component_id', []))
                                    @foreach (old('component_id', []) as $index => $cp)
                                        <tr x-data="{ component: $el }" class="border-x border-b border-gray-200">
                                            <td id="number-component" class="py-3 text-center"></td>
                                            <td class="py-3 pr-5">
                                                <x-select
                                                    x-on:click="getComponent(component); await $nextTick(); set_subtotal($refs.quantity)"
                                                    :dataLists="$components->toArray()" :name="'component_id[]'" :id="'component_id'" :new="'newComponentModal(component); await $nextTick(); setSupplier();'"
                                                    :value="$cp" />
                                                @error('component_id.' . $index)
                                                    <div class="mt-1 text-xs text-red-400">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td class="py-3 pr-5">
                                                <input x-ref="quantity" x-init="getComponent(cp);
                                                await $nextTick();
                                                set_subtotal($refs.quantity)" type="number"
                                                    name="quantity[]" oninput="set_subtotal(this)"
                                                    value="{{ old('quantity', [])[$index] }}" step="0.0001"
                                                    class="p-2 outline-none border-slate-200 border w-full rounded">
                                                @error('quantity.' . $index)
                                                    <div class="mt-1 text-xs text-red-400">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td id="unit" class="py-3 pr-5"></td>
                                            <td id="price" class="py-2"></td>
                                            <td id="subtotal" class="py-2"></td>
                                            <td class="py-2">
                                                <button type="button"
                                                    x-on:click="component.remove(); set_total(); set_number_component()">
                                                    <ion-icon class="text-xl text-gray-400 hover:opacity-70"
                                                        name="trash-outline"></ion-icon>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                        <button x-data
                            x-on:click="addNewComponent(); set_number_component(); await $nextTick(); setKomponen()"
                            class="w-full py-3 rounded-xl border-2 border-dashed border-gray-300 font-medium flex items-center justify-center gap-3 hover:bg-gray-100 active:bg-gray-200 transition-all"
                            type="button">
                            <ion-icon class="text-lg" name="add-outline"></ion-icon>
                            Tambah Komponen Baru
                        </button>
                    </div>
                </div>

                <div class="mt-7 flex justify-between">
                    <div class="font-medium">Produk</div>
                    <div>
                        <table class="w-[790px] table-fixed mb-2">
                            <thead>
                                <tr class="bg-gray-100 border border-gray-200">
                                    <th class="py-3 font-medium text-start w-14"></th>
                                    <th class="py-3 font-medium text-start w-[255px]">Nama</th>
                                    <th class="py-3 font-medium text-start w-[75px]">Jumlah</th>
                                    <th class="py-3 font-medium text-start">Harga</th>
                                    <th class="py-3 font-medium text-start">Subtotal</th>
                                    <th class="py-3 font-medium text-start w-14"></th>
                                </tr>
                            </thead>
                            <tbody id="table-product">
                                @if (old('product_id', []))
                                    @foreach (old('product_id', []) as $index => $product)
                                        <tr x-data="{ product: $el }" class="border-x border-b border-gray-200">
                                            <td id="number-product" class="py-3 text-center"></td>
                                            <td class="py-3 pr-5">
                                                <x-select x-on:click="getProduct(product); await $nextTick(); setProduk();"
                                                    :dataLists="$products->toArray()" :value="$product" :name="'product_id[]'"
                                                    :id="'product_id'" :new="'newProductModal(product); await $nextTick(); setSupplierListInProduct(); setComponentListInProduct(); setFilepond()'" />
                                                @error('product_id.' . $index)
                                                    <div class="mt-1 text-xs text-red-400">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td class="py-3 pr-5">
                                                <input type="number" name="quantity_product[]"
                                                    value="{{ old('quantity_product', [])[$index] }}"
                                                    x-init="getProduct(product);
                                                    await $nextTick();
                                                    subTotalProduk($refs.quantity)" oninput="subTotalProduk(this)" step="1"
                                                    class="p-2 outline-none border-slate-200 border w-full rounded">
                                                @error('quantity_product.' . $index)
                                                    <div class="mt-1 text-xs text-red-400">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td id="price" class="py-3"></td>
                                            <td id="subtotal" class="py-3"></td>
                                            <td class="py-3">
                                                <button type="button"
                                                    x-on:click="product.remove(); set_total(); set_number_product()">
                                                    <ion-icon class="text-xl text-gray-400"
                                                        name="trash-outline"></ion-icon>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                        <button x-data x-on:click="addNewProduct(); set_number_product(); await $nextTick(); setProduk()"
                            class="w-full py-3 rounded-xl border-2 border-dashed border-gray-300 font-medium flex items-center justify-center gap-3 hover:bg-gray-100 active:bg-gray-200 transition-all"
                            type="button">
                            <ion-icon class="text-lg" name="add-outline"></ion-icon>
                            Tambah Produk Baru
                        </button>
                    </div>
                </div>

                <div class="mt-7 flex gap-[120px]">
                    <div class="font-medium">Total Biaya</div>
                    <div>
                        <table class="w-96 table-fixed mb-2">
                            <thead>
                                <tr class="bg-gray-100 border border-gray-200">
                                    <th class="p-3 font-medium text-start">Total</th>
                                    <th class="py-3 font-medium text-start">Bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-x border-b border-gray-200">
                                    <td class="p-3">
                                        <input id="total_bill" name="total_bill" type="number"
                                            class="p-2 outline-none border-slate-200 border w-full rounded"
                                            placeholder="Total Bayar" readonly>
                                    </td>
                                    <td class="p-3">
                                        <input id="paid" name="paid" type="number"
                                            class="p-2 outline-none border-slate-200 border w-full rounded"
                                            placeholder="Bayar" value="old('paid') ?? 0" oninput="batasBayar(this)">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full flex justify-end gap-5 mt-7 text-sm font-medium">
            <a href="/purchases">
                <button type="button"
                    class="w-[208px] py-3 border border-gray-200 hover:bg-[#064E3B]/10 active:bg-[#064E3B]/20 transition-all hover:text-[#064E3B] rounded-md text-gray-600">Batalkan</button>
            </a>
            <button type="submit"
                class="w-[208px] py-3 bg-[#064E3B] hover:bg-[#064E3B]/90 active:bg-[#064E3B]/80 transition-all rounded-md text-gray-200">Simpan</button>
        </div>
    </form>
@endsection
@push('script')
    <script>
        let products = {!! $products !!}
        let components = {!! $components !!};
        let suppliers = {!! $suppliers !!}

        let selectedProduct = {}
        let componentsSelected = {}
        let suppliersSelected = {}

        // products.forEach(p => selectedProduct[p.id] = p.name)
        // components.forEach(c => componentsSelected[c.id] = c.name)


        // setProduk();
        // setKomponen();
        set_number_product();
        set_number_component();

        function addNewSupplier() {
            const tableBody = document.getElementById('table-body');
            const tableRow = document.createElement('tr');
            tableRow.setAttribute('x-data', '{ supplier: $el }')
            tableRow.className = 'border-b';
            tableRow.innerHTML = `
                                        <td id="modal-supplier-number" class="p-2 text-center"></td>
                                        <td class="p-2">
                                            <x-select x-on:click="$nextTick();" :dataLists="$suppliers->toArray()" :name="'supplier_id[]'" :id="'supplier_id_component'" />
                                        </td>
                                        <td class="p-2">
                                            <x-input-with-desc :desc="'Rp'" :name="'price_supplier_component[]'" :type="'number'" :placeholder="'1000'" class="price_supplier_component" />
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

        function supplierDeleteBtnToggle() {
            const deleteBtn = document.querySelectorAll('.supplier-delete-btn')
            if (deleteBtn.length == 1) {
                deleteBtn[0].style.display = "none"
            } else {
                deleteBtn.forEach(btn => btn.style.display = 'block')
            }
        }

        function subTotalProduk(e) {
            console.log(e)
            const tr = e.parentElement.parentElement;
            const price = tr.querySelector('#price').innerText.replace(/[^0-9\.,]/g, '').replace(/\./g, '').replace(',',
                '.');
            const subtotal = tr.querySelector('#subtotal');
            subtotal.innerText = toRupiah(price * e.value);
            console.log(subtotal)
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
            console.log('selectedProduct', selectedProduct)
            document.querySelectorAll(".product_id").forEach(element => {
                element._x_dataStack[0].list = selectedProduct
            })
        }

        function setKomponen() {
            console.log('componentsSelected', componentsSelected)
            document.querySelectorAll(".component_id").forEach(element => {
                element._x_dataStack[0].list = componentsSelected
            })
        }

        function setSupplier() {
            document.querySelectorAll('.supplier_id_component').forEach(element => {
                // console.log(e._x_dataStack[0].list)
                // console.log(element._x_dataStack)
                element._x_dataStack[0].list = suppliersSelected
            })
        }

        function getSupplier() {
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
                selectedProduct = {}

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
            console.log('tableComponent', tableComponent)
            const componentRow = document.createElement('tr');
            componentRow.setAttribute('x-data', '{ component: $el }')
            componentRow.className = 'border-x border-b border-gray-200';
            componentRow.innerHTML = `
                                        <td id="number-component" class="py-3 text-center"></td>
                                        <td class="py-3 pr-5">
                                            <x-select x-on:click="getComponent(component); await $nextTick(); set_subtotal($refs.quantity);" :dataLists="$components->toArray()"
                                                :name="'component_id[]'" :id="'component_id'" :new="'newComponentModal(component); await $nextTick(); setSupplier();'" />
                                        </td>
                                        <td class="py-3 pr-5">
                                            <input x-ref="quantity" type="number" name="quantity[]"
                                                oninput="set_subtotal(this)" value="0" step="0.0001"
                                                class="p-2 outline-none border-slate-200 border w-full rounded">
                                        </td>
                                        <td id="unit" class="py-3 pr-5"></td>
                                        <td id="price" class="py-2"></td>
                                        <td id="subtotal" class="py-2"></td>
                                        <td class="py-2">
                                            <button type="button" x-on:click="component.remove(); set_total(); set_number_component()">
                                                <ion-icon class="text-xl text-gray-400 hover:opacity-70" name="trash-outline"></ion-icon>
                                            </button>
                                        </td>
                                    `;

            tableComponent.appendChild(componentRow);
        }

        function addNewProduct() {
            const tableProduct = document.getElementById('table-product');
            const productRow = document.createElement('tr');
            productRow.setAttribute('x-data', '{ product: $el }')
            productRow.className = 'border-x border-b border-gray-200';
            productRow.innerHTML = `
                                        <td id="number-product" class="py-3 text-center"></td>
                                        <td class="py-3 pr-5">
                                            <x-select x-on:click="getProduct(product); await $nextTick(); setProduk();"  x-init="await $nextTick(); setProduk();" :dataLists="$products->toArray()"
                                                :name="'product_id[]'" :id="'product_id'" :new="'newProductModal(product); await $nextTick(); setSupplierListInProduct(); setComponentListInProduct(); setFilepond()'" />
                                        </td>
                                        <td class="py-3 pr-5">
                                            <input type="number" name="quantity_product[]"
                                                oninput="subTotalProduk(this)" value="0" step="1"
                                                class="p-2 outline-none border-slate-200 border w-full rounded">
                                        </td>
                                        <td id="price" class="py-3"></td>
                                        <td id="subtotal" class="py-3"></td>
                                        <td class="py-3">
                                            <button type="button" x-on:click="product.remove(); set_total(); set_number_product()">
                                                <ion-icon class="text-xl text-gray-400" name="trash-outline"></ion-icon>
                                            </button>
                                        </td>
                                    `;

            tableProduct.appendChild(productRow);
        }

        function set_subtotal(element) {
            element.value < 0 ? element.value = 0 : element.value;
            console.log(element)
            let tr = element.parentElement.parentElement;
            let price = tr.querySelector('#price').textContent.replace(/[^0-9\.,]/g, '').replace(/\./g,
                '').replace(',', '.');
            let subtotal = tr.querySelector('#subtotal');
            subtotal.textContent = toRupiah(price * element.value);
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
                                            <x-select x-on:click="getComponentProduct(component); set_subtotal_product($refs.quantity)" :dataLists="$components->toArray()"
                                                :name="'component_id[]'" :id="'component_id'" />
                                        </td>
                                        <td class="p-2">
                                            <input id="quantity" step="0.001" x-ref="quantity" type="number" name="quantity[]"
                                                oninput="set_subtotal_product(this)" value=""
                                                class="w-20 px-2 py-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300">
                                        </td>
                                        <td id="unit-product-modal" class="p-2"></td>
                                        <td id="price-product-modal" class="p-2"></td>
                                        <td id="subtotal-product-modal" class="p-2"></td>
                                        <td id="comp" class="p-2">
                                            <button type="button" x-on:click="component.remove(); set_total(); set_number_component_product();"
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
                                            x-on:click="supplier.remove(); set_total(); set_number_supplier_product();"
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

        function newSupplierModal() {
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
                        <button id="create-supplier" type="button" onclick="createSupplier()" onmouseover="toggleSupplierSaveButtonState()"
                        class="py-2 px-5 border text-[#F7F9F9] text-sm rounded-lg bg-[#064e3be1] flex items-center justify-center gap-3">Simpan <span class="hidden loading loading-spinner loading-sm"></span></button>
                </div>
            </div>`
        }

        function newComponentModal(componentRow) {
            const modal = document.querySelector('#modal');
            document.querySelector('#modal-background').classList.remove('hidden');

            modal.classList.remove('opacity-0', '-z-40');
            modal.classList.add('opacity-100', 'z-40');

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
                                 oninput="toggleComponentSaveButtonState()" />
                        </div>
                        <div class="flex-none">
                            <x-input :name="'component_unit'" :label="'Unit'" :placeholder="'m'"  oninput="toggleComponentSaveButtonState()" />
                        </div>
                    </div>
                    <div class="flex w-full gap-3 my-3">
                        <div class="flex-1">
                            <x-input-with-desc :desc="'Rp'" :name="'price_per_unit'" :type="'number'"
                                :label="'Harga Per Unit'" :placeholder="'1000'"  oninput="toggleComponentSaveButtonState()" />
                        </div>
                        <div class="flex-initial w-64">
                            <label for="category_id" class="block text-sm mb-2">Kategori</label>
                            <x-select :dataLists="$categories->toArray()" :name="'category_id'" :id="'category_id'" />
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
                                    <x-select :dataLists="$suppliers->toArray()" :name="'supplier_id[]'"
                                        :id="'supplier_id_component'" />
                                </td>
                                <td class="p-2">
                                    <x-input-with-desc :desc="'Rp'" :name="'price_supplier_component[]'" :type="'number'" class="price_supplier_component"
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
                    <button id="create-component" type="button" onmouseover="toggleComponentSaveButtonState()"
                        class="py-2 px-5 border text-[#F7F9F9] text-sm rounded-lg bg-[#064e3be1] flex items-center justify-center gap-3">Simpan <span class="hidden loading loading-spinner loading-sm"></span></button>
                </div>
            </div>`

            document.getElementById('create-component').addEventListener('click', () => {
                createComponent(componentRow)
            })

            suppliers.forEach(e => {
                suppliersSelected[e.id] = e.name
            })

            set_modal_supplier_number();
            supplierDeleteBtnToggle();
        }

        function newProductModal(productRow) {
            const modal = document.querySelector('#modal');
            document.querySelector('#modal-background').classList.remove('hidden');

            modal.classList.remove('opacity-0', '-z-40');
            modal.classList.add('opacity-100', 'z-40');

            modal.innerHTML = `<div class="w-[1300px] bg-white h-fit rounded-xl pb-20 relative">
                <div
                    class="py-[20px] px-[30px] w-full relative border-b-2 border-gray-200 flex justify-between items-center">
                    <div class="text-xl font-bold">Tambah Produk Baru</div>
                    <div onclick="hideModal()"
                        class="absolute flex items-center p-1 text-2xl rounded-full cursor-pointer right-5 hover:bg-slate-100">
                        <ion-icon name="close-outline"></ion-icon>
                    </div>
                </div>

                <div class="px-[30px] pt-[20px] h-[400px] overflow-y-scroll overscroll-contain">
                    <div class="flex w-full">
                        <div>
                            <h1 class="mb-3 text-xl font-bold">Komponen</h1>
    
                            <table class="w-full text-sm text-left table-fixed">
                                <thead>
                                    <tr class="border-b-2">
                                        <th class="w-10 p-2 text-center">#</th>
                                        <th class="w-40 p-2">Komponen</th>
                                        <th class="w-24 p-2">Jumlah</th>
                                        <th class="p-2 w-14">Unit</th>
                                        <th class="p-2">Harga</th>
                                        <th class="p-2">Subtotal</th>
                                        <th class="w-20 p-2"></th>
                                    </tr>
                                </thead>
                                <tbody id="table-component-product">
    
                                    <tr x-data="{ component: $el }" class="border-b">
                                        <td id="number-component-product" class="p-2 text-center"></td>
                                        <td class="w-40 p-2">
                                            <x-select x-on:click="getComponentProduct(component); set_subtotal_product()" :dataLists="$components->toArray()"
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
                                                x-on:click="component.remove(); await $nextTick; set_total(); set_number_component_product();"
                                                class="transition-all duration-300 rounded-full comp-delete-btn-product hover:bg-slate-100 active:bg-slate-200"><span
                                                    class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                                        </td>
                                    </tr>
    
                                </tbody>
                            </table>
    
                            <button type="button" x-data
                                x-on:click="addNewComponentProduct(); set_number_component_product(); await $nextTick(); setComponentListInProduct() "
                                class="flex justify-center w-full py-2 text-sm transition duration-300 border-b border-dashed border-x hover:bg-slate-50 active:bg-sky-100">Tambah
                                Data Baru</button>
    
                            <h1 class="mt-5 mb-3 text-xl font-bold">Pemasok</h1>
    
                            <table class="w-full mt-5 text-sm text-left table-fixed">
                                <thead>
                                    <tr class="border-b-2">
                                        <th class="w-10 p-2 text-center">#</th>
                                        <th class="p-2 w-60">Pemasok</th>
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
                                                x-on:click="supplier.remove(); set_total(); set_number_supplier_product();"
                                                class="transition-all duration-300 rounded-full supplier-delete-btn-product hover:bg-slate-100 active:bg-slate-200"><span
                                                    class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
    
                            <button type="button" x-data
                                x-on:click="addNewSupplierProduct(); set_number_supplier_product(); await $nextTick(); setSupplierListInProduct(); "
                                class="flex justify-center w-full py-2 text-sm transition duration-300 border-b border-dashed border-x hover:bg-slate-50 active:bg-sky-100">Add
                                New</button>
                        </div>
                    
                        <div class="divider divider-horizontal"></div>

                        <div class="flex-none w-80">
                            <h1 class="mb-3 text-xl font-bold">Gambar Produk</h1>
                            <div
                                class="outline-dashed relative bg-[#F1F0EF] outline-gray-200 outline-2 rounded-lg after:bg-white after:w-40 after:h-5 after:absolute after:right-0 after:-bottom-6 ">
                                <input type="file" name="product_image" />
                            </div>
                        </div>
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
                        class="py-2 px-5 border text-[#F7F9F9] text-sm rounded-lg bg-[#064e3be1] flex items-center justify-center gap-3">Simpan <span class="hidden loading loading-spinner loading-sm"></span></button>
                    </div>
                </div>
            </div>`

            document.getElementById('create-product').addEventListener('click', () => {
                createProduct(productRow)
            })

            set_number_supplier_product();
            set_number_component_product();
        }

        async function createComponent(componentRow) {
            const name = document.getElementById('component_name').value
            const unit = document.getElementById('component_unit').value
            const price_per_unit = document.getElementById('price_per_unit').value
            const category_id = document.getElementById('category_id').value
            const supplier_id = Array.from(document.querySelectorAll('#supplier_id_component')).map(e => e.value)
            const price_supplier = Array.from(document.querySelectorAll('.price_supplier_component')).map(e => e
                .value)

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
                        price_supplier,
                        category_id
                    })
                })

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                components = await response.json(); // Mengambil data JSON dari respons

                const supplierId = document.querySelector("#supplier_id").value
                const componentId = componentRow.querySelector('#component_id')
                const componentClass = componentRow.querySelector('.component_id')
                componentsSelected = {}

                // ngecek apakah komponen yang baru dimasukin memiliki pemasok yang sama dengan pemasok yang dipilih
                if (components[components.length - 1].suppliers.find(s => s.id == supplierId)) {
                    // ngambil semua komponen yang sesuai dengan pemasok yang dipilih
                    const supplierComponent = components.filter(comp => comp.suppliers.find(suppl => suppl.id ==
                        supplierId))

                    supplierComponent.forEach(e => {
                        componentsSelected[e.id] = e.name
                    })

                    componentClass._x_dataStack[0].selectedkey = components[components.length - 1].id
                    componentClass._x_dataStack[0].selectedlabel = components[components.length - 1].name
                    componentId.value = components[components.length - 1].id

                    setKomponen()
                }
                getComponent(componentRow)

                toastr.success(`${name} berhasil ditambahkan ke Komponen`)
                loading.classList.add('hidden')
                hideModal()
            } catch (error) {
                console.error('Terjadi kesalahan', error)
            }
        }

        async function createSupplier() {
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
                const supplierId = document.getElementById("supplier_id")
                const supplierClass = document.querySelector('.supplier_id')

                let responseBaru = {}

                suppliers.forEach(e => {
                    responseBaru[e.id] = e.name
                })

                supplierClass._x_dataStack[0].list = responseBaru
                supplierClass._x_dataStack[0].selectedkey = suppliers[suppliers.length - 1].id
                supplierClass._x_dataStack[0].selectedlabel = suppliers[suppliers.length - 1].name
                supplierId.value = suppliers[suppliers.length - 1].id

                getSupplier()

                toastr.success(`${name} berhasil ditambahkan ke Supplier`)
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

            console.log('component_id', component_id)
            console.log('quantity', quantity)

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

                products = await response.json();

                if (!response.ok) {
                    throw products;
                }

                if (products.rfid || products.code) throw products;

                const supplierId = document.querySelector("#supplier_id").value
                const productId = productRow.querySelector('#product_id')
                const productClass = productRow.querySelector('.product_id')
                selectedProduct = {}

                // ngecek apakah produk yang baru dimasukin memiliki pemasok yang sama dengan pemasok yang dipilih
                if (products[products.length - 1].suppliers.find(s => s.id == supplierId)) {
                    // ngambil semua produk yang sesuai dengan pemasok yang dipilih
                    const supplierProduct = products.filter(prod => prod.suppliers.find(suppl => suppl.id ==
                        supplierId))

                    supplierProduct.forEach(e => {
                        selectedProduct[e.id] = e.name
                    })

                    productClass._x_dataStack[0].selectedkey = products[products.length - 1].id
                    productClass._x_dataStack[0].selectedlabel = products[products.length - 1].name
                    productId.value = products[products.length - 1].id

                    setProduk()
                }

                getProduct(productRow)

                toastr.success(`${name} berhasil ditambahkan ke Produk`)
                loading.classList.add('hidden')
                hideModal()
            } catch (error) {
                console.error(error.message)
                loading.classList.add('hidden')
                modal.querySelector('#rfid-error').innerHTML = error.errors.rfid || ''
                modal.querySelector('#code-error').innerHTML = error.errors.code || ''
            }
        }

        function toggleComponentSaveButtonState() {
            const name = document.getElementById('component_name').value
            const unit = document.getElementById('component_unit').value
            const price_per_unit = document.getElementById('price_per_unit').value
            const supplier_id = Array.from(document.querySelectorAll('#supplier_id_component')).map(e => e.value)
            const price_supplier = Array.from(document.querySelectorAll('.price_supplier_component')).map(e => e
                .value)
            const saveButton = document.getElementById('create-component')

            if (name && unit && price_supplier[0] && price_per_unit && supplier_id[0]) {
                console.log('boleh save')
                saveButton.disabled = false
                saveButton.style.cursor = 'pointer'
            } else {
                console.log('gk boleh save')
                saveButton.disabled = true
                saveButton.style.cursor = "not-allowed"
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

            const productsList = [
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
            const x = (component_id && quantity[0]) || (supplier_id && price_supplier[0])

            if (save && x) {
                saveButton.disabled = false
                saveButton.style.cursor = 'pointer'
            } else {
                saveButton.disabled = true
                saveButton.style.cursor = "not-allowed"
            }
        }

        function setComponentListInProduct() {
            const modal = document.querySelector('#modal')
            let componentList = {}

            components.forEach(c => componentList[c.id] = c.name)

            modal.querySelectorAll('.component_id').forEach(e => {
                e._x_dataStack[0].list = componentList
            })
        }

        function setSupplierListInProduct() {
            const modal = document.querySelector('#modal')
            let supplierList = {}

            suppliers.forEach(s => supplierList[s.id] = s.name)

            modal.querySelectorAll('.supplier_id').forEach(e => {
                e._x_dataStack[0].list = supplierList
            })
        }
    </script>
@endpush
