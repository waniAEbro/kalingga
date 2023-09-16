@extends('layouts.layout')

@section('content')
    <h1 class="text-lg font my-7 font-[500]">Create Customer</h1>

    <x-create-input-field :action="'suppliers'" :items="$customers">
        <x-input-text :name="'name'" :label="'Supplier Name'" :placeholder="'name'" :value="$customers->name" class="mb-3" />
        <x-input-text :name="'email'" :label="'Email'" :placeholder="'email'" :value="$customers->email" class="mb-3" />
        <x-input-text :name="'phone'" :label="'Phone'" :placeholder="'phone'" :type="'number'" :value="$customers->phone"
            class="mb-3" />
        <x-input-textarea :name="'address'" :label="'Address'" :placeholder="'address'" :value="$customers->address" class="mb-3" />
        <x-input-text :name="'code'" :label="'Code'" :placeholder="'code'" :type="'number'" :value="$customers->code"
            class="mb-3" />
    </x-create-input-field>
    {{-- <div x-data="data()" class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <form method="post" action="/customers/{{ $customers->id }}">
            @csrf
            @method('put')
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 p-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Update Customer</h2>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Customer
                                Name</label>
                            <div class="mt-2">
                                <div
                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="text" name="name" id="name"
                                        class="block flex-1 border-0 bg-transparent p-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        placeholder="name" value="{{ $customers->name }}">
                                </div>
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                            <div class="mt-2">
                                <div
                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="email" name="email" id="email"
                                        class="block flex-1 border-0 bg-transparent p-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        placeholder="email" value="{{ $customers->email }}">
                                </div>
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">Phone</label>
                            <div class="mt-2">
                                <div
                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="number" name="phone" id="phone"
                                        class="block flex-1 border-0 bg-transparent p-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        placeholder="phone" value="{{ $customers->phone }}">
                                </div>
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">Address</label>
                            <div class="mt-2">
                                <div
                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <textarea id="address" name="address" value="{{ $customers->address }}" rows="3"
                                        class="block w-full
                                        rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset
                                        ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ $customers->address }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">Code</label>
                            <div class="mt-2">
                                <div
                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="text" name="code" id="code"
                                        class="block flex-1 border-0 bg-transparent p-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        placeholder="phone" value="{{ $customers->code }}">
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
    </div> --}}
@endsection
