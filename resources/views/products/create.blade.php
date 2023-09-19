@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Create Product</h1>

    <x-create-input-field :action="'purchases'" :width="'full'">
        <div class="">
            <div>

            </div>

            <div class="my-5 divider divider-vertival"></div>

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
                            <th class="p-2"></th>
                        </tr>
                    </thead>
                    <tbody id="purchaseBody">
                        <tr x-data="{ purchase: $el }" class="border-b">
                            <td id="number" class="p-2"></td>
                            <td class="w-40 p-2">
                                <x-ngetes x-on:click="getComponent(purchase); $nextTick(); set_subtotal($refs.quantity)"
                                    :dataLists="$components->toArray()" :name="'component_id[]'" :id="'component_id'" />
                            </td>
                            <td class="p-2"><input x-ref="quantity" type="number" name="quantity[]"
                                    onchange="set_subtotal(this)" value="0"
                                    class="w-16 px-2 py-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300">
                            </td>
                            <td id="unit" class="p-2"></td>
                            <td id="price" class="p-2"></td>
                            <td id="subtotal" class="p-2"></td>
                            <td class="p-2">
                                <button type="button" x-on:click="purchase.remove(); set_total(); set_number()"
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
                        <x-input-text :label="'Total'" :name="'total_bill'" :placeholder="'Total Bill'" :type="'number'" readonly
                            x-ref="total" />
                    </div>
                    <div class="w-40">
                        <x-input-text :label="'Paid'" :name="'paid'" :placeholder="'Paid'" :type="'number'" />
                    </div>
                </div>
            </div>
        </div>
    </x-create-input-field>
@endsection
@push('script')
    <script>
        function getComponent(tr) {

            let components = {!! $components !!};
            const componentId = tr.querySelector('#component_id');

            if (componentId.value) {
                const component = components.find(component => component.id == componentId.value)
                const unit = tr.querySelector('#unit').innerText = component.unit;
                const price = tr.querySelector('#price').innerText = component.price_per_unit_buy;
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
            const purchaseBody = document.getElementById('purchaseBody');
            const purchaseRow = document.createElement('tr');
            purchaseRow.setAttribute('x-data', '{ purchase: $el }')
            purchaseRow.className = 'border-b';
            purchaseRow.innerHTML = `
                                        <td id="number" class="p-2"></td>
                                        <td class="w-40 p-2">
                                            <x-ngetes x-on:click="getComponent(purchase); await $nextTick(); set_subtotal($refs.quantity)" :dataLists="$components->toArray()"
                                                :name="'component_id[]'" :id="'component_id'" />
                                        </td>
                                        <td class="p-2"><input x-ref="quantity" type="number" name="quantity[]"
                                                onchange="set_subtotal(this)" value="0"
                                                class="w-16 px-2 py-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300">
                                        </td>
                                        <td id="unit" class="p-2"></td>
                                        <td id="price" class="p-2"></td>
                                        <td id="subtotal" class="p-2"></td>
                                        <td class="p-2">
                                            <button type="button" x-on:click="purchase.remove(); set_total(); set_number()"
                                                class="transition-all duration-300 rounded-full hover:bg-slate-100 active:bg-slate-200"><span
                                                    class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                                        </td>
                                    `;

            purchaseBody.appendChild(purchaseRow);
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

        document.querySelector("#paid input").addEventListener("change", (element) => {
            console.log("halo")
            let total = document.querySelector('#total_bill').value;
            if (element.value >= total) {
                element.value = total
            } else if (element.value <= 0) {
                element.value = 0
            }
        })
    </script>
@endpush
