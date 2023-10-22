@extends('layouts.layout')

@section('content')
    <x-edit-input-field :action="'productions'" :items="$production" :width="'w-full'">
        <h1 class="mb-3 text-xl font-bold">Product</h1>

        <div class="flex w-full gap-3">
            <div class="flex-1">
                <x-input :value="$production->code" :label="'Kode Produksi'" :name="'code'" readonly />
            </div>
            <div class="flex-1">
                <x-input :value="$production->product->name" :label="'Nama Produk'" :name="'product_name'" readonly />
            </div>
        </div>
        <div class="flex w-full gap-3 my-3">
            <div class="flex-1">
                <x-input :value="$production->total_quantity" :label="'Total Produksi'" :name="'total_production'" readonly />
            </div>
        </div>
        <div class="flex w-full gap-3 my-3">
            <div class="flex-1">
                <label for="quantity_finished" class="block text-sm">Jumlah Sudah Selesai</label>
                <input type="number" value="{{ $production->quantity_finished }}" name="quantity_finished"
                    oninput="set_finished(this)" value="0" id="quantity_finished"
                    class="w-full px-3 py-2 mt-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300">
            </div>
            <div class="flex-1">
                <x-input :value="$production->quantity_not_finished" :label="'Jumlah Belum Selesai'" :name="'quantity_not_finished'" readonly />
            </div>
        </div>
        <h1 class="text-lg font my-7 font-[500]">Create Purchases</h1>
        <div class="flex gap-5 text-sm">
            <div>
                <label for="purchase_date" class="block text-sm">Tanggal Pembelian</label>
                <x-input type="date" :name="'purchase_date'" :inputParentClass="'mb-3'" :value="old('purchase_date')" />

                <label for="due_date" class="block text-sm">Tanggal Jatuh Tempo</label>
                <x-input type="date" :name="'due_date'" :inputParentClass="'mb-3'" :value="old('due_date')" />

                <label for="supplier_id" class="block text-sm">Pemasok</label>
                <div class="w-40 mt-2 mb-3">
                    <x-select x-on:click="getSupplier; await $nextTick();" :dataLists="$production->product->suppliers->toArray()" :name="'supplier_id'"
                        :id="'supplier_id'" />
                </div>

                <x-input :name="'supplier_address'" :label="'Alamat Pemasok'" readonly class="mb-3 bg-slate-100" />

                <x-input :name="'supplier_email'" :label="'Email Pemasok'" readonly class="mb-3 bg-slate-100" />

                <x-input :name="'supplier_phone'" :label="'No Hp Pemasok'" readonly class="mb-3 bg-slate-100" />

                <x-input :name="'code'" :type="'text'" :label="'Kode Pembelian'" :inputParentClass="'mb-3'" :value="old('code')" />

                <x-input :name="'method'" :type="'text'" :label="'Metode Pembayaran'" :inputParentClass="'mb-3'" :value="old('method')" />

                <x-input :name="'beneficiary_bank'" :type="'text'" :label="'Beneficiary\'s Bank'" :inputParentClass="'mb-3'" :value="old('beneficiary_bank')" />

                <x-input :name="'beneficiary_ac_usd'" :type="'text'" :label="'Beneficiary A/C USD'" :inputParentClass="'mb-3'" :value="old('beneficiary_ac_usd')" />

                <x-input :name="'bank_address'" :type="'text'" :label="'Bank Address'" :inputParentClass="'mb-3'" :value="old('bank_address')" />

                <x-input :name="'swift_code'" :type="'text'" :label="'Swift Code'" :inputParentClass="'mb-3'" :value="old('swift_code')" />

                <x-input :name="'beneficiary_name'" :type="'text'" :label="'Beneificiary Name'" :inputParentClass="'mb-3'" :value="old('beneficiary_name')" />

                <x-input :name="'beneficiary_address'" :type="'text'" :label="'Beneficiary\'s Address'" :inputParentClass="'mb-3'" :value="old('beneficiary_address')" />

                <x-input :name="'phone'" :type="'text'" :label="'Phone'" :inputParentClass="'mb-3'" :value="old('phone')" />

                <div class="flex w-full gap-3 my-3">
                    <div class="flex-1">
                        <x-input-textarea :name="'location'" :label="'Lokasi Pengiriman'" :placeholder="'location'" :value="old('location')" />
                    </div>
                </div>
            </div>

            <div class="divider divider-horizontal"></div>

            <div class="w-full">
                <h1 class="mt-5 mb-3 text-xl font-bold">Produk</h1>

                <table class="w-full text-left table-fixed">
                    <thead>
                        <tr class="border-b-2">
                            <th class="p-2">Produk</th>
                            <th class="w-20 p-2">Jumlah</th>
                            <th class="p-2">Harga</th>
                            <th class="p-2">Subtotal</th>
                            <th class="w-20 p-2"></th>
                        </tr>
                    </thead>
                    <tbody id="table-product">
                        <tr>
                            <td>{{ $production->product->name }}</td>
                            <td>
                                <input type="number" name="quantity_purchase" id="quantity_purchase"
                                    oninput="setSubtotal(this)" max="{{ $production->quantity_not_finished }}"
                                    min="0" readonly
                                    class="w-full px-3 py-2 mt-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300">
                            </td>
                            <td>
                                <input type="number" id="price_purchase" readonly
                                    class="w-full px-3 py-2 mt-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300 bg-slate-100">
                            </td>
                            <td id="subtotal"></td>
                        </tr>
                    </tbody>
                </table>

                <div class="flex justify-end gap-3 mt-10">
                    <div class="w-40">
                        <x-input :label="'Total'" :name="'total_bill'" :placeholder="'Total Bayar'" :type="'number'" readonly />
                    </div>
                    <div class="w-40">
                        <x-input :label="'Bayar'" :name="'paid'" :placeholder="'Bayar'" :type="'number'"
                            :value="old('paid') ?? 0" oninput="batasBayar(this)" />
                    </div>
                </div>
            </div>
        </div>
    </x-edit-input-field>
