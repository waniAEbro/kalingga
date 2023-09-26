@extends('layouts.layout')

@section('content')
    {{-- @dd($purchase->histories[0]->created_at) --}}
    <h1 class="text-lg font my-7 font-[500]">Edit Purchases</h1>

    <x-edit-input-field :action="'purchases'" :items="$purchase" :width="'w-full'">
        <div class="flex gap-5">
            <div>
                <x-input type="date" :name="'purchase_date'" :label="'Purchase Date'" :value="$purchase->purchase_date" readonly
                    class="mb-3 bg-slate-100" />
                <x-input type="date" :name="'due_date'" :label="'Due Date'" :value="$purchase->due_date" readonly
                    class="mb-3 bg-slate-100" />
                <x-input :name="'supplier_name'" :label="'Supplier Name'" :value="$purchase->supplier->name" readonly class="mb-3 bg-slate-100" />
                <x-input :name="'supplier_address'" :label="'Supplier Address'" :value="$purchase->supplier->address" readonly class="mb-3 bg-slate-100" />
                <x-input :name="'supplier_email'" :label="'Supplier Email'" :value="$purchase->supplier->email" readonly class="mb-3 bg-slate-100" />
                <x-input :name="'supplier_phone'" :label="'Supplier Phone'" :value="$purchase->supplier->phone" readonly class="mb-3 bg-slate-100" />
                <x-input :name="'code'" :type="'text'" :label="'Code'" :value="$purchase->code" readonly
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
                            <th class="p-2">Total</th>
                        </tr>
                    </thead>
                    <tbody id="purchaseBody">
                        @foreach ($purchase->components as $i => $cs)
                            <tr id="tr" x-data="{ subtotal: 0, unit: 0, price: 0 }" class="border-b">
                                <td id="number" class="p-2">{{ $i + 1 }}</td>
                                <td class="w-40 p-2">{{ $cs->name }}</td>
                                <td id="quantity" class="p-2" x-ref="quantity">{{ $cs->pivot->quantity }}</td>
                                <td id="unit" class="p-2">{{ $cs->unit }}</td>
                                <td id="price" x-ref="price" class="p-2">{{ $cs->price_per_unit_buy }}</td>
                                <td id="subtotal" class="p-2">
                                </td>
                            </tr>
                        @endforeach
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
                                    <td class="p-2 bayar">{{ $history->payment }}</td>
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
                    <div class="w-40">
                        <x-input :label="'Bayar'" :name="'paid'" :placeholder="'Bayar'" :type="'number'"
                            onInput="update_sisa(this)" class="mb-3" />
                    </div>
                    <div class="w-40">
                        <x-input :label="'Sisa'" :name="'remain_bill'" :placeholder="'Sisa'" :value="$purchase->remain_bill"
                            :type="'number'" class="mb-3" readonly />
                    </div>
                    <div class="w-40">
                        <x-input :label="'Total'" :name="'total_bill'" :placeholder="'Total'" :value="$purchase->total_bill"
                            :type="'number'" readonly />
                    </div>
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

            let total = Array.from(bills).map(bill => parseInt(bill.innerText)).reduce((acc, curr) => acc + curr)

            document.querySelector('.total_bayar').innerText = total;
        }

        total_bayar()
    </script>
@endpush
