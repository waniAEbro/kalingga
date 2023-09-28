@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Edit Product</h1>

    <x-edit-input-field :action="'products'" :items="$product" :width="'full'">
        <div class="flex w-full gap-3 px-">
            <div class="w-full">
                <h1 class="mb-3 text-xl font-bold">Product</h1>
                <div class="flex gap-3">
                    <div class="w-full">
                        <x-input-text :label="'Name'" :name="'name'" class="mb-3" :value="$product->name" />
                        <x-input-text :label="'Code'" :name="'code'" :type="'text'" class="mb-3"
                            :value="$product->code" />
                        <x-input-text :label="'Barcode'" :name="'barcode'" :type="'number'" class="mb-3"
                            :value="$product->barcode" />
                        <x-input-text :label="'Length'" :name="'length'" :type="'number'" class="mb-3"
                            :value="$product->length" />
                        <x-input-text :label="'Height'" :name="'height'" :type="'number'" class="mb-3"
                            :value="$product->height" />
                        <x-input-text :label="'Production Cost'" :name="'production_cost'" :type="'number'" :value="$product->production_cost" />

                    </div>
                    <div class="w-full">
                        <x-input-text :label="'Logo'" :name="'logo'" class="mb-3" :value="$product->logo" />
                        <x-input-text :label="'RFID Code'" :name="'rfid'" :type="'number'" class="mb-3"
                            :value="$product->rfid" />
                        <x-input-text :label="'Width'" :name="'width'" :type="'number'" class="mb-3"
                            :value="$product->width" />
                        <x-input-text :label="'Other Cost'" :name="'other_cost'" :type="'number'" class="mb-3"
                            :value="$product->other_cost" />
                        <x-input-text :label="'Sell Price'" :name="'sell_price'" :type="'number'" :value="$product->sell_price" />

                    </div>
                </div>
            </div>
            <div class="divider divider-horizontal"></div>
            <div class="w-full">
                <h1 class="mb-3 text-xl font-bold">Pack</h1>
                <div class="flex gap-3">
                    <div class="w-full">
                        <x-input-text :label="'Outer Length'" :name="'pack_outer_length'" :type="'number'" class="mb-3"
                            :value="$product->pack->outer_length" />
                        <x-input-text :label="'Outer Width'" :name="'pack_outer_width'" :type="'number'" class="mb-3"
                            :value="$product->pack->outer_width" />
                        <x-input-text :label="'Outer Height'" :name="'pack_outer_height'" :type="'number'" class="mb-3"
                            :value="$product->pack->outer_height" />
                    </div>
                    <div class="w-full">
                        <x-input-text :label="'Inner Length'" :name="'pack_inner_length'" :type="'number'" class="mb-3"
                            :value="$product->pack->inner_length" />
                        <x-input-text :label="'Inner Width'" :name="'pack_inner_width'" :type="'number'" class="mb-3"
                            :value="$product->pack->inner_width" />
                        <x-input-text :label="'Inner Height'" :name="'pack_inner_height'" :type="'number'" class="mb-3"
                            :value="$product->pack->inner_height" />
                        <x-input-text :label="'Cost'" :name="'pack_cost'" :value="$product->pack->cost" />

                    </div>
                </div>
            </div>
        </div>

        <div class="divider divider-vertival"></div>

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
                    @foreach ($product->components as $cp)
                        <tr x-data="{ purchase: $el }" class="border-b">
                            <td id="number" class="p-2"></td>
                            <td class="w-40 p-2">
                                <x-select :value="$cp->id" :label="$cp->name"
                                    x-on:click="getComponent(purchase); $nextTick(); set_subtotal($refs.quantity)"
                                    :dataLists="$components->toArray()" :name="'component_id[]'" :id="'component_id'" />
                            </td>
                            <td class="p-2"><input step="0.001" x-ref="quantity" type="number" name="quantity[]"
                                    oninput="set_subtotal(this)" value="{{ $cp->pivot->quantity }}"
                                    class="input_quantity w-16 px-2 py-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300">
                            </td>
                            <td id="unit" class="p-2">{{ $cp->unit }}</td>
                            <td id="price" class="p-2">
                                {{ $cp->price_per_unit }} </td>
                            <td id="subtotal" class="p-2"></td>
                            <td class="p-2">
                                <button type="button"
                                    x-on:click="purchase.remove(); await $nextTick; set_total(); set_number()"
                                    class="transition-all duration-300 rounded-full hover:bg-slate-100 active:bg-slate-200"><span
                                        class="p-2 text-red-600 material-symbols-outlined">delete</span></button>
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
                    <x-input-text :label="'Total HPP'" :name="'total_bill'" :placeholder="'Total Bill'" :type="'number'" readonly
                        x-ref="total" />
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
                    const price = tr.querySelector('#price').innerText = component.price_per_unit;
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
                                            <x-select x-on:click="getComponent(purchase); await $nextTick(); set_subtotal($refs.quantity)" :dataLists="$components->toArray()"
                                                :name="'component_id[]'" :id="'component_id'" />
                                        </td>
                                        <td class="p-2"><input step="0.001" x-ref="quantity" type="number" name="quantity[]"
                                                oninput="set_subtotal(this)" value="0"
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

            document.querySelectorAll(".input_quantity").forEach(component => {
                set_subtotal(component)
            })

            function set_total() {
                let subtotals = document.querySelectorAll('#subtotal');
                let total = 0;
                subtotals.forEach(subtotalElement => {
                    let subtotalValue = parseFloat(subtotalElement.textContent);
                    total += isNaN(subtotalValue) ? 0 : subtotalValue;
                })

                let production_cost = parseInt(document.querySelector('#production_cost').value);
                let other_cost = parseInt(document.querySelector('#other_cost').value);
                let pack_cost = parseInt(document.querySelector('#pack_cost').value);

                total += production_cost + other_cost + pack_cost

                document.querySelector('#total_bill').value = total;
            }
        </script>
    @endpush