@endsection
@push('script')
    <script>
        let production = @json($production)

        function getSupplier() {
            let suppliers = {!! $production->product->suppliers !!}
            console.log(suppliers)
            const supplierId = document.getElementById('supplier_id')
            const supplier = suppliers.find(supplier => supplier.id == supplierId.value)

            if (supplier) {
                document.getElementById('supplier_address').value = supplier.address;
                document.getElementById('supplier_email').value = supplier.email;
                document.getElementById('supplier_phone').value = supplier.phone;
                document.getElementById("price_purchase").value = supplier.pivot.price_per_unit
                document.getElementById("quantity_purchase").removeAttribute('readonly')
            } else {
                document.getElementById('supplier_address').value = '';
                document.getElementById('supplier_email').value = '';
                document.getElementById('supplier_phone').value = '';
                document.getElementById("price_purchase").value = 0
                document.getElementById("quantity_purchase").setAttribute('readonly', true)
                document.getElementById("quantity_purchase").value = 0
                document.getElementById("subtotal").innerHTML = 0
                document.getElementById("total_bill").value = 0
                document.getElementById("paid").value = 0
            }
        }

        function batasBayar(element) {
            const total = parseInt(document.getElementById('total_bill').value)
            const paid = parseInt(element.value)
            if (element.value === '') {
                element.value = 0
            } else if (element.value === '0') {
                element.value = ""
            }
            if (paid > total) {
                element.value = total
            } else if (paid < 0) {
                element.value = 0
            }
        }

        function setSubtotal(element) {
            if (parseInt(element.value) > parseInt(element.max)) {
                element.value = element.max
            } else if (parseInt(element.value) < 0) {
                element.value = 0
            }
            const price = document.getElementById('price_purchase').value
            const quantity = element.value
            const subtotal = price * quantity
            document.getElementById('subtotal').innerHTML = subtotal
            setTotal()
            document.getElementById('quantity_not_finished').value = parseInt(production.quantity_not_finished) - parseInt(
                element.value)
            document.getElementById("total_production").value = parseInt(production.total_quantity) - parseInt(element
                .value)
        }

        function setTotal() {
            const subtotals = document.getElementById("subtotal")
            document.getElementById('total_bill').value = subtotals.innerText
        }

        function set_finished(element) {
            if (element.value === '') {
                element.value = 0
            }
            const total = parseInt(production.sale.products.find(e => e.id == production.product_id).pivot.quantity)
            let quantity_finished = parseInt(element.value)
            let quantity_not_finished = total - quantity_finished
            console.log(quantity_finished)
            if (quantity_not_finished < 0) {
                quantity_not_finished = 0
                quantity_finished = total
                element.value = total
            }
            if (quantity_finished < 0) {
                quantity_not_finished = total
                quantity_finished = 0
                element.value = 0
            }

            document.getElementById('quantity_not_finished').value = quantity_not_finished
        }
    </script>
@endpush
