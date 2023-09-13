@extends('layouts.layout')

@section('content')
    <div class="p-5 shadow-xl bg-slate-50 rounded-xl">

        <h1 class="mb-5 text-3xl font-bold text-center text-gray-800">Tambah Data</h1>
        <form action="{{ route('products.store') }}" method="POST" class="w-full form-control">
            @csrf

            <div class="flex gap-5">
                <div>
                    <label for="name" class="label label-text">Product Name</label>
                    <input id="name" name="name" type="text" placeholder="Type here"
                        class="w-full max-w-xs input input-bordered" />

                    <label for="code" class="label label-text">Product Code</label>
                    <input id="code" name="code" type="text" placeholder="Type here"
                        class="w-full max-w-xs input input-bordered" />

                    <label for="rfid" class="label label-text">RFID</label>
                    <input id="rfid" name="rfid" type="number" placeholder="Type here"
                        class="w-full max-w-xs input input-bordered" />

                    <label for="category_id" class="label label-text">Category</label>
                    <select id="category_id" name="category_id" class="w-full max-w-xs select select-bordered">
                        <option disabled selected>Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div x-data="{ componentId: null, totalPrice: 0 }">
                    <p class="mt-1 font-bold">Components: </p>
                    <div x-data="{ quantity: 0, price: 0 }" class="flex gap-5 mt-2 w-fit items-center">
                        <select x-on:change="componentId = $el.value" name="components[]"
                            class="w-40 select select-bordered">
                            <option disabled selected>Component</option>
                            @foreach ($components as $component)
                                <option value="{{ $component->id }}">{{ $component->name }}
                                </option>
                            @endforeach
                        </select>

                        <input x-model="quantity" placeholder="Qty" onchange="set_total()" name="quantities[]"
                            type="number" class="w-20 input input-bordered">

                        <template x-if="componentId">
                            <p x-data="{ unit: components.find(c => c.id == componentId).unit, priceUnit: components.find(c => c.id == componentId).price_per_unit }">
                                <span x-text="unit">
                                </span>
                                x Rp<span x-text="priceUnit"></span>
                                = Rp<span x-text="quantity * priceUnit" class="subtotal"></span>
                            </p>
                        </template>

                        <button x-on:click="addComponentField" type="button" class="btn btn-primary">
                            <svg width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                fill="#000000">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <title></title>
                                    <g id="Complete">
                                        <g data-name="add" id="add-2">
                                            <g>
                                                <line fill="none" stroke="#ffffff" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" x1="12" x2="12"
                                                    y1="19" y2="5">
                                                </line>
                                                <line fill="none" stroke="#ffffff" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" x1="5" x2="19"
                                                    y1="12" y2="12">
                                                </line>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </button>
                    </div>

                    <div id="add-component-container" x-data></div>

                    <template x-if="componentId">
                        <div>
                            <div class="divider"></div>
                            <div class="flex justify-end font-bold mt-3 mr-16">Total : Rp<span id="total"></span></div>
                        </div>
                    </template>
                </div>
            </div>


            <div class="flex justify-end w-full gap-5">
                <a href="/products" type="button"
                    class="float-left w-32 mt-5 text-white normal-case rounded btn btn-warning">Cancel</a>
                <button type="submit"
                    class="float-left w-32 mt-5 text-white normal-case rounded btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <script>
        let components = {!! $components !!}

        function set_total() {
            let subtotals = document.querySelectorAll(".subtotal")

            let total = Array.from(subtotals).reduce((total, element) => total + parseInt(element.innerText), 0)

            document.querySelector('#total').innerText = total;
        }

        function addComponentField() {
            const container = document.querySelector('#add-component-container');
            const buttonHTML = `<div x-data="{ component: $el, componentId: null, quantity: 0 }" class="flex gap-5 mt-2 w-fit items-center">
                                    <select x-on:change="componentId = $el.value" name="components[]" class="w-40 select select-bordered">
                                        <option disabled selected>Component</option>
                                        @foreach ($components as $component)
                                            <option value="{{ $component->id }}">{{ $component->name }}
                                            </option>
                                        @endforeach
                                    </select>



                                    <input x-model="quantity" placeholder="Qty" name="quantities[]" onChange="set_total()" type="number"
                                        class="w-20 input input-bordered">

                                    <template x-if="componentId">
                                        <p x-data="{ unit: components.find(c => c.id == componentId).unit, priceUnit: components.find(c => c.id == componentId).price_per_unit }">
                                            <span x-text="unit">
                                            </span>
                                            x Rp<span x-text="priceUnit"></span>
                                            = Rp<span x-text="quantity*priceUnit" class="subtotal"></span>
                                        </p>
                                    </template>
                                    <button x-on:click="component.remove()" type="button" class="btn btn-warning">
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path d="M6 12L18 12" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                    </button>
                                </div>`;

            const buttonElement = document.createElement('div');
            buttonElement.innerHTML = buttonHTML;
            const button = buttonElement.firstChild;

            container.appendChild(button);
        }
    </script>
    <button x-on:click="component.remove()" type="button" class="btn btn-warning">
        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
            stroke="#ffffff">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
                <path d="M6 12L18 12" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                </path>
            </g>
        </svg>
    </button>
@endpush
