@extends('layouts.layout')

@section('content')
    <form action="/products/production/{{ $product->id }}" method="post">
        @csrf
        @method('put')
        <h1 class=" font-bold text-lg text-center my-8">Production Edit</h1>

        <div class="shadow rounded-lg w-full bg-white p-8 grid mb-8">
            <div class="flex items-center w-full gap-4">
                <div class="basis-1/3">
                    <x-input :label="'Nama Produk'" readonly :name="'product_name'" :placeholder="'Nama Produk'" :value="$product->name" />
                </div>
                <div class="basis-1/3">
                    <x-input :label="'Jumlah Belum Selesai'" :name="'quantity_not_finished'" :placeholder="'Jumlah Belum Selesai'" :value="$product->production->quantity_not_finished" readonly />
                </div>
                <div class="basis-1/3">
                    <x-input :label="'Jumlah Sudah Selesai'" :name="'quantity_finished'" :placeholder="'Jumlah Sudah Selesai'" :value="$product->production->quantity_finished" readonly />
                </div>
            </div>
        </div>
        <h1 class="font-bold my-8 text-lg text-center">List Customer Butuh Produk</h1>
        <div class="w-full flex my-8">
            <table class="basis-full table-auto text-center">
                <thead>
                    <tr>
                        <th class="p-4">#</th>
                        <th class="p-4">Kode Penjualan</th>
                        <th class="p-4">Customer</th>
                        <th class="p-4">Jumlah Belum Selesai</th>
                        <th class="p-4">Jumlah Sudah Selesai</th>
                        <th class="p-4"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product->production->saleProductions as $index => $sale_production)
                        <tr class="shadow-md bg-white">
                            <input name="sale_production_id[]" type="hidden" value="{{ $sale_production->id }}">
                            <td class="p-4 rounded-l-lg">{{ $index + 1 }}</td>
                            <td class="p-4">{{ $sale_production->sale->code }}</td>
                            <td class="p-4">{{ $sale_production->sale->customer->name }}</td>
                            <td class="p-4">
                                <x-input :name="'sale_quantity_not_finished[]'" :type="'number'" :placeholder="'0'" readonly
                                    :value="$sale_production->quantity_not_finished" class="sale_quantity_not_finished id-{{ $sale_production->id }}" />
                            </td>
                            <td class="p-4 rounded-r-lg">
                                <x-input :name="'sale_quantity_finished[]'" :type="'number'"
                                    oninput="setNotFinished({{ $sale_production->id }}, this)" :placeholder="'0'"
                                    :step="1" :value="$sale_production->quantity_finished" class="sale_quantity_finished" />
                            </td>
                            <td>
                                <button type="button"
                                    onclick="showModalPurchase({{ $sale_production->id }}, {{ $index }}, this)"
                                    class="flex items-center gap-1 text-slate-600">
                                    <span class="text-lg"><ion-icon name="basket-outline"></ion-icon></span>Beli Dari
                                    Supplier
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="shadow rounded-lg w-full bg-white p-8 my-8">
            <button class="py-2 px-5 border text-[#F7F9F9] text-sm rounded-lg bg-[#064E3B] w-full">Submit</button>
        </div>
    </form>
