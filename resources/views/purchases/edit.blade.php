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
            </div>

            <div class="divider divider-horizontal"></div>

            <div class="w-full">
                <h1 class="mb-5 text-lg font-bold">Komponen</h1>

                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b-2">
                            <th class="p-2">#</th>
                            <th class="p-2">Komponen</th>
                            <th class="p-2">Jumlah</th>
                            <th class="p-2">Unit</th>
                            <th class="p-2">Harga Per Produk</th>
                            <th class="p-2">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="purchaseBody">
                        @foreach ($purchase->components as $i => $cs)
                            <tr id="tr" x-data="" class="border-b">
                                <td id="number" class="p-2">{{ $i + 1 }}</td>
                                <td class="w-40 p-2">{{ $cs->name }}</td>
                                <td id="quantity" class="p-2" x-ref="quantity">{{ $cs->pivot->quantity }}</td>
                                <td id="unit" class="p-2">{{ $cs->unit }}</td>
                                <td id="price" x-ref="price" class="p-2 rupiah">{{ $cs->price_per_unit }}</td>
                                <td id="subtotal"
                                    x-text="toRupiah(parseInt($refs.quantity.innerText) * parseInt($refs.price.innerText.replace(/[^0-9\.,]/g, '').replace(/[^0-9\.,]/g, '').replace(/\./g,
                    '').replace(',', '.')))"
                                    class="p-2"></td>
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

                <div class="flex justify-end w-full gap-5 mt-10">
                    @if ($purchase->remain_bill)
                        <div class="w-40">
                            <x-input :label="'Bayar'" :name="'paid'" :placeholder="'Bayar'" :type="'number'"
                                onInput="update_sisa(this)" />
                        </div>
                        <div class="w-40">
                            <x-input :label="'Sisa'" :name="'remain_bill'" :placeholder="'Sisa'" :value="$purchase->remain_bill"
                                :type="'number'" class="bg-slate-100" readonly />
                        </div>
                        <div class="w-40">
                            <x-input :label="'Total'" :name="'total_bill'" :placeholder="'Total'" :value="$purchase->total_bill"
                                :type="'number'" class="bg-slate-100" readonly />
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </x-edit-input-field>
@endsection
@push('script')
    <script>
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
