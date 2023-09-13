@extends('layouts.layout')

@section('content')
    <div x-data="data()" class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <form method="post" action="/productions/{{ $production->id }}">
            @csrf
            @method('put')
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 p-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Update Production</h2>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="code" class="block text-sm font-medium leading-6 text-gray-900">Production
                                Code</label>
                            <div class="mt-2">
                                <div
                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="text" name="code" id="code"
                                        class="block flex-1 border-0 bg-transparent p-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        placeholder="kayu" value="{{ $production->code }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <label for="product_name" class="block text-sm font-medium leading-6 text-gray-900">Product
                                Name</label>
                            <div class="mt-2">
                                <div
                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="text" name="product_name" id="product_name"
                                        class="block flex-1 border-0 bg-transparent p-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        readonly placeholder="m" value="{{ $production->product->name }}">
                                </div>
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <label for="total_production" class="block text-sm font-medium leading-6 text-gray-900">Total
                                Production</label>
                            <div class="mt-2">
                                <div
                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="number" name="total_production" id="total_production"
                                        class="block flex-1 border-0 bg-transparent p-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        readonly placeholder="10000" value="{{ $production->total_production }}">
                                </div>
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <label for="quantity_finished"
                                class="block text-sm font-medium leading-6 text-gray-900">Quantity Finished</label>
                            <div class="mt-2">
                                <div
                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="number" name="quantity_finished" id="quantity_finished"
                                        class="block flex-1 border-0 bg-transparent p-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        placeholder="10000" value="{{ $production->quantity_finished }}"
                                        onchange="set_finished(this)">
                                </div>
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <label for="quantity_not_finished"
                                class="block text-sm font-medium leading-6 text-gray-900">Quantity Not Finished</label>
                            <div class="mt-2">
                                <div
                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="number" min="0" name="quantity_not_finished"
                                        id="quantity_not_finished"
                                        class="block flex-1 border-0 bg-transparent p-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        readonly placeholder="10000" value="{{ $production->quantity_not_finished }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="m-6 flex items-center justify-end gap-x-6">
                <a href="/productions">
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
        let production = {!! $production !!}

        function set_finished(element) {
            let quantity_finished = element.value
            let quantity_not_finished = production.total_production - quantity_finished
            if (quantity_not_finished < 0) {
                quantity_not_finished = 0
                quantity_finished = production.total_production
                element.value = production.total_production
            }
            if (quantity_finished < 0) {
                quantity_not_finished = production.total_production
                quantity_finished = 0
                element.value = 0
            }
            document.getElementById('quantity_not_finished').value = quantity_not_finished
        }
    </script>
@endpush
