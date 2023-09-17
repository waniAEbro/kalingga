@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Create Sales</h1>

    <x-create-input-field :action="'sales'" :width="'full'">
        <div class="flex gap-5">
            <div>
                <label for="sale_date" class="block text-sm">Transaction Date</label>
                <div class="relative mt-2 mb-3 outline-none focus:outline-none w-fit" data-te-datepicker-init
                    data-te-inline="true" data-te-input-wrapper-init>
                    <input id="sale_date" name="sale_date" type="text"
                        class="w-40 px-4 py-2 transition-all duration-100 rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300"
                        placeholder="Select a date" />
                </div>

                <label for="due_date" class="block text-sm">Due Date</label>
                <div class="relative mt-2 mb-3 w-fit" data-te-datepicker-init data-te-inline="true"
                    data-te-input-wrapper-init>
                    <input id="due_date" name="due_date" type="text"
                        class="w-40 px-4 py-2 transition-all duration-100 rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300"
                        placeholder="Select a date" />
                </div>

                <label for="customer_id" class="block text-sm">Customer</label>
                <div class="w-40 mt-2">
                    <x-select-with-search :dataLists="$customersName" :name="'customer_name'" />
                </div>
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
                    <tbody id="salesBody">
                        <tr x-data="{ sale: $el }" class="border-b">
                            <td class="p-2">1</td>
                            <td class="w-40 p-2">
                                <x-select-with-search :dataLists="$justArray" :name="'product_id[]'" />
                            </td>
                            <td class="p-2"><input type="number" name="quantity[]" onchange="set_subtotal(this)"
                                    class="w-16 px-2 py-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300">
                            </td>
                            <td id="price" class="p-2">9000</td>
                            <td id="subtotal" class="p-2"></td>
                            <td class="p-2">
                                <button type="button" x-on:click="sale.remove(); set_total()"
                                    class="transition-all duration-300 rounded-full hover:bg-slate-100 active:bg-slate-200"><span
                                        class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <button type="button" x-data x-on:click="addNew"
                    class="flex justify-center w-full py-2 text-sm transition duration-300 border-b border-dashed border-x hover:bg-slate-50 active:bg-sky-100">Add
                    New</button>

                <div class="flex justify-end gap-3 mt-10">
                    <div class="w-40">
                        <x-input-text :label="'Total'" :name="'total_bill'" :placeholder="'Total Bill'" :type="'number'" readonly />
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
        function addNew() {
            const salesBody = document.getElementById('salesBody');
            const salesRow = document.createElement('tr');
            salesRow.setAttribute('x-data', '{ sale: $el }')
            salesRow.className = 'border-b';
            salesRow.innerHTML = `
                                <td class="p-2">1</td>
                                <td class="w-40 p-2">
                                    <x-select-with-search :dataLists="$justArray" :name="'product_id[]'" />
                                </td>
                                <td class="p-2"><input type="number" name="quantity[]" onchange="set_subtotal(this)"
                                        class="w-16 px-2 py-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300">
                                </td>
                                <td id="price" class="p-2">9000</td>
                                <td id="subtotal" class="p-2"></td>
                                <td class="p-2">
                                    <button type="button" x-on:click="sale.remove(); set_total()"
                                        class="transition-all duration-300 rounded-full hover:bg-slate-100 active:bg-slate-200"><span
                                            class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                                </td>
                        `;

            salesBody.appendChild(salesRow);

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
                total += parseFloat(subtotalElement.textContent);
            });
            document.querySelector('#total_bill').value = total;
        }
    </script>
@endpush
