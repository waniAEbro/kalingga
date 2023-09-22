@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Edit Sales</h1>

    <x-edit-input-field :action="'sales'" :items="$sales" :width="'w-full'">
        <div class="flex gap-5">
            <div>
                <x-input-text type="date" :name="'sale_date'" :label="'Sale Date'" :value="$sales->sale_date" readonly
                    class="mb-3 bg-slate-100" />
                <x-input-text type="date" :name="'due_date'" :label="'Due Date'" :value="$sales->due_date" readonly
                    class="mb-3 bg-slate-100" />
                <x-input-text :name="'customer_name'" :label="'Customer Name'" :value="$sales->customer->name" readonly class="mb-3 bg-slate-100" />
                <x-input-text :name="'customer_address'" :label="'Customer Address'" :value="$sales->customer->address" readonly class="mb-3 bg-slate-100" />
                <x-input-text :name="'customer_email'" :label="'Customer Email'" :value="$sales->customer->email" readonly class="mb-3 bg-slate-100" />
                <x-input-text :name="'customer_phone'" :label="'Customer Phone'" :value="$sales->customer->phone" readonly class="mb-3 bg-slate-100" />
                <x-input-text :name="'code'" :type="'number'" :label="'Code'" :value="$sales->code" readonly
                    class="bg-slate-100" />
            </div>

            <div class="divider divider-horizontal"></div>

            <div class="w-full">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b-2">
                            <th class="p-2">#</th>
                            <th class="p-2">Product</th>
                            <th class="p-2">Amount</th>
                            <th class="p-2">Price per Product</th>
                            <th class="p-2">Total</th>
                        </tr>
                    </thead>
                    <tbody id="salesBody">
                        @foreach ($sales->product as $product)
                            <tr id="tr" x-data="{ subtotal: 0, unit: 0, price: 0 }" class="border-b">
                                <td id="number" class="p-2"></td>
                                <td class="w-40 p-2">{{ $product->name }}</td>
                                <td id="quantity" class="p-2" x-ref="quantity">{{ $product->pivot->quantity }}</td>
                                <td id="price" x-ref="price" class="p-2">{{ $product->sell_price }}</td>
                                <td id="subtotal" class="p-2"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="flex justify-end gap-3 mt-10">
                    <div class="w-40">
                        <x-input-text :label="'Total'" :name="'total_bill'" :placeholder="'Total Bill'" :type="'number'"
                            readonly />
                    </div>
                    <div class="w-40">
                        <x-input-text :label="'Paid'" :name="'paid'" :placeholder="'Paid'" :value="$sales->paid"
                            :type="'number'" onInput="update_bill(this)" />
                    </div>
                </div>
            </div>
        </div>
    </x-edit-input-field>
@endsection
@push('script')
    <script>
        function set_number() {
            const numbers = document.querySelectorAll('#number');
            numbers.forEach((number, i) => number.innerText = i + 1)
        }

        function set_subtotal() {
            const trs = document.querySelectorAll('#tr');

            trs.forEach(tr => {
                let quantity = tr.querySelector('#quantity').textContent;
                let price = tr.querySelector('#price').textContent;
                let subtotal = tr.querySelector('#subtotal');
                subtotal.textContent = parseInt(price) * parseInt(quantity);
            })

            set_total();
        }

        function set_total() {
            let subtotals = document.querySelectorAll('#subtotal');
            let total = 0;
            subtotals.forEach(subtotalElement => {
                let subtotalValue = parseFloat(subtotalElement.textContent);
                total += isNaN(subtotalValue) ? 0 : subtotalValue;

                document.querySelector('#total_bill').value = total;
            })
        }

        function update_bill(element) {
            let total = document.querySelector('#total_bill').value;
            if (parseInt(element.value) >= parseInt(total)) {
                element.value = total
            } else if (parseInt(element.value) <= 0) {
                element.value = 0
            }
        }

        set_number();
        set_subtotal();
    </script>
@endpush
