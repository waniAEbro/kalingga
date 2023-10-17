@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Create Purchases</h1>

    <x-create-input-field :action="'purchases'" :width="'w-full'">
        <div class="flex gap-5 text-sm">
            <div>
                <label for="purchase_date" class="block text-sm">Tanggal Pembelian</label>
                <x-input type="date" :name="'purchase_date'" :inputParentClass="'mb-3'" :value="old('purchase_date')" />

                <label for="due_date" class="block text-sm">Tanggal Jatuh Tempo</label>
                <x-input type="date" :name="'due_date'" :inputParentClass="'mb-3'" :value="old('due_date')" />

                <label for="supplier_id" class="block text-sm">Pemasok</label>
                <div class="w-40 mt-2 mb-3">
                    <x-select x-on:click="getSupplier" :dataLists="$suppliers->toArray()" :name="'supplier_id'" :id="'supplier_id'" />
                </div>

                <x-input :name="'supplier_address'" :label="'Alamat Pemasok'" readonly class="mb-3 bg-slate-100" />
                <x-input :name="'supplier_email'" :label="'Email Pemasok'" readonly class="mb-3 bg-slate-100" />
                <x-input :name="'supplier_phone'" :label="'No Hp Pemasok'" readonly class="mb-3 bg-slate-100" />
                <x-input :name="'code'" :type="'text'" :label="'Kode Pembelian'" :inputParentClass="'mb-3'" :value="old('code')" />
            </div>

            <div class="divider divider-horizontal"></div>

            <div class="w-full">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b-2">
                            <th class="p-2">#</th>
                            <th class="p-2">Komponen</th>
                            <th class="p-2">Jumlah</th>
                            <th class="p-2">Unit</th>
                            <th class="p-2">Harga Per Produk</th>
                            <th class="p-2">Subtotal</th>
                            <th class="p-2"></th>
                        </tr>
                    </thead>
                    <tbody id="purchaseBody">
                    </tbody>
                </table>

                <button type="button" x-data x-on:click="addNew(); set_number()"
                    class="flex justify-center w-full py-2 text-sm transition duration-300 border-b border-dashed border-x hover:bg-slate-50 active:bg-sky-100">Add
                    New</button>

                <div class="flex justify-end gap-3 mt-10">
                    <div class="w-40">
                        <x-input :label="'Total'" :name="'total_bill'" :placeholder="'Total Bayar'" :type="'number'" readonly />
                    </div>
                    <div class="w-40">
                        <x-input :label="'Bayar'" :name="'paid'" :placeholder="'Bayar'" :type="'number'"
                            :value="old('paid')" oninput="batasBayar(this)" />
                    </div>
                </div>
            </div>
        </div>
    </x-create-input-field>
@endsection
@push('script')
    <script>
        function getSupplier() {
            let suppliers = {!! $suppliers !!}
            const supplierId = document.getElementById('supplier_id')
            const supplier = suppliers.find(supplier => supplier.id == supplierId.value)
            if (supplier) {
                const supplierAddress = document.getElementById('supplier_address').value = supplier.address;
                const supplierEmail = document.getElementById('supplier_email').value = supplier.email;
                const supplierPhone = document.getElementById('supplier_phone').value = supplier.phone;

            } else {
                const supplierAddress = document.getElementById('supplier_address').value = '';
                const supplierEmail = document.getElementById('supplier_email').value = '';
                const supplierPhone = document.getElementById('supplier_phone').value = '';
            }
            document.getElementById("purchaseBody").innerHTML = ""
            components.filter(element => {
                return element.supplier_id == supplierId.value
            }).forEach(element => {
                componentsSelected[element.id] = element.name
            })
        }

        let componentsSelected = {}
        let components = {!! $components !!};

        function getComponent(tr) {

            const componentId = tr.querySelector('#component_id');

            if (componentId.value) {
                const component = components.find(component => component.id == componentId.value)
                const unit = tr.querySelector('#unit').innerText = component.unit;
                const price = tr.querySelector('#price').innerText = toRupiah(component.price_per_unit);
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
                                            <x-select x-on:click="getComponent(purchase); await $nextTick(); set_subtotal($refs.quantity)" x-init="await $nextTick(); setKomponen();" :dataLists="$components->toArray()"
                                                :name="'component_id[]'" :id="'component_id'" />
                                        </td>
                                        <td class="p-2"><input x-ref="quantity" type="number" name="quantity[]"
                                                oninput="set_subtotal(this)" value="0" step="0.0001"
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

        function setKomponen() {
            document.querySelectorAll(".component_id").forEach(element => {
                element._x_dataStack[0].list = componentsSelected
            })
        }

        function set_subtotal(element) {
            element.value < 0 ? element.value = 0 : element.value;
            let tr = element.parentElement.parentElement;
            let price = tr.querySelector('#price').textContent.replace(/[^0-9\.,]/g, '').replace(/\./g,
                '').replace(',', '.');
            let subtotal = tr.querySelector('#subtotal');
            subtotal.textContent = toRupiah(price * element.value);

            set_total();
        }

        function set_total() {
            let subtotals = document.querySelectorAll('#subtotal');
            let total = 0;
            subtotals.forEach(subtotalElement => {
                let subtotalValue = parseFloat(subtotalElement.textContent.replace(/[^0-9\.,]/g, '').replace(/\./g,
                    '').replace(',', '.'));
                total += isNaN(subtotalValue) ? 0 : subtotalValue;

                document.querySelector('#total_bill').value = total;
            })
        }

        function batasBayar(bayarEl) {
            const total = parseInt(document.querySelector('#total_bill').value);
            const bayar = parseInt(bayarEl.value);

            bayarEl.value = bayar > total ? total : bayar
        }
    </script>
@endpush
