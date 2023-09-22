@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Edit Purchases</h1>

    <x-edit-input-field :action="'purchases'" :items="$purchase" :width="'w-full'">
        <div class="flex gap-5">
            <div>
                <x-input-text type="date" :name="'purchase_date'" :label="'Purchase Date'" :value="$purchase->purchase_date" readonly
                    class="mb-3 bg-slate-100" />
                <x-input-text type="date" :name="'due_date'" :label="'Due Date'" :value="$purchase->due_date" readonly
                    class="mb-3 bg-slate-100" />
                <x-input-text :name="'supplier_name'" :label="'Supplier Name'" :value="$purchase->supplier->name" readonly class="mb-3 bg-slate-100" />
                <x-input-text :name="'supplier_address'" :label="'Supplier Address'" :value="$purchase->supplier->address" readonly class="mb-3 bg-slate-100" />
                <x-input-text :name="'supplier_email'" :label="'Supplier Email'" :value="$purchase->supplier->email" readonly class="mb-3 bg-slate-100" />
                <x-input-text :name="'supplier_phone'" :label="'Supplier Phone'" :value="$purchase->supplier->phone" readonly class="mb-3 bg-slate-100" />
                <x-input-text :name="'code'" :type="'number'" :label="'Code'" :value="$purchase->code" readonly
                    class="bg-slate-100" />
            </div>

            <div class="divider divider-horizontal"></div>

            <div class="w-full">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b-2">
                            <th class="p-2">#</th>
                            <th class="p-2">Component</th>
                            <th class="p-2">Amount</th>
                            <th class="p-2">Unit</th>
                            <th class="p-2">Price per Product</th>
                            <th class="p-2">Total</th>
                        </tr>
                    </thead>
                    <tbody id="purchaseBody">
                        @foreach ($purchase->components as $cs)
                            <tr id="tr" x-data="{ subtotal: 0, unit: 0, price: 0 }" class="border-b">
                                <td id="number" class="p-2"></td>
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

                <div class="flex justify-end gap-3 mt-10">
                    <div class="w-40">
                        <x-input-text :label="'Total'" :name="'total_bill'" :placeholder="'Total Bill'" :type="'number'"
                            readonly />
                    </div>
                    <div class="w-40">
                        <x-input-text :label="'Paid'" :name="'paid'" :placeholder="'Paid'" :value="$purchase->paid"
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

                console.log(subtotalElement.textContent)
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

        set_subtotal();
        set_number();
    </script>
@endpush
