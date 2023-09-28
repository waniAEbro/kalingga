@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Edit Sales</h1>

    <x-edit-input-field :action="'sales'" :items="$sales" :width="'w-full'" :sisa="$sales->remain_bill">
        <div class="flex gap-5">
            <div>
                <x-input type="date" :name="'sale_date'" :label="'Sale Date'" :value="$sales->sale_date" readonly
                    class="mb-3 bg-slate-100" />
                <x-input type="date" :name="'due_date'" :label="'Due Date'" :value="$sales->due_date" readonly
                    class="mb-3 bg-slate-100" />
                <x-input :name="'customer_name'" :label="'Customer Name'" :value="$sales->customer->name" readonly class="mb-3 bg-slate-100" />
                <x-input :name="'customer_address'" :label="'Customer Address'" :value="$sales->customer->address" readonly class="mb-3 bg-slate-100" />
                <x-input :name="'customer_email'" :label="'Customer Email'" :value="$sales->customer->email" readonly class="mb-3 bg-slate-100" />
                <x-input :name="'customer_phone'" :label="'Customer Phone'" :value="$sales->customer->phone" readonly class="mb-3 bg-slate-100" />
                <x-input :name="'code'" :type="'text'" :label="'Code'" :value="$sales->code" readonly
                    class="bg-slate-100" />
            </div>

            <div class="divider divider-horizontal"></div>

            <div class="w-full text-sm">
                <h1 class="mb-5 text-lg font-bold">Produk</h1>

                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b-2">
                            <th class="p-2">#</th>
                            <th class="p-2">Produk</th>
                            <th class="p-2">Jumlah</th>
                            <th class="p-2">Harga Per Produk</th>
                            <th class="p-2">Total</th>
                        </tr>
                    </thead>
                    <tbody id="salesBody">
                        @foreach ($sales->product as $product)
                            <tr id="tr" x-data="" class="border-b">
                                <td id="number" class="p-2"></td>
                                <td class="w-40 p-2">{{ $product->name }}</td>
                                <td id="quantity" class="p-2" x-ref="quantity">{{ $product->pivot->quantity }}</td>
                                <td id="price" x-ref="price" class="p-2 rupiah">{{ $product->sell_price }}</td>
                                <td class="p-2 rupiah"
                                    x-text="toRupiah(parseInt($refs.quantity.innerText) * parseInt($refs.price.innerText.replace(/[^0-9\.,]/g, '').replace(/[^0-9\.,]/g, '').replace(/\./g,
                    '').replace(',', '.')))">
                                    {{ $sales->total_bill }}</td>
                            </tr>
                        @endforeach
                        @if (!$sales->remain_bill)
                            <tr id="tr" x-data="" class="border-b">
                                <td id="number" class="p-2"></td>
                                <td class="w-40 p-2"></td>
                                <td id="quantity" class="p-2" x-ref="quantity"></td>
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
                            @foreach ($sales->histories as $i => $history)
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
                                <td class="p-2 font-bold total_bayar rupiah"></td>
                                <td class="p-2"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="flex justify-end w-full gap-5 mt-10">
                    @if ($sales->remain_bill)
                        <div class="w-40">
                            <x-input :label="'Bayar'" :name="'paid'" :placeholder="'Bayar'" :type="'number'"
                                onInput="update_sisa(this)" class="mb-3" required />
                        </div>
                        <div class="w-40">
                            <x-input :label="'Sisa'" :name="'remain_bill'" :placeholder="'Sisa'" :value="$sales->remain_bill"
                                :type="'number'" class="mb-3" readonly />
                        </div>
                        <div class="w-40">
                            <x-input :label="'Total'" :name="'total_bill'" :placeholder="'Total'" :value="$sales->total_bill"
                                :type="'number'" readonly />
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
            let sisa_sebelumnya = {!! $sales->remain_bill !!}

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
