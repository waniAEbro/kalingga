@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Create Sales</h1>

    <x-create-input-field :action="'sales'" :width="'w-full'">
        <div class="flex gap-5">
            <div>
                <label for="sale_date" class="block text-sm">Sale Date</label>
                <x-input-text type="date" :name="'sale_date'" class="mb-3" />

                <label for="due_date" class="block text-sm">Due Date</label>
                <x-input-text type="date" :name="'due_date'" class="mb-3" />

                <label for="customer_id" class="block text-sm">Customer</label>
                <div class="w-40 mt-2 mb-3">
                    <x-ngetes :dataLists="$customers->toArray()" :name="'customer_id'" :id="'customer_id'" />
                </div>

                <x-input-text :name="'code'" :type="'number'" :label="'Code'" class="mb-3" />
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
                            <th class="p-2"></th>
                        </tr>
                    </thead>
                    <tbody id="saleBody">
                        <tr x-data="{ sale: $el }" class="border-b">
                            <td id="number" class="p-2"></td>
                            <td class="w-40 p-2">
                                <x-ngetes x-on:click="getProduct(sale); $nextTick(); set_subtotal($refs.quantity)"
                                    :dataLists="$products->toArray()" :name="'product_id[]'" :id="'product_id'" />
                            </td>
                            <td class="p-2"><input x-ref="quantity" type="number" name="quantity[]"
                                    onchange="set_subtotal(this)" value="0"
                                    class="w-16 px-2 py-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300">
                            </td>
                            <td id="price" class="p-2"></td>
                            <td id="subtotal" class="p-2"></td>
                            <td class="p-2">
                                <button type="button" x-on:click="sale.remove(); set_total(); set_number()"
                                    class="transition-all duration-300 rounded-full hover:bg-slate-100 active:bg-slate-200"><span
                                        class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <button type="button" x-data x-on:click="addNew(); set_number()"
                    class="flex justify-center w-full py-2 text-sm transition duration-300 border-b border-dashed border-x hover:bg-slate-50 active:bg-sky-100">Add
                    New</button>

                <div class="flex justify-end gap-3 mt-10">
                    <div class="w-40">
                        <x-input-text :label="'Total'" :name="'total_bill'" :placeholder="'Total Bill'" :type="'number'"
                            readonly />
                    </div>
                    <div class="w-40">
                        <x-input-text :label="'Paid'" :name="'paid'" :placeholder="'Paid'" :type="'number'"
                            onInput="update_bill(this)" />
                    </div>
                </div>
            </div>
        </div>
    </x-create-input-field>
@endsection
@push('script')
    <script>
        function getProduct(tr) {

            let products = {!! $products !!};
            const productId = tr.querySelector('#product_id');

            if (productId.value) {
                const product = products.find(product => product.id == productId.value)
                const price = tr.querySelector('#price').innerText = product.sell_price;
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
                                        <x-ngetes x-on:click="getProduct(sale); $nextTick(); set_subtotal($refs.quantity)"
                                            :dataLists="$products->toArray()" :name="'product_id[]'" :id="'product_id'" />
                                    </td>
                                    <td class="p-2"><input x-ref="quantity" type="number" name="quantity[]"
                                            onchange="set_subtotal(this)" value="0"
                                            class="w-16 px-2 py-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300">
                                    </td>
                                    <td id="price" class="p-2"></td>
                                    <td id="subtotal" class="p-2"></td>
                                    <td class="p-2">
                                        <button type="button" x-on:click="sale.remove(); set_total(); set_number()"
                                            class="transition-all duration-300 rounded-full hover:bg-slate-100 active:bg-slate-200"><span
                                                class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                                    </td>
                                    `;

            saleBody.appendChild(saleRow);
        }

        function set_subtotal(element) {
            let tr = element.parentElement.parentElement;
            let price = tr.querySelector('#price').textContent;
            let subtotal = tr.querySelector('#subtotal');
            subtotal.textContent = price * element.value;

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
    </script>
@endpush
