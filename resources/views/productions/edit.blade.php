@extends('layouts.layout')

@section('content')
    <form action="/products/production/{{ $product->id }}" method="post">
        @csrf
        @method('put')
        <h1 class=" font-bold text-lg text-center my-8">Production Edit</h1>

        <div class="shadow rounded-lg w-full bg-white p-8 grid mb-8">
            <div class="flex items-center w-full gap-4">
                <div class="basis-1/3">
                    <x-input :label="'Nama Produk'" :name="'product_name'" :placeholder="'Nama Produk'" :value="$product->name" />
                </div>
                <div class="basis-1/3">
                    <x-input :label="'Jumlah Belum Selesai'" :name="'quantity_not_finished'" :placeholder="'Jumlah Belum Selesai'" :value="$product->production->quantity_not_finished" />
                </div>
                <div class="basis-1/3">
                    <x-input :label="'Jumlah Sudah Selesai'" :name="'quantity_finished'" :placeholder="'Jumlah Sudah Selesai'" :value="$product->production->quantity_finished" />
                </div>
            </div>
        </div>
        <h1 class="font-bold my-8 text-lg text-center">List Customer Butuh Produk</h1>
        <div class="w-full flex my-8">
            <table class="basis-full table-auto text-center">
                <thead>
                    <tr>
                        <th class="p-4">#</th>
                        <th class="p-4">Kode Penjualan</th>
                        <th class="p-4">Customer</th>
                        <th class="p-4">Jumlah Belum Selesai</th>
                        <th class="p-4">Jumlah Sudah Selesai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product->production->saleProductions as $index => $sale_production)
                        <tr class="shadow-md bg-white">
                            <input name="sale_production_id[]" type="hidden" value="{{ $sale_production->id }}">
                            <td class="p-4 rounded-l-lg">{{ $index + 1 }}</td>
                            <td class="p-4">{{ $sale_production->sale->code }}</td>
                            <td class="p-4">{{ $sale_production->sale->customer->name }}</td>
                            <td class="p-4">
                                <x-input :name="'sale_quantity_not_finished[]'" oninput="setMinimum(this)" :type="'number'" :placeholder="'0'"
                                    readonly :value="$sale_production->quantity_not_finished" />
                            </td>
                            <td class="p-4 rounded-r-lg">
                                <x-input :name="'sale_quantity_finished[]'" :type="'number'" oninput="setNotFinished(this)"
                                    :placeholder="'0'" :value="$sale_production->quantity_finished" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <h1 class="text-lg font-bold my-8 text-center">Create Purchases</h1>
        <div class="shadow rounded-lg w-full bg-white p-8 my-8">
            <div class="flex gap-5 text-sm">
                <div>
                    <label for="purchase_date" class="block text-sm">Tanggal Pembelian</label>
                    <x-input type="date" :name="'purchase_date'" :inputParentClass="'mb-3'" :value="old('purchase_date')" />

                    <label for="due_date" class="block text-sm">Tanggal Jatuh Tempo</label>
                    <x-input type="date" :name="'due_date'" :inputParentClass="'mb-3'" :value="old('due_date')" />

                    <label for="supplier_id" class="block text-sm">Pemasok</label>
                    <div class="w-40 mt-2 mb-3">
                        <x-select x-on:click="getSupplier; await $nextTick();" :dataLists="$product->suppliers->toArray()" :name="'supplier_id'"
                            :id="'supplier_id'" />
                    </div>

                    <x-input :name="'supplier_address'" :label="'Alamat Pemasok'" readonly class="mb-3 bg-slate-100" />

                    <x-input :name="'supplier_email'" :label="'Email Pemasok'" readonly class="mb-3 bg-slate-100" />

                    <x-input :name="'supplier_phone'" :label="'No Hp Pemasok'" readonly class="mb-3 bg-slate-100" />

                    <x-input :name="'code'" :type="'text'" :label="'Kode Pembelian'" :inputParentClass="'mb-3'"
                        :value="old('purchase_code')" />

                    <x-input :name="'method'" :type="'text'" :label="'Metode Pembayaran'" :inputParentClass="'mb-3'"
                        :value="old('method')" />

                    <x-input :name="'beneficiary_bank'" :type="'text'" :label="'Beneficiary\'s Bank'" :inputParentClass="'mb-3'"
                        :value="old('beneficiary_bank')" />

                    <x-input :name="'beneficiary_ac_usd'" :type="'text'" :label="'Beneficiary A/C USD'" :inputParentClass="'mb-3'"
                        :value="old('beneficiary_ac_usd')" />

                    <x-input :name="'bank_address'" :type="'text'" :label="'Bank Address'" :inputParentClass="'mb-3'"
                        :value="old('bank_address')" />

                    <x-input :name="'swift_code'" :type="'text'" :label="'Swift Code'" :inputParentClass="'mb-3'"
                        :value="old('swift_code')" />

                    <x-input :name="'beneficiary_name'" :type="'text'" :label="'Beneificiary Name'" :inputParentClass="'mb-3'"
                        :value="old('beneficiary_name')" />

                    <x-input :name="'beneficiary_address'" :type="'text'" :label="'Beneficiary\'s Address'" :inputParentClass="'mb-3'"
                        :value="old('beneficiary_address')" />

                    <x-input :name="'phone'" :type="'text'" :label="'Phone'" :inputParentClass="'mb-3'"
                        :value="old('phone')" />

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
                                <td>{{ $product->name }}</td>
                                <td>
                                    <input type="number" name="quantity_purchase" id="quantity_purchase"
                                        oninput="setSubtotal(this)" max="{{ $product->production->quantity_not_finished }}"
                                        min="0"
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

                    <input type="checkbox" name="cek">

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
        </div>


        <div class="shadow rounded-lg w-full bg-white p-8 my-8">
            <button class="py-2 px-5 border text-[#F7F9F9] text-sm rounded-lg bg-[#064E3B] w-full">Submit</button>
        </div>
    </form>
@endsection
@push('script')
    <script>
        const product = {!! $product !!}

        function getSupplier() {
            const supplier_id = document.getElementById('supplier_id').value;
            if (supplier_id) {
                document.getElementById('supplier_address').value = product.suppliers.find(supplier => supplier.id ==
                    supplier_id).address;
                document.getElementById('supplier_email').value = product.suppliers.find(supplier => supplier.id ==
                    supplier_id).email;
                document.getElementById('supplier_phone').value = product.suppliers.find(supplier => supplier.id ==
                    supplier_id).phone;
                document.getElementById("price_purchase").value = product.suppliers.find(supplier => supplier.id ==
                    supplier_id).pivot.price_per_unit;
            } else {
                document.getElementById('supplier_address').value = '';
                document.getElementById('supplier_email').value = '';
                document.getElementById('supplier_phone').value = '';
            }
        }

        function setSubtotal(element) {
            const quantity_purchase = element.value;
            const price_purchase = document.getElementById('price_purchase').value;
            const subtotal = quantity_purchase * price_purchase;
            document.getElementById('subtotal').innerHTML = subtotal;
            document.getElementById('total_bill').value = subtotal;
        }
    </script>
@endpush
