@extends('layouts.layout')

@section('content')
    <form action="/purchases/{{ $purchase->id }}" method="POST">
        @method('PUT')
        @csrf

        <div class="text-[18px] font-medium">Edit Pembelian</div>

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
                                class="py-2 px-4 outline-none border-slate-200 border w-[255px] rounded bg-slate-100"
                                readonly value="{{ $purchase->purchase_date }}">
                        </div>
                        <div class="flex justify-between mt-7">
                            <div class="font-medium">Kode Pembelian</div>
                            <input id="code" name="code" type="text"
                                class="py-2 px-4 outline-none border-slate-200 border w-[255px] rounded bg-slate-100"
                                readonly value="{{ $purchase->code }}">
                        </div>
                        <div class="flex justify-between mt-7">
                            <div class="font-medium">Beneficiary's Bank</div>
                            <input id="beneficiary_bank" name="beneficiary_bank" type="text"
                                class="py-2 px-4 outline-none border-slate-200 border w-[255px] rounded bg-slate-100"
                                readonly value="{{ $purchase->payment_purchases->beneficiary_bank }}">
                        </div>
                        <div class="flex justify-between mt-7">
                            <div class="font-medium">Bank Address</div>
                            <input id="bank_address" name="bank_address" type="text"
                                class="py-2 px-4 outline-none border-slate-200 border w-[255px] rounded bg-slate-100"
                                readonly value="{{ $purchase->payment_purchases->bank_address }}">
                        </div>
                        <div class="flex justify-between mt-7">
                            <div class="font-medium">Beneficiary Name</div>
                            <input id="beneficiary_name" name="beneficiary_name" type="text"
                                class="py-2 px-4 outline-none border-slate-200 border w-[255px] rounded bg-slate-100"
                                readonly value="{{ $purchase->payment_purchases->beneficiary_name }}">
                        </div>
                        <div class="flex justify-between mt-7">
                            <div class="font-medium">Phone</div>
                            <input id="phone" name="phone" type="text"
                                class="py-2 px-4 outline-none border-slate-200 border w-[255px] rounded bg-slate-100"
                                readonly value="{{ $purchase->payment_purchases->phone }}">
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between">
                            <div class="font-medium">Tanggal Jatuh Tempo</div>
                            <input id="due_date" name="due_date" type="text"
                                class="py-2 px-4 outline-none border-slate-200 border w-[255px] rounded bg-slate-100"
                                readonly value="{{ $purchase->due_date }}">
                        </div>
                        <div class="flex justify-between mt-7">
                            <div class="font-medium">Metode Pembayaran</div>
                            {{-- @dd($req) --}}
                            <input id="method" name="method" type="text"
                                class="py-2 px-4 outline-none border-slate-200 border w-[255px] rounded bg-slate-100"
                                readonly value="{{ $purchase->payment_purchases->method }}">
                        </div>
                        <div class="flex justify-between mt-7">
                            <div class="font-medium">Beneficiary A/C USD</div>
                            <input id="beneficiary_ac_usd" name="beneficiary_ac_usd" type="text"
                                class="py-2 px-4 outline-none border-slate-200 border w-[255px] rounded bg-slate-100"
                                readonly value="{{ $purchase->payment_purchases->beneficiary_ac_usd }}">
                        </div>
                        <div class="flex justify-between mt-7">
                            <div class="font-medium">Swift Code</div>
                            <input id="swift_code" name="swift_code" type="text"
                                class="py-2 px-4 outline-none border-slate-200 border w-[255px] rounded bg-slate-100"
                                readonly value="{{ $purchase->payment_purchases->swift_code }}">
                        </div>
                        <div class="flex justify-between mt-7">
                            <div class="font-medium">Beneficiary's Address</div>
                            <input id="beneficiary_address" name="beneficiary_address" type="text"
                                class="py-2 px-4 outline-none border-slate-200 border w-[255px] rounded bg-slate-100"
                                readonly value="{{ $purchase->payment_purchases->beneficiary_address }}">
                        </div>
                        <div class="flex justify-between mt-7">
                            <div class="font-medium">Lokasi Pengiriman</div>
                            <textarea name="location" id="location" cols="30" rows="10"
                                class="py-2 px-4 outline-none border-slate-200 border w-[255px] rounded bg-slate-100" readonly>{{ $purchase->delivery_purchases->location }}</textarea>
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
                                <input id="supplier_name" name="supplier_name" type="text"
                                    value="{{ $purchase->supplier->name }}"
                                    class="py-2 px-4 outline-none border-slate-200 border w-[255px] bg-gray-100 rounded"
                                    placeholder="Nama" readonly>
                            </div>
                        </div>
                        <div class="flex justify-between mt-7">
                            <div class="font-medium">Informasi Supplier</div>
                            <input id="supplier_email" name="supplier_email" type="text"
                                value="{{ $purchase->supplier->email }}"
                                class="py-2 px-4 outline-none border-slate-200 border w-[255px] bg-gray-100 rounded"
                                placeholder="Email" readonly>
                        </div>
                        <div class="flex justify-between mt-7">
                            <div></div>
                            <input id="supplier_phone" name="supplier_phone" type="text"
                                value="{{ $purchase->supplier->phone }}"
                                class="py-2 px-4 outline-none border-slate-200 border w-[255px] bg-gray-100 rounded"
                                placeholder="No Hp" readonly>
                        </div>
                        <div class="flex justify-between mt-7">
                            <div></div>
                            <textarea name="supplier_address" id="supplier_address" cols="30" rows="10"
                                class="py-2 px-4 outline-none border-slate-200 border w-[255px] bg-gray-100 rounded" placeholder="Alamat"
                                readonly>{{ $purchase->supplier->address }}</textarea>
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
                                    <th class="py-3 font-medium text-start w-20"></th>
                                    <th class="py-3 font-medium text-start w-32">Nama</th>
                                    <th class="py-3 font-medium text-start w-[75px]">Jumlah</th>
                                    <th class="py-3 font-medium text-start w-16">Unit</th>
                                    <th class="py-3 font-medium text-start">Harga</th>
                                    <th class="py-3 font-medium text-start">Subtotal</th>
                                    <th class="py-3 font-medium text-start w-20">Terkirim</th>
                                    <th class="py-3 font-medium text-start w-20">Belum</th>
                                </tr>
                            </thead>

                            <tbody id="table-component">
                                @foreach ($purchase->components as $i => $cs)
                                    <tr x-data="{ component: $el }" class="border-x border-b border-gray-200">
                                        <td id="number-component" class="py-3 pr-5 text-center">{{ $i + 1 }}.</td>
                                        <td class="py-3 pr-5">{{ $cs->name }}</td>
                                        <td id="quantity" x-ref="quantity" class="py-3 pr-5">{{ $cs->pivot->quantity }}
                                        </td>
                                        <td id="unit" class="py-3 pr-5">{{ $cs->unit }}</td>
                                        <td id="price" x-ref="price" class="py-2">
                                            {{ $cs->suppliers->find($purchase->supplier->id)->pivot->price_per_unit }}</td>
                                        <td id="subtotal" class="py-2"
                                            x-text="toRupiah(parseFloat($refs.quantity.innerText) * parseFloat($refs.price.innerText.replace(/[^0-9\.,]/g, '').replace(/[^0-9\.,]/g, '').replace(/\./g,'').replace(',', '.')))">
                                        </td>
                                        <td class="py-2 pr-5">
                                            <input type="hidden" name="old_delivered_component[]"
                                                value="{{ $purchase->deliveryComponents->where('component_id', $cs->id)->first()->delivered }}">

                                            <input type="number" name="delivered_component[]" step="0.001""
                                                class="p-2 outline-none border-slate-200 border w-full rounded focus:outline-2 focus:outline-slate-200"
                                                value="{{ $purchase->deliveryComponents->where('component_id', $cs->id)->first()->delivered }}"
                                                x-on:change="$el.value = ($el.value > {{ $cs->pivot->quantity }}) ? {{ $cs->pivot->quantity }} : $el.value; 
                                                            $el.value = ($el.value < {{ $purchase->deliveryComponents->where('component_id', $cs->id)->first()->delivered }}) ? {{ $purchase->deliveryComponents->where('component_id', $cs->id)->first()->delivered }} : $el.value; 
                                                            $refs.belum.value = {{ $cs->pivot->quantity }}-$el.value"
                                                x-on:input="$refs.belum.value = {{ $cs->pivot->quantity }}-$el.value">
                                        </td>
                                        <td class="py-2 pr-5">
                                            <input x-ref="belum" type="number" name="remain_component[]"
                                                step="1"
                                                class="p-2 outline-none border-slate-200 bg-slate-100 border w-full rounded"
                                                value="{{ $purchase->deliveryComponents->where('component_id', $cs->id)->first()->remain }}" readonly>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-7 flex justify-between">
                    <div class="font-medium">Produk</div>
                    <div>
                        <table class="w-[790px] table-fixed mb-2">
                            <thead>
                                <tr class="bg-gray-100 border border-gray-200">
                                    <th class="py-3 font-medium text-start w-20"></th>
                                    <th class="py-3 font-medium text-start w-32">Nama</th>
                                    <th class="py-3 font-medium text-start w-[75px]">Jumlah</th>
                                    <th class="py-3 font-medium text-start">Harga</th>
                                    <th class="py-3 font-medium text-start">Subtotal</th>
                                    <th class="py-3 font-medium text-start w-20">Terkirim</th>
                                    <th class="py-3 font-medium text-start w-20">Belum</th>
                                </tr>
                            </thead>
                            <tbody id="table-product">
                                {{-- @dd($purchase) --}}
                                @foreach ($purchase->products as $i => $product)
                                    <tr x-data="{ product: $el }" class="border-x border-b border-gray-200">
                                        <td id="number-product" class="py-3 pr-5 text-center">{{ $i + 1 }}.</td>
                                        <td class="py-3 pr-5">{{ $product->name }}</td>
                                        <td id="quantity" x-ref="quantity" class="py-3 pr-5">
                                            {{ $product->pivot->quantity }}</td>
                                        <td id="price" x-ref="price" class="py-2">
                                            {{ $product->suppliers->find($purchase->supplier->id)->pivot->price_per_unit }}
                                        </td>
                                        <td id="subtotal" class="py-2"
                                            x-text="toRupiah(parseFloat($refs.quantity.innerHTML) * parseFloat($refs.price.innerHTML.replace(/[^0-9\.,]/g, '').replace(/[^0-9\.,]/g, '').replace(/\./g,'').replace(',', '.')))">
                                        </td>
                                        <td class="py-2 pr-5">
                                            <input type="hidden" name="old_delivered_product[]"
                                                value="{{ $purchase->deliveryProducts->where('product_id', $product->id)->first()->delivered }}">

                                            <input type="number" name="delivered_product[]" step="0.00001""
                                                class="p-2 outline-none border-slate-200 border w-full rounded focus:outline-2 focus:outline-slate-200"
                                                value="{{ $purchase->deliveryProducts->where('product_id', $product->id)->first()->delivered }}"
                                                x-on:change="$el.value = ($el.value > {{ $product->pivot->quantity }}) ? {{ $product->pivot->quantity }} : $el.value; 
                                                            $el.value = ($el.value < {{ $purchase->deliveryProducts->where('product_id', $product->id)->first()->delivered }}) ? {{ $purchase->deliveryProducts->where('product_id', $product->id)->first()->delivered }} : $el.value; 
                                                            $refs.belum.value = {{ $product->pivot->quantity }}-$el.value"
                                                x-on:input="$refs.belum.value = {{ $product->pivot->quantity }}-$el.value">
                                        </td>
                                        <td class="py-2 pr-5">
                                            <input x-ref="belum" type="number" name="remain_product[]"
                                                step="1"
                                                class="p-2 outline-none border-slate-200 bg-slate-100 border w-full rounded"
                                                value="{{ $purchase->deliveryProducts->where('product_id', $product->id)->first()->remain }}" readonly>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-7 flex gap-[120px]">
                    <div class="font-medium">Total Biaya</div>
                    <div>
                        <table class="w-[600px] table-fixed mb-2">
                            <thead>
                                <tr class="bg-gray-100 border border-gray-200">
                                    <th class="p-3 font-medium text-start">Total</th>
                                    <th class="p-3 font-medium text-start">Sisa</th>
                                    <th class="p-3 font-medium text-start">Bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr x-data class="border-x border-b border-gray-200">
                                    <td class="p-3">
                                        <input x-ref="total_bill" id="total_bill" name="total_bill" type="number"
                                            value="{{ $purchase->total_bill }}"
                                            class="p-2 outline-none border-slate-200 border bg-slate-100 w-full rounded"
                                            placeholder="Total Bayar" readonly>
                                    </td>
                                    <td class="p-3">
                                        <input x-ref="remain_bill" id="remain_bill" name="remain_bill" type="number"
                                            value="{{ $purchase->remain_bill }}"
                                            class="p-2 outline-none border-slate-200 border bg-slate-100 w-full rounded"
                                            placeholder="Sisa" readonly>
                                    </td>
                                    <td class="p-3">
                                        <input id="paid" name="paid" type="number"
                                            class="p-2 outline-none border-slate-200 border w-full rounded"
                                            placeholder="Bayar" value="{{ old('paid') ?? 0 }}"
                                            x-on:input="$el.value = $el.value > {{ $purchase->remain_bill }} ? {{ $purchase->remain_bill }} : $el.value; 
                                                        $refs.remain_bill.value = {{ $purchase->remain_bill }} - $el.value">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div x-data="{ open: true }" class="mt-5 bg-white rounded-lg w-full">
            <div x-on:click="open = !open"
                class="p-5 cursor-pointer active:bg-gray-50 transition-all items-center font-medium flex gap-5">
                <ion-icon :class="open ? 'rotate-0' : '-rotate-90'" class="transition-all"
                    name="chevron-down-outline"></ion-icon>
                <div>History</div>
            </div>
            <div x-show="open" x-transition class="mx-5 border-t border-slate-200 pb-5 text-sm">
                <div class="mt-10 flex justify-between">
                    <div class="font-medium">History Pembayaran</div>
                    <div>
                        <table class="w-[790px] table-fixed mb-2">
                            <thead>
                                <tr class="bg-gray-100 border border-gray-200">
                                    <th class="py-3 font-medium text-start w-20"></th>
                                    <th class="py-3 font-medium text-start w-32">Tanggal</th>
                                    <th class="py-3 font-medium text-start w-52">Bayar</th>
                                    <th class="py-3 font-medium text-start">Keterangan</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($purchase->histories as $i => $history)
                                    <tr class="border-x border-b border-gray-200">
                                        <td class="py-3 pr-5 text-center">{{ $i + 1 }}.</td>
                                        <td class="py-3 pr-5">{{ date('Y-m-d', strtotime($history->created_at)) }}</td>
                                        <td class="py-3 pr-5" x-text="toRupiah({{ $history->payment }})"></td>
                                        <td class="py-3 pr-5">{{ $history->description }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if (!$purchase->histories->first())
                            <div class="text-center py-2 font-medium">Belum ada history</div>
                        @endif
                    </div>
                </div>

                <div class="mt-7 flex justify-between">
                    <div class="font-medium">History Pengiriman</div>
                    <div>
                        <table class="w-[790px] table-fixed mb-2">
                            <thead>
                                <tr class="bg-gray-100 border border-gray-200">
                                    <th class="py-3 font-medium text-start w-20"></th>
                                    <th class="py-3 font-medium text-start w-32">Tanggal</th>
                                    <th class="py-3 font-medium text-start">Keterangan</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($purchase->historyDeliveries as $i => $history)
                                    <tr class="border-x border-b border-gray-200">
                                        <td class="py-3 pr-5 text-center">{{ $i + 1 }}.</td>
                                        <td class="py-3 pr-5">{{ date('Y-m-d', strtotime($history->created_at)) }}</td>
                                        <td class="py-3 pr-5">{{ $history->description }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if (!$purchase->historyDeliveries->first())
                            <div class="text-center py-2 font-medium">Belum ada history</div>
                        @endif
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
        {{-- <div class="flex gap-5">
            <div class="basis-8/12">
                <h1 class="text-xl font-bold text-center m-4">Data Transaksi</h1>
                <div class="h-fit relative bg-white rounded-xl px-4 py-6 drop-shadow-lg my-4">
                    <div class="grid grid-cols-2">
                        <div class="px-4">
                            <x-input type="date" :name="'purchase_date'" :label="'Tanggal Pembelian'" :value="$purchase->purchase_date" readonly
                                class="mb-3 bg-slate-100" />
                        </div>
                        <div class="px-4">
                            <x-input type="date" :name="'due_date'" :label="'Tanggal Jatuh Tempo'" :value="$purchase->due_date" readonly
                                class="mb-3 bg-slate-100" />
                        </div>
                        <div class="px-4 mt-2 col-span-2">
                            <x-input :name="'code'" :type="'text'" :label="'Kode Pembelian'" :value="$purchase->code" readonly
                                class="bg-slate-100" />
                        </div>
                    </div>
                </div>

                <h1 class="text-xl font-bold text-center m-4">Data Diri Supplier</h1>
                <div class="h-fit relative bg-white rounded-xl px-4 py-6 drop-shadow-lg my-4">
                    <div class="grid grid-cols-3">
                        <div class="col-span-3 px-4">
                            <label for="supplier_id" class="block text-sm">Pemasok</label>
                            <div class="w-full mt-2 mb-3">
                                <x-input :name="'supplier_name'" :label="'Nama Pemasok'" :value="$purchase->supplier->name" readonly
                                    class="mb-3 bg-slate-100" />
                            </div>
                        </div>
                        <div class="px-4 mt-2">
                            <x-input :name="'supplier_address'" :label="'Alamat Pemasok'" :value="$purchase->supplier->address" readonly
                                class="mb-3 bg-slate-100" />
                        </div>
                        <div class="px-4 mt-2">
                            <x-input :name="'supplier_email'" :label="'Email Pemasok'" :value="$purchase->supplier->email" readonly
                                class="mb-3 bg-slate-100" />
                        </div>
                        <div class="px-4 mt-2">
                            <x-input :name="'supplier_phone'" :label="'No Hp Pemasok'" :value="$purchase->supplier->phone" readonly
                                class="mb-3 bg-slate-100" />
                        </div>
                    </div>
                </div>

                <h1 class="text-xl font-bold text-center m-4">Data Pembayaran</h1>
                <div class="h-fit relative bg-white rounded-xl px-4 py-6 drop-shadow-lg my-4">
                    <div class="grid grid-cols-3">
                        <div class="col-span-3 px-4">
                            <x-input :name="'method'" :type="'text'" :label="'Metode Pembayaran'" :value="$purchase->payment_purchases->method" readonly
                                :inputParentClass="'mb-3'" class="bg-slate-100" />

                        </div>

                        <div class="px-4 mt-2">
                            <x-input :name="'beneficiary_bank'" :type="'text'" :label="'beneficiary\'s Bank'" :value="$purchase->payment_purchases->beneficiary_bank" readonly
                                :inputParentClass="'mb-3'" class="bg-slate-100" />

                        </div>

                        <div class="px-4 mt-2">
                            <x-input :name="'beneficiary_ac_usd'" :type="'text'" :label="'beneficiary A/C USD'" :value="$purchase->payment_purchases->beneficiary_ac_usd" readonly
                                :inputParentClass="'mb-3'" class="bg-slate-100" />

                        </div>

                        <div class="px-4 mt-2">
                            <x-input :name="'bank_address'" :type="'text'" :label="'Bank Address'" :value="$purchase->payment_purchases->bank_address" readonly
                                :inputParentClass="'mb-3'" class="bg-slate-100" />

                        </div>

                        <div class="px-4 mt-2">
                            <x-input :name="'swift_code'" :type="'text'" :label="'Swift Code'" :value="$purchase->payment_purchases->swift_code" readonly
                                :inputParentClass="'mb-3'" class="bg-slate-100" />

                        </div>
                        <div class="px-4 mt-2">
                            <x-input :name="'beneficiary_name'" :type="'text'" :label="'Beneficiary\'s Name'" :value="$purchase->payment_purchases->beneficiary_name" readonly
                                :inputParentClass="'mb-3'" class="bg-slate-100" />

                        </div>
                        <div class="px-4 mt-2">
                            <x-input :name="'beneficiary_address'" :type="'text'" :label="'Beneficiary\'s Address'" :value="$purchase->payment_purchases->beneficiary_address" readonly
                                :inputParentClass="'mb-3'" class="bg-slate-100" />

                        </div>
                        <div class="px-4 mt-2">
                            <x-input :name="'phone'" :type="'text'" :label="'Phone'" :value="$purchase->payment_purchases->phone" readonly
                                :inputParentClass="'mb-3'" class="bg-slate-100" />
                        </div>
                        <div class="px-4 mt-2 col-span-2">
                            <x-input-textarea :name="'location'" :label="'Lokasi Pengiriman'" :placeholder="'location'" :value="$purchase->delivery_purchases->location"
                                class="bg-slate-100" readonly />
                        </div>
                    </div>
                </div>

                <h1 class="text-xl font-bold text-center m-4">Data Keranjang</h1>
                <div class="h-fit relative bg-white rounded-xl px-4 py-6 drop-shadow-lg my-4">
                    <div class="grid grid-cols-1 px-4">
                        @if ($purchase->components->count() > 0)
                            <h1 class="mb-5 text-lg font-bold my-4">Komponen</h1>

                            <table class="w-full text-left">
                                <thead>
                                    <tr class="border-b-2">
                                        <th class="p-2">#</th>
                                        <th class="p-2">Komponen</th>
                                        <th class="p-2">Jumlah</th>
                                        <th class="p-2">Unit</th>
                                        <th class="p-2 max-w-6 break-all">Harga Per Produk</th>
                                        <th class="p-2 max-w-6 break-all">Subtotal</th>
                                        <th class="p-2">Delivered</th>
                                        <th class="p-2">Remain</th>
                                        <th class="p-2">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="purchaseBody">
                                    @foreach ($purchase->components as $i => $cs)
                                        <tr id="tr" x-data="" class="border-b">
                                            <td id="number" class="p-2">{{ $i + 1 }}</td>
                                            <td class="p-2">{{ $cs->name }}</td>
                                            <td id="quantity" class="p-2" x-ref="quantity">{{ $cs->pivot->quantity }}
                                            </td>
                                            <td id="unit" class="p-2">{{ $cs->unit }}</td>
                                            <td id="price" x-ref="price" class="p-2 rupiah max-w-6 break-all">
                                                {{ $cs->suppliers->find($purchase->supplier->id)->pivot->price_per_unit }}
                                            </td>
                                            <td id="subtotal"
                                                x-text="toRupiah(parseFloat($refs.quantity.innerText) * parseFloat($refs.price.innerText.replace(/[^0-9\.,]/g, '').replace(/[^0-9\.,]/g, '').replace(/\./g,'').replace(',', '.')))"
                                                class="p-2 max-w-6 break-all"></td>
                                            <td class="p-2">
                                                <input type="hidden" name="old_delivered_component[]" value="{{ number_format(
                                                    $purchase->deliveryComponents
                                                        ->where('component_id', $cs->id)
                                                        ->first()->delivered,
                                                    5,
                                                ) ?? 0 }}">
                                                <x-input :name="'delivered_component[]'" :step="0.00001" :min="number_format(
                                                    $purchase->deliveryComponents
                                                        ->where('component_id', $cs->id)
                                                        ->first()->delivered,
                                                    5,
                                                ) ?? 0"
                                                    max="{{ number_format($purchase->deliveryComponents->where('component_id', $cs->id)->first()->total, 5) ?? 0 }}"
                                                    :placeholder="'0'" :value="number_format(
                                                        $purchase->deliveryComponents
                                                            ->where('component_id', $cs->id)
                                                            ->first()->delivered,
                                                        5,
                                                    ) ?? 0"
                                                    oninput="setDeliveredComponent(this)" :type="'number'"
                                                    class="delivered_component"></x-input>
                                            </td>
                                            <td class="p-2">
                                                <x-input :name="'remain_component[]'" step="1" readonly :placeholder="'0'"
                                                    :value="number_format(
                                                        $purchase->deliveryComponents
                                                            ->where('component_id', $cs->id)
                                                            ->first()->remain,
                                                        5,
                                                    ) ?? 0" :type="'number'"
                                                    class="remain_component bg-slate-100"></x-input>
                                            </td>
                                            <td class="p-2">
                                                <x-input :name="'total_component[]'" step="1" readonly :placeholder="'0'"
                                                    :value="number_format(
                                                        $purchase->deliveryComponents
                                                            ->where('component_id', $cs->id)
                                                            ->first()->total,
                                                        5,
                                                    ) ?? 0" :type="'number'"
                                                    class="total_component bg-slate-100"></x-input>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if (!$purchase->remain_bill)
                                        <tr id="tr" x-data="" class="border-b">
                                            <td id="number" class="p-2"></td>
                                            <td class="w-40 p-2"></td>
                                            <td id="quantity" class="p-2" x-ref="quantity"></td>
                                            <td id="unit" class="p-2"></td>
                                            <td id="price" x-ref="price" class="p-2 font-bold">Total</td>
                                            <td class="p-2 font-bold total_bayar"></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        @endif

                        @if ($purchase->products->count() > 0)
                            <h1 class="mb-5 text-lg font-bold my-4">Produk</h1>

                            <table class="w-full text-left">
                                <thead>
                                    <tr class="border-b-2">
                                        <th class="p-2">#</th>
                                        <th class="p-2">Produk</th>
                                        <th class="p-2">Jumlah</th>
                                        <th class="p-2 max-w-6 break-all">Harga Per Produk</th>
                                        <th class="p-2 max-w-6 break-all">Subtotal</th>
                                        <th class="p-2">Delivered</th>
                                        <th class="p-2">Remain</th>
                                        <th class="p-2">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="purchaseBody">
                                    @foreach ($purchase->products as $i => $cs)
                                        <tr id="tr" x-data="" class="border-b">
                                            <td id="number" class="p-2">{{ $i + 1 }}</td>
                                            <td class="p-2">{{ $cs->name }}</td>
                                            <td id="quantity" class="p-2" x-ref="quantity">
                                                {{ $cs->pivot->quantity }}
                                            </td>
                                            <td id="price" x-ref="price" class="p-2 rupiah max-w-6 break-all">
                                                {{ $cs->suppliers->find($purchase->supplier->id)->pivot->price_per_unit }}
                                            </td>
                                            <td id="subtotal"
                                                x-text="toRupiah(parseFloat($refs.quantity.innerText) * parseFloat($refs.price.innerText.replace(/[^0-9\.,]/g, '').replace(/[^0-9\.,]/g, '').replace(/\./g,'').replace(',', '.')))"
                                                class="p-2 max-w-6 break-all"></td>
                                            <td class="p-2">
                                                <input type="hidden" name="old_delivered_product[]" value="{{ $purchase->deliveryProducts
                                                    ->where('product_id', $cs->id)
                                                    ->first()->delivered ?? 0 }}">
                                                <x-input :name="'delivered_product[]'" :step="1" :min="$purchase->deliveryProducts
                                                    ->where('product_id', $cs->id)
                                                    ->first()->delivered ?? 0"
                                                    max="{{ $purchase->deliveryProducts->where('product_id', $cs->id)->first()->total ?? 0 }}"
                                                    :placeholder="'0'" :value="$purchase->deliveryProducts
                                                        ->where('product_id', $cs->id)
                                                        ->first()->delivered ?? 0"
                                                    oninput="setDeliveredProduct(this)" :type="'number'"
                                                    class="delivered_product"></x-input>
                                            </td>
                                            <td class="p-2">
                                                <x-input :name="'remain_product[]'" step="1" min="0"
                                                    max="{{ $purchase->deliveryProducts->where('product_id', $cs->id)->first()->total ?? 0 }}"
                                                    readonly :placeholder="'0'" :value="$purchase->deliveryProducts
                                                        ->where('product_id', $cs->id)
                                                        ->first()->remain ?? 0" :type="'number'"
                                                    class="remain_product bg-slate-100"></x-input>
                                            </td>
                                            <td class="p-2">
                                                <x-input :name="'total_product[]'" step="1" min="0"
                                                    max="{{ $purchase->deliveryProducts->where('product_id', $cs->id)->first()->total ?? 0 }}"
                                                    readonly :placeholder="'0'" :value="$purchase->deliveryProducts
                                                        ->where('product_id', $cs->id)
                                                        ->first()->total ?? 0" :type="'number'"
                                                    class="total_product bg-slate-100"></x-input>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if (!$purchase->remain_bill)
                                        <tr id="tr" x-data="" class="border-b">
                                            <td id="number" class="p-2"></td>
                                            <td class="w-40 p-2"></td>
                                            <td id="quantity" class="p-2" x-ref="quantity"></td>
                                            <td id="unit" class="p-2"></td>
                                            <td id="price" x-ref="price" class="p-2 font-bold">Total</td>
                                            <td class="p-2 font-bold total_bayar"></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        @endif

                    </div>
                </div>
            </div>

            <div class="basis-4/12">
                <div class="sticky top-10">
                    @if ($purchase->remain_bill)
                        <h1 class="text-xl font-bold text-center m-4">Data Biaya</h1>
                        <div class="h-fit relative bg-white rounded-xl px-4 py-6 drop-shadow-lg my-4">
                            <div class="grid grid-cols-3">
                                <div class="px-4">
                                    <x-input :label="'Bayar'" :name="'paid'" :placeholder="'Bayar'" :type="'number'"
                                        onInput="update_sisa(this)" :value="'0'" />
                                </div>
                                <div class="px-4">

                                    <x-input :label="'Sisa'" :name="'remain_bill'" :placeholder="'Sisa'" :value="$purchase->remain_bill"
                                        :type="'number'" class="bg-slate-100" readonly />

                                </div>
                                <div class="px-4">
                                    <x-input :label="'Total'" :name="'total_bill'" :placeholder="'Total'" :value="$purchase->total_bill"
                                        :type="'number'" class="bg-slate-100" readonly />
                                </div>
                            </div>
                        </div>
                    @endif

                    <h1 class="text-xl font-bold text-center m-4">History Pembayaran</h1>
                    <div class="h-fit relative bg-white rounded-xl px-4 py-6 drop-shadow-lg my-4">
                        <div class="grid grid-cols-1">
                            <div class="px-4">
                                <table class="w-full text-left">
                                    <thead>
                                        <tr class="border-b-2">
                                            <th class="p-2">#</th>
                                            <th class="p-2">Tanggal</th>
                                            <th class="p-2">Bayar</th>
                                            <th class="p-2">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($purchase->histories as $i => $history)
                                            <tr class="border-b">
                                                <td class="p-2">{{ $i + 1 }}</td>
                                                <td class="p-2">
                                                    {{ date('Y-m-d', strtotime($history->created_at)) }}</td>
                                                <td class="p-2 bayar rupiah">{{ $history->payment }}</td>
                                                <td class="p-2">{{ $history->description }}</td>
                                            </tr>
                                        @endforeach
                                        <tr class="border-b">
                                            <td class="p-2"></td>
                                            <td class="p-2 font-bold">Total</td>
                                            <td class="p-2 font-bold total_bayar"></td>
                                            <td class="p-2"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <h1 class="text-xl font-bold text-center m-4">History Pengiriman</h1>
                    <div class="h-fit relative bg-white rounded-xl px-4 py-6 drop-shadow-lg my-4">
                        <div class="grid grid-cols-1">
                            <div class="px-4">
                                <table class="w-full text-left">
                                    <thead>
                                        <tr class="border-b-2">
                                            <th class="p-2">#</th>
                                            <th class="p-2">Tanggal</th>
                                            <th class="p-2">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($purchase->historyDeliveries as $i => $history)
                                            <tr class="border-b">
                                                <td class="p-2">{{ $i + 1 }}</td>
                                                <td class="p-2">
                                                    {{ date('Y-m-d', strtotime($history->created_at)) }}</td>
                                                <td class="p-2">{{ $history->description }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="h-fit relative bg-white rounded-xl px-4 py-6 drop-shadow-lg my-4">
            <div class="grid grid-cols-2">
                <div class="px-4">
                    <a href="/purchases"><button type="button"
                            class="w-full  py-2 px-5 border text-[#768498] text-sm rounded-lg hover:bg-[#F7F9F9]">Batalkan</button></a>
                </div>
                <div class="px-4">
                    <button type="submit"
                        class="w-full py-2 px-5 border text-[#F7F9F9] bg-[#064e3be1] text-sm rounded-lg">Simpan</button>
                </div>
            </div>
        </div> --}}
    </form>
