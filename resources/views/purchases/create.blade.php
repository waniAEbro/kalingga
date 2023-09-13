@extends('layouts.layout')

@section('content')
    <div x-data="data()" class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <form method="POST" action="/purchases">
            @csrf
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 p-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Insert Purchases Data</h2>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="supplier_id"
                                class="block text-sm font-medium leading-6 text-gray-900">Supplier</label>
                            <div class="mt-2">
                                <select id="supplier_id" name="supplier_id"
                                    class="block w-full rounded-sm p-2 text-gray-900 shadow-sm ring-1 ring-offset-4 ring-gray-300 focus:ring-2 focus:ring-offset-4 focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
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
                                        class="block flex-1 border-0 bg-transparent p-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
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
                                        class="block flex-1 border-0 bg-transparent p-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        placeholder="Due Date">
                                </div>
                            </div>
                        </div>
                        <div class=" col-span-full overflow-x-auto shadow-md rounded-lg">
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
                                                class="block w-full rounded-md border-0 p-2 text-gray-900 shadow-sm ring-1 ring-offset-4 ring-gray-300 focus:ring-2 focus:ring-offset-4 focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
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
                                                class="block flex-1 border-0 p-2 focus:ring-0" placeholder="0"
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
                    <div class="m-6 flex items-center justify-end gap-x-6">
                        <label for="total_bill">Total</label>
                        <input type="number" name="total_bill" id="total_bill" value="0" readonly>
                    </div>
                    <div class="m-6 flex items-center justify-end gap-x-6">
                        <label for="paid">Bayar</label>
                        <input type="number" name="paid" id="paid" value="0">
                    </div>
                </div>
            </div>

            <div class="m-6 flex items-center justify-end gap-x-6">
                <a href="/purchases">
                    <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                </a>
                <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>
        </form>
    </div>
@endsection
@push('script')
    <script>
        let components = {!! $components !!}

        let components_element = document.getElementById('components');

        function set_component(element) {
            let component = components.find(component => component.id == element.value);
            let tr = element.parentElement.parentElement;
            let price = tr.querySelector('#price');
            let unit = tr.querySelector('#unit');
            price.textContent = component.price_per_unit;
            unit.textContent = component.unit;

            let newElement = `
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4">
                                            <select id="component_id" name="component_id[]"
                                                onchange="set_component(this)"
                                                class="block w-full rounded-md border-0 p-2 text-gray-900 shadow-sm ring-1 ring-offset-4 ring-gray-300 focus:ring-2 focus:ring-offset-4 focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
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
                                                class="block flex-1 border-0 p-2 focus:ring-0" placeholder="0"
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
                                    </tr>`;

            components_element.insertAdjacentHTML('beforeend', newElement);
        }

        function set_subtotal(element) {
            let tr = element.parentElement.parentElement;
            let price = tr.querySelector('#price').textContent;
            let subtotal = tr.querySelector('#subtotal');
            subtotal.textContent = price * element.value;

            let subtotals = document.querySelectorAll('#subtotal');
            let total = 0;
            subtotals.forEach(subtotalElement => {
                total += parseFloat(subtotalElement.textContent);
            });
            document.querySelector('#total_bill').value = total;
        }

        function delete_element(element) {
            element.parentElement.parentElement.remove();
        }
    </script>
@endpush
