@extends('layouts.layout')

@section('content')
    <x-edit-input-field :action="'productions'" :items="$production" :width="'w-full'">
        <h1 class="mb-3 text-xl font-bold">Product</h1>

        <div class="flex w-full gap-3">
            <div class="flex-1">
                <x-input :value="$production->code" :label="'Kode Produksi'" :name="'code'" readonly />
            </div>
            <div class="flex-1">
                <x-input :value="$production->product->name" :label="'Nama Produk'" :name="'product_name'" readonly />
            </div>
        </div>
        <div class="flex w-full gap-3 my-3">
            <div class="flex-1">
                <x-input :value="$production->total_quantity" :label="'Total Produksi'" :name="'total_production'" readonly />
            </div>
        </div>
        <div class="flex w-full gap-3 my-3">
            <div class="flex-1">
                <label for="quantity_finished" class="block text-sm">Jumlah Sudah Selesai</label>
                <input type="number" value="{{ $production->quantity_finished }}" name="quantity_finished"
                    oninput="set_finished(this)" value="0" id="quantity_finished"
                    class="w-full px-3 py-2 mt-2 text-sm transition-all duration-100 border rounded outline-none focus:outline focus:outline-4 focus:outline-offset-0 focus:outline-slate-300">
            </div>
            <div class="flex-1">
                <x-input :value="$production->quantity_not_finished" :label="'Jumlah Belum Selesai'" :name="'quantity_not_finished'" readonly />
            </div>
    </x-edit-input-field>
@endsection
@push('script')
    <script>
        let production = @json($production)

        function set_finished(element) {
            if (element.value === '') {
                element.value = 0
            }
            const total = parseInt(production.sale.products.find(e => e.id == production.product_id).pivot.quantity)
            let quantity_finished = parseInt(element.value)
            let quantity_not_finished = total - quantity_finished
            console.log(quantity_finished)
            if (quantity_not_finished < 0) {
                quantity_not_finished = 0
                quantity_finished = total
                element.value = total
            }
            if (quantity_finished < 0) {
                quantity_not_finished = total
                quantity_finished = 0
                element.value = 0
            }

            document.getElementById('quantity_not_finished').value = quantity_not_finished
        }
    </script>
@endpush