@endsection
@push('script')
    <script>
        function setDeliveredComponent(e) {
            if (parseFloat(e.value) > parseFloat(e.max)) e.value = e.max
            if (parseFloat(e.value) < parseFloat(e.min) || e.value == "") e.value = e.min
            const parent = e.parentElement.parentElement.parentElement
            const total = parent.querySelector(".total_component").value
            const remain = (total - e.value).toFixed(5)
            parent.querySelector(".remain_component").value = remain
        }

        function setDeliveredProduct(e) {
            if (parseFloat(e.value) > parseFloat(e.max)) e.value = e.max
            if (parseFloat(e.value) < parseFloat(e.min) || e.value == "") e.value = e.min
            const parent = e.parentElement.parentElement.parentElement
            const total = parent.querySelector(".total_product").value
            const remain = (total - e.value).toFixed(5)
            parent.querySelector(".remain_product").value = remain
        }

        function update_sisa(element) {
            let sisa_sebelumnya = {!! $purchase->remain_bill !!}

            let total = document.querySelector('#total_bill').value || 0;

            if (element.value > sisa_sebelumnya) element.value = sisa_sebelumnya

            let sisa_sekarang = (sisa_sebelumnya - element.value).toFixed(5);
            document.querySelector('#remain_bill').value = sisa_sekarang;
        }

        function total_bayar() {
            const bills = document.querySelectorAll('.bayar');

            let total = Array.from(bills).map(bill => parseFloat(bill.innerText.replace(/[^0-9\.,]/g, '').replace(/\./g,
                '').replace(',', '.'))).reduce((acc, curr) =>
                acc + curr)

            Array.from(document.querySelectorAll('.total_bayar')).map(el => el.innerText = toRupiah(total));
        }

        // total_bayar()
    </script>
@endpush
