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
                <div class="w-40 mt-2 mb-3">
                    <x-select x-on:click="getCustomer" :dataLists="$customers->toArray()" :name="'customer_id'" :id="'customer_id'"
                        :value="old('customer_id') ?? 0" />
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
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b-2">
                            <th class="p-2">#</th>
                            <th class="p-2">Produk</th>
                            <th class="p-2">Jumlah</th>
                            <th class="p-2">Harga Per Produk</th>
                            <th class="p-2">Subtotal</th>
                            <th class="p-2"></th>
                        </tr>
                    </thead>
                    <tbody id="saleBody">
                        @if (old('product_id', []))
                            @foreach (old('product_id', []) as $index => $product)
                                <tr x-data="{ sale: $el }" class="border-b">
                                    <td id="number" class="p-2"></td>
                                    <td class="w-40 p-2">
                                        <x-select x-on:click="getProduct(sale); $nextTick(); set_subtotal($refs.quantity)"
                                            :dataLists="$products->toArray()" :name="'product_id[]'" :id="'product_id'" :value="$product" />
                                        @error('product_id.' . $index)
                                            <div class="mt-1 text-xs text-red-400">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td class="p-2"><input x-ref="quantity" type="number" name="quantity[]"
                                            oninput="set_subtotal(this)"
                                            class="w-16 px-2 py-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300"
                                            value="{{ old('quantity', [])[$index] }}">
                                        @error('quantity.' . $index)
                                            <div class="mt-1 text-xs text-red-400">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td id="price" class="p-"></td>
                                    <td id="subtotal" class="p-2"></td>
                                    <td class="p-2">
                                        <button type="button"
                                            x-on:click="sale.remove(); set_total(); set_number(); productDeleteBtnToggle()"
                                            class="transition-all duration-300 rounded-full hover:bg-slate-100 active:bg-slate-200 product-delete-btn"><span
                                                class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr x-data="{ sale: $el }" class="border-b">
                                <td id="number" class="p-2"></td>
                                <td class="w-40 p-2">
                                    <x-select x-on:click="getProduct(sale); $nextTick(); set_subtotal($refs.quantity)"
                                        :dataLists="$products->toArray()" :name="'product_id[]'" :id="'product_id'" />
                                </td>
                                <td class="p-2"><input x-ref="quantity" type="number" name="quantity[]"
                                        oninput="set_subtotal(this)"
                                        class="w-16 px-2 py-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300">
                                </td>
                                <td id="price" class="p-"></td>
                                <td id="subtotal" class="p-2"></td>
                                <td class="p-2">
                                    <button type="button"
                                        x-on:click="sale.remove(); set_total(); set_number(); productDeleteBtnToggle()"
                                        class="transition-all duration-300 rounded-full hover:bg-slate-100 active:bg-slate-200 product-delete-btn"><span
                                            class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                <button type="button" x-data x-on:click="addNew(); set_number(); productDeleteBtnToggle()"
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
        productDeleteBtnToggle()

        function getCustomer() {
            let customers = {!! $customers !!}
            const customerId = document.getElementById('customer_id')
            const customer = customers.find(customer => customer.id == customerId.value)
            // customers.forEach(customer => console.log(customer.id))
            // console.log(customer)
            if (customer) {
                const customerAddress = document.getElementById('customer_address').value = customer.address;
                const customerEmail = document.getElementById('customer_email').value = customer.email;
                const customerPhone = document.getElementById('customer_phone').value = customer.phone;

            } else {
                const customerAddress = document.getElementById('customer_address').value = '';
                const customerEmail = document.getElementById('customer_email').value = '';
                const customerPhone = document.getElementById('customer_phone').value = '';
            }
        }


        function getProduct(tr) {

            let products = {!! $products !!};
            const productId = tr.querySelector('#product_id');

            if (productId.value) {
                const product = products.find(product => product.id == productId.value)
                const price = tr.querySelector('#price').innerText = toRupiah(product.sell_price);
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
            const saleBody = document.getElementById('saleBody');
            const saleRow = document.createElement('tr');
            saleRow.setAttribute('x-data', '{ sale: $el }')
            saleRow.className = 'border-b';
            saleRow.innerHTML = `
                                    <td id="number" class="p-2"></td>
                                    <td class="w-40 p-2">
                                        <x-select x-on:click="getProduct(sale); $nextTick(); set_subtotal($refs.quantity)"
                                            :dataLists="$products->toArray()" :name="'product_id[]'" :id="'product_id'" />
                                    </td>
                                    <td class="p-2"><input x-ref="quantity" type="number" name="quantity[]"
                                            oninput="set_subtotal(this)" 
                                            class="w-16 px-2 py-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300">
                                    </td>
                                    <td id="price" class="p-2"></td>
                                    <td id="subtotal" class="p-2"></td>
                                    <td class="p-2">
                                        <button type="button" x-on:click="sale.remove(); set_total(); set_number(); productDeleteBtnToggle()"
                                            class="transition-all duration-300 rounded-full hover:bg-slate-100 active:bg-slate-200 product-delete-btn"><span
                                                class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                                    </td>
                                    `;

            saleBody.appendChild(saleRow);
        }

        function set_subtotal(element) {
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

                document.querySelector('#total_bill').value = total;
            })
        }

        function productDeleteBtnToggle() {
            const deleteBtn = document.querySelectorAll('.product-delete-btn')
            if (deleteBtn.length == 1) {
                deleteBtn[0].style.display = "none"
            } else {
                deleteBtn.forEach(btn => btn.style.display = 'block')
            }
        }
    </script>
@endpush
