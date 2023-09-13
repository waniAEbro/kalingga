@extends('layouts.layout')

@section('content')
    <div x-data="data()" class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <form method="post" action="/purchases/{{ $purchases->id }}">
            @csrf
            @method('put')
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 p-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Update Purchases Data</h2>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="supplier_id" class="block text-sm font-medium leading-6 text-gray-900">Suppliers ID
                                </label>
                            <div class="mt-2">
                                <div
                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <select class="form-control" id="supplier_id" name="supplier_id">
                                        @foreach ($suppliers as $sp)
                                           <option value="{{ $sp->id }}">{{ $sp->id }} - {{ $sp->name }}</option>
                                        @endforeach
                                     </select>
                                </div>
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <label for="purchase_date" class="block text-sm font-medium leading-6 text-gray-900">Purchase Date</label>
                            <div class="mt-2">
                                <div
                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="date" name="purchase_date" id="purchase_date"
                                        class="block flex-1 border-0 bg-transparent p-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        placeholder="Purchase Date" value="{{ $purchases->purchase_date }}">
                                </div>
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <label for="due_date" class="block text-sm font-medium leading-6 text-gray-900">Due Date</label>
                            <div class="mt-2">
                                <div
                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="date" name="due_date" id="due_date"
                                        class="block flex-1 border-0 bg-transparent p-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        placeholder="Due Date" value="{{ $purchases->due_date }}">
                                </div>
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <label for="status" class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                            <div class="mt-2">
                                <div
                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="text" name="status" id="status"
                                        class="block flex-1 border-0 bg-transparent p-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        placeholder="Status" value="{{ $purchases->status }}">
                                </div>
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <label for="remain_bill" class="block text-sm font-medium leading-6 text-gray-900">Remain Bill</label>
                            <div class="mt-2">
                                <div
                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="number" name="remain_bill" id="remain_bill"
                                        class="block flex-1 border-0 bg-transparent p-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        placeholder="Remain Bill" value="{{ $purchases->remain_bill }}">
                                </div>
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <label for="total_bill" class="block text-sm font-medium leading-6 text-gray-900">Total Bill</label>
                            <div class="mt-2">
                                <div
                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="number" name="total_bill" id="total_bill"
                                        class="block flex-1 border-0 bg-transparent p-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        placeholder="Remain Bill" value="{{ $purchases->total_bill }}">
                                </div>
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <label for="paid" class="block text-sm font-medium leading-6 text-gray-900">Paid</label>
                            <div class="mt-2">
                                <div
                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="number" name="paid" id="paid"
                                        class="block flex-1 border-0 bg-transparent p-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        placeholder="Paid" value="{{ $purchases->paid }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="m-6 flex items-center justify-end gap-x-6">
                <a href="/customers">
                    <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                </a>
                <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>
        </form>
    </div>
@endsection
