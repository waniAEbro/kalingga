@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Create Purchases</h1>

    <x-create-input-field :action="'purchases'" :width="'full'">
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

                <label for="customer_id" class="block text-sm">Supplier</label>
                <div class="w-40 mt-2">
                    <x-select-with-search :dataLists="$suppliers->pluck('name')->toArray()" :name="'supplier_name'" />
                </div>
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
                            <th class="p-2"></th>
                        </tr>
                    </thead>
                    <tbody id="purchaseBody">
                        <tr x-data="{ purchase: $el }" class="border-b">
                            <td class="p-2">1</td>
                            <td class="w-40 p-2">
                                <x-select-with-search x-on:click="await $nextTick(); getComponent()" :dataLists="$components->pluck('name')->toArray()"
                                    :name="'component_name[]'" :id="'component_name'" />
                            </td>
                            <td class="p-2"><input type="number" name="quantity[]" onchange="set_subtotal(this)"
                                    class="w-16 px-2 py-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300">
                            </td>
                            <td id="unit" class="p-2"></td>
                            <td id="price" class="p-2"></td>
                            <td id="subtotal" class="p-2"></td>
                            <td class="p-2">
                                <button type="button" x-on:click="purchase.remove(); set_total()"
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
    {{-- <div x-data="data()" class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <form method="POST" action="/purchases">
            @csrf
            <div class="space-y-12">
                <div class="p-12 border-b border-gray-900/10">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Insert Purchases Data</h2>

                    <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="supplier_id"
                                class="block text-sm font-medium leading-6 text-gray-900">Supplier</label>
                            <div class="mt-2">
                                <select id="supplier_id" name="supplier_id"
                                    class="block w-full p-2 text-gray-900 rounded-sm shadow-sm ring-1 ring-offset-4 ring-gray-300 focus:ring-2 focus:ring-offset-4 focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option value="" selected hidden disabled>
                                        Pilih Supplier
                                    </option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <label for="purchase_date" class="block text-sm font-medium leading-6 text-gray-900">Purchase
                                Date</label>
                            <div class="mt-2">
                                <div
                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="date" name="purchase_date" id="purchase_date"
                                        value="{{ Carbon\Carbon::now()->toDateString() }}"
                                        class="flex-1 block p-2 text-gray-900 bg-transparent border-0 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        placeholder="Purchase Date">
                                </div>
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <label for="due_date" class="block text-sm font-medium leading-6 text-gray-900">Due Date</label>
                            <div class="mt-2">
                                <div
                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="date" name="due_date" id="due_date"
                                        value="{{ Carbon\Carbon::now()->toDateString() }}"
                                        class="flex-1 block p-2 text-gray-900 bg-transparent border-0 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        placeholder="Due Date">
                                </div>
                            </div>
                        </div>
                        <div class="overflow-x-auto rounded-lg shadow-md col-span-full">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            <div class="flex items-center">
                                                Component
                                                <a href="#" @click="sortByColumn"><svg class="w-3 h-3 ml-1.5"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                                    </svg></a>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            <div class="flex items-center">
                                                Jumlah
                                                <a href="#" @click="sortByColumn"><svg class="w-3 h-3 ml-1.5"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                                    </svg></a>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            <div class="flex items-center">
                                                Satuan
                                                <a href="#" @click="sortByColumn"><svg class="w-3 h-3 ml-1.5"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                                    </svg></a>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            <div class="flex items-center">
                                                Harga Satuan
                                                <a href="#" @click="sortByColumn"><svg class="w-3 h-3 ml-1.5"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                                    </svg></a>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            <div class="flex items-center">
                                                Total
                                                <a href="#" @click="sortByColumn"><svg class="w-3 h-3 ml-1.5"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                                    </svg></a>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            <div class="flex items-center">
                                                Action
                                                <a href="#" @click="sortByColumn"><svg class="w-3 h-3 ml-1.5"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                                    </svg></a>
                                            </div>
                                        </th>

                                    </tr>
                                </thead>
                                <tbody x-ref="tbody" id="components">
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4">
                                            <select id="component_id" name="component_id[]"
                                                onchange="set_component(this)"
                                                class="block w-full p-2 text-gray-900 border-0 rounded-md shadow-sm ring-1 ring-offset-4 ring-gray-300 focus:ring-2 focus:ring-offset-4 focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                <option value="" selected hidden disabled>
                                                    Pilih Komponen
                                                </option>
                                                @foreach ($components as $component)
                                                    <option value="{{ $component->id }}">{{ $component->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="px-6 py-4">
                                            <input type="number" name="quantity[]" id="quantity"
                                                onchange="set_subtotal(this)"
                                                class="flex-1 block p-2 border-0 focus:ring-0" placeholder="0"
                                                value="0">
                                        </td>
                                        <td class="px-6 py-4">
                                            <p id="unit">unit</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <p id="price">0</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <p id="subtotal">0</p>
                                        </td>
                                        <td class="gap-2 py-4">
                                            <button onclick="delete_element(this)" type="button">hapus</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="flex items-center justify-end m-6 gap-x-6">
                        <label for="total_bill">Total</label>
                        <input type="number" name="total_bill" id="total_bill" value="0" readonly>
                    </div>
                    <div class="flex items-center justify-end m-6 gap-x-6">
                        <label for="paid">Bayar</label>
                        <input type="number" name="paid" id="paid" value="0">
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end m-6 gap-x-6">
                <a href="/purchases">
                    <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                </a>
                <button type="submit"
                    class="px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>
        </form>
    </div> --}}
@endsection
@push('script')
    <script>
        function getComponent() {

            let components = {!! $components !!};
            const componentName = document.querySelectorAll('#component_name');

            const units = document.querySelectorAll('#unit')
            const prices = document.querySelectorAll('#price')

            for (let i = 0; i < prices.length; i++) {
                const component = components.find(component => component.name === componentName[i].value)
                units[i].innerText = component.unit;
                prices[i].innerText = component.price_per_unit_buy;
            }
            // console.log(componentName)
            // units.forEach(unit => console.log(component.unit))
            // prices.forEach(price => price.innerText = component.price)
        }

        let i = 2;

        function addNew() {
            const purchaseBody = document.getElementById('purchaseBody');
            const purchaseRow = document.createElement('tr');
            purchaseRow.setAttribute('x-data', '{ purchase: $el }')
            purchaseRow.className = 'border-b';
            purchaseRow.innerHTML = `
                                    <td class="p-2">${i}</td>
                                    <td class="w-40 p-2">
                                        <x-select-with-search x-on:click="await $nextTick(); getComponent()" :dataLists="$components->pluck('name')->toArray()"
                                            :name="'component_name[]'" :id="'component_name'" />
                                    </td>
                                    <td class="p-2"><input type="number" name="quantity[]" onchange="set_subtotal(this)"
                                            class="w-16 px-2 py-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300">
                                    </td>
                                    <td id="unit" class="p-2"></td>
                                    <td id="price" class="p-2"></td>
                                    <td id="subtotal" class="p-2"></td>
                                    <td class="p-2">
                                        <button type="button" x-on:click="purchase.remove(); set_total()"
                                            class="transition-all duration-300 rounded-full hover:bg-slate-100 active:bg-slate-200"><span
                                                class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
                                    </td>
                        `;

            purchaseBody.appendChild(purchaseRow);
            i++;

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
