@extends('layouts.layout')

@section('content')
    {{-- @dd($purchase->histories[0]->created_at) --}}
    <h1 class="text-lg font my-7 font-[500]">Edit Purchases</h1>

    <x-edit-input-field :action="'purchases'" :items="$purchase" :width="'w-full'" :sisa="$purchase->remain_bill">
        <div class="flex gap-5 text-sm">
            <div>
                <x-input type="date" :name="'purchase_date'" :label="'Tanggal Pembelian'" :value="$purchase->purchase_date" readonly
                    class="mb-3 bg-slate-100" />
                <x-input type="date" :name="'due_date'" :label="'Tanggal Jatuh Tempo'" :value="$purchase->due_date" readonly
                    class="mb-3 bg-slate-100" />
                <x-input :name="'supplier_name'" :label="'Nama Pemasok'" :value="$purchase->supplier->name" readonly class="mb-3 bg-slate-100" />
                <x-input :name="'supplier_address'" :label="'Alamat Pemasok'" :value="$purchase->supplier->address" readonly class="mb-3 bg-slate-100" />
                <x-input :name="'supplier_email'" :label="'Email Pemasok'" :value="$purchase->supplier->email" readonly class="mb-3 bg-slate-100" />
                <x-input :name="'supplier_phone'" :label="'No Hp Pemasok'" :value="$purchase->supplier->phone" readonly class="mb-3 bg-slate-100" />
                <x-input :name="'code'" :type="'text'" :label="'Kode Pembelian'" :value="$purchase->code" readonly
                    class="bg-slate-100" />
                <x-input :name="'method'" :type="'text'" :label="'Metode Pembayaran'" :value="$purchase->payment_purchases->method" readonly
                    :inputParentClass="'mb-3'" class="bg-slate-100" />
                <x-input :name="'beneficiary_bank'" :type="'text'" :label="'beneficiary\'s Bank'" :value="$purchase->payment_purchases->beneficiary_bank" readonly
                    :inputParentClass="'mb-3'" class="bg-slate-100" />
                <x-input :name="'beneficiary_ac_usd'" :type="'text'" :label="'beneficiary A/C USD'" :value="$purchase->payment_purchases->beneficiary_ac_usd" readonly
                    :inputParentClass="'mb-3'" class="bg-slate-100" />
                <x-input :name="'bank_address'" :type="'text'" :label="'Bank Address'" :value="$purchase->payment_purchases->bank_address" readonly
                    :inputParentClass="'mb-3'" class="bg-slate-100" />
                <x-input :name="'swift_code'" :type="'text'" :label="'Swift Code'" :value="$purchase->payment_purchases->swift_code" readonly
                    :inputParentClass="'mb-3'" class="bg-slate-100" />
                <x-input :name="'beneficiary_name'" :type="'text'" :label="'Beneficiary\'s Name'" :value="$purchase->payment_purchases->beneficiary_name" readonly
                    :inputParentClass="'mb-3'" class="bg-slate-100" />
                <x-input :name="'beneficiary_address'" :type="'text'" :label="'Beneficiary\'s Address'" :value="$purchase->payment_purchases->beneficiary_address" readonly
                    :inputParentClass="'mb-3'" class="bg-slate-100" />
                <x-input :name="'phone'" :type="'text'" :label="'Phone'" :value="$purchase->payment_purchases->phone" readonly
                    :inputParentClass="'mb-3'" class="bg-slate-100" />
                <div class="flex w-full gap-3 my-3">
                    <div class="flex-1">
                        <x-input-textarea :name="'location'" :label="'Lokasi Pengiriman'" :placeholder="'location'" :value="$purchase->delivery_purchases->location"
                            class="bg-slate-100" readonly />
                    </div>
                </div>
            </div>

            <div class="divider divider-horizontal"></div>
            <div class="w-full">
                @if ($purchase->components->count() > 0)
                    <h1 class="mb-5 text-lg font-bold my-4">Komponen</h1>

                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b-2">
                                <th class="p-2">#</th>
                                <th class="p-2">Komponen</th>
                                <th class="p-2">Jumlah</th>
                                <th class="p-2">Unit</th>
                                <th class="p-2">Harga Per Produk</th>
                                <th class="p-2">Subtotal</th>
                                <th class="p-2">Delivered</th>
                                <th class="p-2">Remain</th>
                                <th class="p-2">Total</th>
                            </tr>
                        </thead>
                        <tbody id="purchaseBody">
                            @foreach ($purchase->components as $i => $cs)
                                <tr id="tr" x-data="" class="border-b">
                                    <td id="number" class="p-2">{{ $i + 1 }}</td>
                                    <td class="w-40 p-2">{{ $cs->name }}</td>
                                    <td id="quantity" class="p-2" x-ref="quantity">{{ $cs->pivot->quantity }}</td>
                                    <td id="unit" class="p-2">{{ $cs->unit }}</td>
                                    <td id="price" x-ref="price" class="p-2 rupiah">
                                        {{ $cs->suppliers->find($purchase->supplier->id)->pivot->price_per_unit }}</td>
                                    <td id="subtotal"
                                        x-text="toRupiah(parseInt($refs.quantity.innerText) * parseFloat($refs.price.innerText.replace(/[^0-9\.,]/g, '').replace(/[^0-9\.,]/g, '').replace(/\./g,
                    '').replace(',', '.')))"
                                        class="p-2"></td>
                                    <td class="p-2">
                                        <x-input :name="'delivered_component[]'" step="1" min="0"
                                            max="{{ $purchase->deliveryComponents->where('component_id', $cs->id)->first()->total ?? 0 }}"
                                            :placeholder="'0'" :value="$purchase->deliveryComponents
                                                ->where('component_id', $cs->id)
                                                ->first()->delivered ?? 0" oninput="setDeliveredComponent(this)"
                                            :type="'number'" class="delivered_component"></x-input>
                                    </td>
                                    <td class="p-2">
                                        <x-input :name="'remain_component[]'" step="1" min="0"
                                            max="{{ $purchase->deliveryComponents->where('component_id', $cs->id)->first()->total ?? 0 }}"
                                            readonly :placeholder="'0'" :value="$purchase->deliveryComponents
                                                ->where('component_id', $cs->id)
                                                ->first()->remain ?? 0" :type="'number'"
                                            class="remain_component bg-slate-100"></x-input>
                                    </td>
                                    <td class="p-2">
                                        <x-input :name="'total_component[]'" step="1" min="0"
                                            max="{{ $purchase->deliveryComponents->where('component_id', $cs->id)->first()->total ?? 0 }}"
                                            readonly :placeholder="'0'" :value="$purchase->deliveryComponents
                                                ->where('component_id', $cs->id)
                                                ->first()->total ?? 0" :type="'number'"
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
                    <div class="w-full">
                        <h1 class="mb-5 text-lg font-bold my-4">Produk</h1>

                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b-2">
                                    <th class="p-2">#</th>
                                    <th class="p-2">Produk</th>
                                    <th class="p-2">Jumlah</th>
                                    <th class="p-2">Harga Per Produk</th>
                                    <th class="p-2">Subtotal</th>
                                    <th class="p-2">Delivered</th>
                                    <th class="p-2">Remain</th>
                                    <th class="p-2">Total</th>
                                </tr>
                            </thead>
                            <tbody id="purchaseBody">
                                @foreach ($purchase->products as $i => $cs)
                                    <tr id="tr" x-data="" class="border-b">
                                        <td id="number" class="p-2">{{ $i + 1 }}</td>
                                        <td class="w-40 p-2">{{ $cs->name }}</td>
                                        <td id="quantity" class="p-2" x-ref="quantity">{{ $cs->pivot->quantity }}
                                        </td>
                                        <td id="price" x-ref="price" class="p-2 rupiah">
                                            {{ $cs->suppliers->find($purchase->supplier->id)->pivot->price_per_unit }}</td>
                                        <td id="subtotal"
                                            x-text="toRupiah(parseInt($refs.quantity.innerText) * parseFloat($refs.price.innerText.replace(/[^0-9\.,]/g, '').replace(/[^0-9\.,]/g, '').replace(/\./g,
                        '').replace(',', '.')))"
                                            class="p-2"></td>
                                        <td class="p-2">
                                            <x-input :name="'delivered_product[]'" step="1" min="0"
                                                max="{{ $purchase->deliveryProducts->where('product_id', $cs->id)->first()->total ?? 0 }}"
                                                :placeholder="'0'" :value="$purchase->deliveryProducts
                                                    ->where('product_id', $cs->id)
                                                    ->first()->delivered ?? 0" oninput="setDeliveredProduct(this)"
                                                :type="'number'" class="delivered_product"></x-input>
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

                        <h1 class="my-5 text-lg font-bold">History Pembayaran</h1>

                        <div class="w-full">
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
                                            <td class="p-2">{{ date('Y-m-d', strtotime($history->created_at)) }}</td>
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
                        <h1 class="text-lg font-bold m-4">Bayar</h1>
                        <div class="flex w-full gap-5 mt-5">
                            @if ($purchase->remain_bill)
                                <div class="flex-1">
                                    <x-input :label="'Bayar'" :name="'paid'" :placeholder="'Bayar'" :type="'number'"
                                        onInput="update_sisa(this)" :value="'0'" />
                                </div>
                                <div class="flex-1">
                                    <x-input :label="'Sisa'" :name="'remain_bill'" :placeholder="'Sisa'" :value="$purchase->remain_bill"
                                        :type="'number'" class="bg-slate-100" readonly />
                                </div>
                                <div class="flex-1">
                                    <x-input :label="'Total'" :name="'total_bill'" :placeholder="'Total'" :value="$purchase->total_bill"
                                        :type="'number'" class="bg-slate-100" readonly />
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
    </x-edit-input-field>
