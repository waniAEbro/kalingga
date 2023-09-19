@extends('layouts.layout')

@section('content')
    {{-- @dd($purchase->supplier) --}}
    <h1 class="text-lg font my-7 font-[500]">Create Purchases</h1>

    <x-edit-input-field :action="'purchases'" :items="$purchase" :width="'full'">
        <div class="flex gap-5">
            <div>
                <label for="purchase_date" class="block text-sm">Purchase Date</label>
                <x-input-text type="date" :name="'purchase_date'" :value="$purchase->purchase_date" readonly class="mb-3 bg-slate-100" />

                <label for="due_date" class="block text-sm">Due Date</label>
                <x-input-text type="date" :name="'due_date'" :value="$purchase->due_date" readonly class="mb-3 bg-slate-100" />

                <label for="customer_id" class="block text-sm">Supplier</label>
                <div class="w-40 mt-2 mb-3">
                    <x-input-text :name="'supplier_address'" :label="'Supplier Address'" :value="$purchase->supplier->name" readonly
                        class="mb-3 bg-slate-100" />

                    {{-- <x-ngetes readonly x-on:click="getSupplier()" x-init="await $nextTick;
                    getSupplier()" :value="$supplier->id" :label="$supplier->name"
                        :dataLists="$suppliers->toArray()" :name="'supplier_id'" :id="'supplier_id'" /> --}}
                </div>

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
                                <td class="w-40 p-2">{{ $cs->name }}
                                    {{-- <x-ngetes x-on:click="getComponent(purchase); $nextTick(); set_subtotal($refs.quantity)"
                                        x-init="getComponent(purchase);
                                        $nextTick();
                                        set_subtotal($refs.quantity)" :dataLists="$components->toArray()" :value="$cs->component_id" :name="'component_id[]'"
                                        :label="$cs->name" :id="'component_id'" /> --}}
                                </td>
                                <td id="quantity" class="p-2" x-ref="quantity">{{ $cs->pivot->quantity }}
                                    {{-- <input x-ref="quantity" type="number" name="quantity[]" onchange="set_subtotal(this)"
                                        value="{{ $cs->quantity }}"
                                        class="w-16 px-2 py-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300"> --}}
                                </td>
                                <td id="unit" class="p-2">{{ $cs->unit }}</td>
                                <td id="price" x-ref="price" class="p-2">{{ $cs->price_per_unit_buy }}</td>
                                <td id="subtotal" class="p-2">
                                </td>

                            </tr>
                        @endforeach
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
                        <x-input-text :label="'Paid'" :name="'paid'" :placeholder="'Paid'" :value="$purchase->paid"
                            :type="'number'" />
                    </div>
                </div>
            </div>
        </div>
    </x-edit-input-field>
@endsection
@push('script')
    <script>
        function editComponent() {
            const purchaseBody = document.querySelector('#purchaseBody');

            purchaseBody.innerHTML = '<div></div>'
        }

        function getSupplier() {
            let suppliers = {!! $suppliers !!}
            const supplierId = document.getElementById('supplier_id')
            const supplier = suppliers.find(supplier => supplier.id == supplierId.value)
            // suppliers.forEach(supplier => console.log(supplier.id))
            console.log(supplierId.value)
            // console.log(supplier)

            const supplierAddress = document.getElementById('supplier_address').value = supplier.address;
            const supplierEmail = document.getElementById('supplier_email').value = supplier.email;
            const supplierPhone = document.getElementById('supplier_phone').value = supplier.phone;
        }

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

        function set_subtotal() {
            // let tr = element.parentElement.parentElement;
            const trs = document.querySelectorAll('#tr');

            trs.forEach(tr => {
                let quantity = tr.querySelector('#quantity').textContent;
                let price = tr.querySelector('#price').textContent;
                let subtotal = tr.querySelector('#subtotal');
                subtotal.textContent = parseInt(price) * parseInt(quantity);
            })

            set_total();
        }

        set_subtotal();

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
    </script>
@endpush