@endsection
@push('script')
    <script>
        let product = {!! $product !!}

        function setQuantityProduction() {
            const quantity_finished = Array.from(document.querySelectorAll(".sale_quantity_finished"))
            const quantity_not_finished = Array.from(document.querySelectorAll(".sale_quantity_not_finished"))

            const production_finished_element = document.querySelector("#quantity_finished");
            const production_not_finished_element = document.querySelector("#quantity_not_finished");

            const production_finished = quantity_finished.reduce((acc, curr) => acc + parseInt(curr.value), 0);
            const production_not_finished = quantity_not_finished.reduce((acc, curr) => acc + parseInt(curr.value), 0);

            production_finished_element.value = production_finished;
            production_not_finished_element.value = production_not_finished;
        }

        function setNotFinished(id, e) {
            const sale_production = product.production.sale_productions.find(sale_production => sale_production.id == id)
            const maks = sale_production.quantity_not_finished + sale_production.quantity_finished;
            const parent = e.parentElement.parentElement.parentElement;
            const selisih_finish = parseInt(e.value) - sale_production.quantity_finished;
            const quantity_not_finished = sale_production.quantity_not_finished - selisih_finish;

            if (quantity_not_finished <= 0) {
                parent.querySelector('.id-' + id).value = 0;
                e.value = maks;
            } else {
                parent.querySelector('.id-' + id).value = quantity_not_finished;
            }

            setQuantityProduction()
        }

        function getSupplier() {
            const supplier_id = document.getElementById('supplier_id').value;
            if (supplier_id) {
                document.getElementById('supplier_address').value = product.suppliers.find(supplier => supplier.id ==
                    supplier_id).address;
                document.getElementById('supplier_email').value = product.suppliers.find(supplier => supplier.id ==
                    supplier_id).email;
                document.getElementById('supplier_phone').value = product.suppliers.find(supplier => supplier.id ==
                    supplier_id).phone;
                document.getElementById("price_purchase").value = product.suppliers.find(supplier => supplier.id ==
                    supplier_id).pivot.price_per_unit;
            } else {
                document.getElementById('supplier_address').value = '';
                document.getElementById('supplier_email').value = '';
                document.getElementById('supplier_phone').value = '';
            }
        }

        function setSubtotal(element) {
            if (element.value >= element.max) {
                element.value = element.max;
            } else if (element.value <= 0) {
                element.value = 0;
            }
            const quantity_purchase = element.value;
            const price_purchase = document.getElementById('price_purchase').value;
            const subtotal = quantity_purchase * price_purchase;
            document.getElementById('subtotal').innerHTML = subtotal;
            document.getElementById('total_bill').value = subtotal;
        }

        function batasBayar(e) {
            const total_bill = parseInt(document.getElementById('total_bill').value);
            const paid = parseInt(e.value);
            if (paid > total_bill) {
                e.value = total_bill;
            } else if (paid < 0) {
                e.value = 0;
            }
        }

        async function createPurchase(id) {
            const loading = document.querySelector(".loading")
            const modal = document.querySelector("#modal")
            loading.classList.remove('hidden')

            const purchase_date = modal.querySelector("#purchase_date").value
            const due_date = modal.querySelector("#due_date").value
            const supplier_id = modal.querySelector("#supplier_id").value
            const code = modal.querySelector("#code").value
            const method = modal.querySelector("#method").value
            const beneficiary_bank = modal.querySelector("#beneficiary_bank").value
            const beneficiary_ac_usd = modal.querySelector("#beneficiary_ac_usd").value
            const bank_address = modal.querySelector("#bank_address").value
            const swift_code = modal.querySelector("#swift_code").value
            const beneficiary_name = modal.querySelector("#beneficiary_name").value
            const beneficiary_address = modal.querySelector("#beneficiary_address").value
            const phone = modal.querySelector("#phone").value
            const location = modal.querySelector("#location").value
            const total_bill = modal.querySelector("#total_bill").value
            const paid = modal.querySelector("#paid").value
            const quantity_purchase = modal.querySelector("#quantity_purchase").value
            const price_purchase = modal.querySelector("#price_purchase").value
            const sale_production_id = id

            const data = {
                purchase_date,
                due_date,
                supplier_id,
                code,
                method,
                beneficiary_bank,
                beneficiary_ac_usd,
                bank_address,
                swift_code,
                beneficiary_name,
                beneficiary_address,
                phone,
                location,
                total_bill,
                paid,
                quantity_purchase,
                price_purchase,
                sale_production_id,
                product_id: product.id
            }

            try {
                const response = await fetch("/api/purchase", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify(data)
                })

                const purchase = await response.json()

                if (!response.ok) {
                    throw purchase
                }

                document.querySelector("#quantity_not_finished").value = purchase.production.quantity_not_finished
                document.querySelector(".id-" + id).value = purchase.production.sale_productions
                    .find(sale_production => sale_production.id == id).quantity_not_finished

                product = purchase

                loading.classList.add('hidden')
                hideModal()
            } catch (error) {
                console.log(error)
                loading.classList.add('hidden')
                const supplier_error = document.querySelector("#supplier-error")
                supplier_error.innerText = error.errors.supplier_id
                supplier_error.classList.remove("hidden")
            }
        }

        function showModalPurchase(id, index, e) {
            const parent = e.parentElement.parentElement
            const quantity_not_finished = parent.querySelector('.id-' + id).value;
            const quantity_finished = parent.querySelector('.sale_quantity_finished').value;
            const modal = document.querySelector('#modal');
            document.querySelector('#modal-background').classList.remove('hidden');

            modal.classList.remove('opacity-0', '-z-40');
            modal.classList.add('opacity-100', 'z-40');

            modal.innerHTML = `
            <div class="w-[1000px] bg-white h-fit rounded-xl pb-20 relative">
                <div
                    class="py-[20px] px-[30px] w-full relative border-b-2 border-gray-200 flex justify-between items-center">
                    <div class="text-xl font-bold">Tambah Purchase Baru</div>
                    <div onclick="hideModal()"
                        class="absolute flex items-center p-1 text-2xl rounded-full cursor-pointer right-5 hover:bg-slate-100">
                        <ion-icon name="close-outline"></ion-icon>
                    </div>
                </div>
                <div class="px-[30px] pt-[20px] h-[400px] overflow-y-scroll overscroll-contain">
                        <div class="flex gap-5 text-sm">
                            <div>
                                <label for="purchase_date" class="block text-sm">Tanggal Pembelian</label>
                                <x-input type="date" :name="'purchase_date'" :inputParentClass="'mb-3'" :value="Carbon\Carbon::now()->format('Y-m-d')" />

                                <label for="due_date" class="block text-sm">Tanggal Jatuh Tempo</label>
                                <x-input type="date" :name="'due_date'" :inputParentClass="'mb-3'" :value="Carbon\Carbon::now()->format('Y-m-d')" />

                                <label for="supplier_id" class="block text-sm">Pemasok</label>
                                <div class="w-40 mt-2 mb-3">
                                    <x-select x-on:click="getSupplier; await $nextTick();" :dataLists="$product->suppliers->toArray()" :name="'supplier_id'"
                                        :id="'supplier_id'" />
                                    <div class="text-red hidden" id="supplier-error"></div>
                                </div>

                                <x-input :name="'supplier_address'" :label="'Alamat Pemasok'" readonly class="mb-3 bg-slate-100" :value="0" />

                                <x-input :name="'supplier_email'" :label="'Email Pemasok'" readonly class="mb-3 bg-slate-100" :value="0" />

                                <x-input :name="'supplier_phone'" :label="'No Hp Pemasok'" readonly class="mb-3 bg-slate-100" :value="0" />

                                <x-input :name="'code'" :type="'text'" :label="'Kode Pembelian'" :inputParentClass="'mb-3'"
                                    :value="0" />

                                <x-input :name="'method'" :type="'text'" :label="'Metode Pembayaran'" :inputParentClass="'mb-3'"
                                    :value="0" />

                                <x-input :name="'beneficiary_bank'" :type="'text'" :label="'Beneficiary\'s Bank'" :inputParentClass="'mb-3'"
                                    :value="0" />

                                <x-input :name="'beneficiary_ac_usd'" :type="'text'" :label="'Beneficiary A/C USD'" :inputParentClass="'mb-3'"
                                    :value="0" />

                                <x-input :name="'bank_address'" :type="'text'" :label="'Bank Address'" :inputParentClass="'mb-3'"
                                    :value="0" />

                                <x-input :name="'swift_code'" :type="'text'" :label="'Swift Code'" :inputParentClass="'mb-3'"
                                    :value="0" />

                                <x-input :name="'beneficiary_name'" :type="'text'" :label="'Beneificiary Name'" :inputParentClass="'mb-3'"
                                    :value="0" />

                                <x-input :name="'beneficiary_address'" :type="'text'" :label="'Beneficiary\'s Address'" :inputParentClass="'mb-3'"
                                    :value="0" />

                                <x-input :name="'phone'" :type="'text'" :label="'Phone'" :inputParentClass="'mb-3'"
                                    :value="0" />

                                <div class="flex w-full gap-3 my-3">
                                    <div class="flex-1">
                                        <x-input-textarea :name="'location'" :label="'Lokasi Pengiriman'" :placeholder="'location'" :value="0" />
                                    </div>
                                </div>
                            </div>

                            <div class="divider divider-horizontal"></div>

                            <div class="w-full">
                                <h1 class="mt-5 mb-3 text-xl font-bold">Produk</h1>

                                <table class="w-full text-left table-fixed">
                                    <thead>
                                        <tr class="border-b-2">
                                            <th class="p-2">Produk</th>
                                            <th class="w-20 p-2">Jumlah</th>
                                            <th class="p-2">Harga</th>
                                            <th class="p-2">Subtotal</th>
                                            <th class="w-20 p-2"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-product">
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>
                                                <input type="number" name="quantity_purchase" id="quantity_purchase"
                                                    oninput="setSubtotal(this)" max="${quantity_not_finished}"
                                                    min="0" value="0"
                                                    class="w-full px-3 py-2 mt-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300">
                                            </td>
                                            <td>
                                                <input type="number" id="price_purchase" readonly value="0"
                                                    class="w-full px-3 py-2 mt-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300 bg-slate-100">
                                            </td>
                                            <td id="subtotal">0</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="flex justify-end gap-3 mt-10">
                                    <div class="w-40">
                                        <x-input :label="'Total'" :name="'total_bill'" :placeholder="'Total Bayar'" :type="'number'" readonly :value="0" />
                                    </div>
                                    <div class="w-40">
                                        <x-input :label="'Bayar'" :name="'paid'" :placeholder="'Bayar'" :type="'number'"
                                            :value="old('paid') ?? 0" oninput="batasBayar(this)" />
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="absolute flex gap-2 bottom-4 right-[30px]">
                    <button type="button" onclick="hideModal()" class="py-2 px-5 border text-[#768498] text-sm rounded-lg hover:bg-[#F7F9F9]">Batalkan</button>
                    <button type="button" onclick="createPurchase(${id})" class="py-2 px-5 border text-[#F7F9F9] bg-[#064E3B] text-sm rounded-lg save flex items-center justify-center gap-3">Simpan <span class="hidden loading loading-spinner loading-sm"></span></button>
                </div>
            </div>
            `
        }
    </script>
@endpush