@endsection
@push('script')
    <script>
        function setDeliveredComponent(e) {
            if (e.value > e.max) e.value = e.max
            if (e.value < 0) e.value = 0
            const parent = e.parentElement.parentElement.parentElement
            const total = parent.querySelector(".total_component").value
            const remain = total - e.value
            parent.querySelector(".remain_component").value = remain
        }

        function setDeliveredProduct(e) {
            if (e.value > e.max) e.value = e.max
            if (e.value < 0) e.value = 0
            const parent = e.parentElement.parentElement.parentElement
            const total = parent.querySelector(".total_product").value
            const remain = total - e.value
            parent.querySelector(".remain_product").value = remain
        }

        function update_sisa(element) {
            let sisa_sebelumnya = {!! $purchase->remain_bill !!}

            let total = document.querySelector('#total_bill').value || 0;
            let sisa_sekarang = sisa_sebelumnya - element.value;

            if (element.value > sisa_sebelumnya) element.value = sisa_sebelumnya

            sisa_sekarang = sisa_sebelumnya - element.value;
            document.querySelector('#remain_bill').value = sisa_sekarang;
        }

        function total_bayar() {
            const bills = document.querySelectorAll('.bayar');

            let total = Array.from(bills).map(bill => parseInt(bill.innerText.replace(/[^0-9\.,]/g, '').replace(/\./g,
                '').replace(',', '.'))).reduce((acc, curr) =>
                acc + curr)

            Array.from(document.querySelectorAll('.total_bayar')).map(el => el.innerText = toRupiah(total));
        }

        total_bayar()
    </script>
@endpush
