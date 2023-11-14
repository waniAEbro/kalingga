@extends('layouts.layout')

@section('content')
    <x-data-list>
        <div class="relative">
            {{-- <table class="w-full mt-5 border-separate table-fixed border-spacing-y-3">
            </table> --}}
            <div id="product-grid" class="mt-10 pb-20 grid grid-cols-4 gap-5">

                {{-- <div class="p-5 rounded-lg bg-white">
                    <div class="rounded-md overflow-hidden h-36 bg-bottom bg-cover relative"
                        style="background-image: url('/img/ilustrasi.png')">
                        <div class="absolute w-full h-full bg-gradient-to-t from-gray-800">
                            <div class="absolute bottom-3 left-3">
                                <div class="text-white">Kursi</div>
                                <div class="text-gray-300 text-sm">Perkayuan</div>
                            </div>
                        </div>
                    </div>

                    <div class="flex mt-5 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="pricetags-outline"></ion-icon><span class="ml-2">Kode Produk</span></div>
                        <div>: sdfsdf</div>
                    </div>

                    <div class="flex mt-3 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="hardware-chip-outline"></ion-icon><span class="ml-2">Kode RFID</span></div>
                        <div>: sdfs234df</div>
                    </div>

                    <div class="flex mt-3 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="cash-outline"></ion-icon><span class="ml-2">Harga Jual</span></div>
                        <div>: Rp30.000,00</div>
                    </div>

                    <hr class="mt-5">

                    <div class="flex gap-3 mt-5 text-sm">
                        <button class="flex items-center"><ion-icon name="eye-outline"></ion-icon><span class="ml-2">Preview</span></button>
                        <button class="flex items-center"><ion-icon name="create-outline"></ion-icon><span class="ml-2">Edit</span></button>
                        <button class="flex items-center text-red-500"><ion-icon name="trash-outline"></ion-icon><span class="ml-2">Delete</span></button>
                    </div>
                </div>

                <div class="p-5 rounded-lg bg-white">
                    <div class="rounded-md overflow-hidden h-36 bg-bottom bg-cover relative"
                        style="background-image: url('/img/ilustrasi.png')">
                        <div class="absolute w-full h-full bg-gradient-to-t from-gray-800">
                            <div class="absolute bottom-3 left-3">
                                <div class="text-white">Kursi</div>
                                <div class="text-gray-300 text-sm">Perkayuan</div>
                            </div>
                        </div>
                    </div>

                    <div class="flex mt-5 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="pricetags-outline"></ion-icon><span class="ml-2">Kode Produk</span></div>
                        <div>: sdfsdf</div>
                    </div>

                    <div class="flex mt-3 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="hardware-chip-outline"></ion-icon><span class="ml-2">Kode RFID</span></div>
                        <div>: sdfs234df</div>
                    </div>

                    <div class="flex mt-3 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="cash-outline"></ion-icon><span class="ml-2">Harga Jual</span></div>
                        <div>: Rp30.000,00</div>
                    </div>

                    <hr class="mt-5">

                    <div class="flex gap-3 mt-5 text-sm">
                        <button class="flex items-center"><ion-icon name="eye-outline"></ion-icon><span class="ml-2">Preview</span></button>
                        <button class="flex items-center"><ion-icon name="create-outline"></ion-icon><span class="ml-2">Edit</span></button>
                        <button class="flex items-center text-red-500"><ion-icon name="trash-outline"></ion-icon><span class="ml-2">Delete</span></button>
                    </div>
                </div>

                <div class="p-5 rounded-lg bg-white">
                    <div class="rounded-md overflow-hidden h-36 bg-bottom bg-cover relative"
                        style="background-image: url('/img/ilustrasi.png')">
                        <div class="absolute w-full h-full bg-gradient-to-t from-gray-800">
                            <div class="absolute bottom-3 left-3">
                                <div class="text-white">Kursi</div>
                                <div class="text-gray-300 text-sm">Perkayuan</div>
                            </div>
                        </div>
                    </div>

                    <div class="flex mt-5 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="pricetags-outline"></ion-icon><span class="ml-2">Kode Produk</span></div>
                        <div>: sdfsdf</div>
                    </div>

                    <div class="flex mt-3 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="hardware-chip-outline"></ion-icon><span class="ml-2">Kode RFID</span></div>
                        <div>: sdfs234df</div>
                    </div>

                    <div class="flex mt-3 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="cash-outline"></ion-icon><span class="ml-2">Harga Jual</span></div>
                        <div>: Rp30.000,00</div>
                    </div>

                    <hr class="mt-5">

                    <div class="flex gap-3 mt-5 text-sm">
                        <button class="flex items-center"><ion-icon name="eye-outline"></ion-icon><span class="ml-2">Preview</span></button>
                        <button class="flex items-center"><ion-icon name="create-outline"></ion-icon><span class="ml-2">Edit</span></button>
                        <button class="flex items-center text-red-500"><ion-icon name="trash-outline"></ion-icon><span class="ml-2">Delete</span></button>
                    </div>
                </div>

                <div class="p-5 rounded-lg bg-white">
                    <div class="rounded-md overflow-hidden h-36 bg-bottom bg-cover relative"
                        style="background-image: url('/img/ilustrasi.png')">
                        <div class="absolute w-full h-full bg-gradient-to-t from-gray-800">
                            <div class="absolute bottom-3 left-3">
                                <div class="text-white">Kursi</div>
                                <div class="text-gray-300 text-sm">Perkayuan</div>
                            </div>
                        </div>
                    </div>

                    <div class="flex mt-5 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="pricetags-outline"></ion-icon><span class="ml-2">Kode Produk</span></div>
                        <div>: sdfsdf</div>
                    </div>

                    <div class="flex mt-3 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="hardware-chip-outline"></ion-icon><span class="ml-2">Kode RFID</span></div>
                        <div>: sdfs234df</div>
                    </div>

                    <div class="flex mt-3 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="cash-outline"></ion-icon><span class="ml-2">Harga Jual</span></div>
                        <div>: Rp30.000,00</div>
                    </div>

                    <hr class="mt-5">

                    <div class="flex gap-3 mt-5 text-sm">
                        <button class="flex items-center"><ion-icon name="eye-outline"></ion-icon><span class="ml-2">Preview</span></button>
                        <button class="flex items-center"><ion-icon name="create-outline"></ion-icon><span class="ml-2">Edit</span></button>
                        <button class="flex items-center text-red-500"><ion-icon name="trash-outline"></ion-icon><span class="ml-2">Delete</span></button>
                    </div>
                </div>

                <div class="p-5 rounded-lg bg-white">
                    <div class="rounded-md overflow-hidden h-36 bg-bottom bg-cover relative"
                        style="background-image: url('/img/ilustrasi.png')">
                        <div class="absolute w-full h-full bg-gradient-to-t from-gray-800">
                            <div class="absolute bottom-3 left-3">
                                <div class="text-white">Kursi</div>
                                <div class="text-gray-300 text-sm">Perkayuan</div>
                            </div>
                        </div>
                    </div>

                    <div class="flex mt-5 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="pricetags-outline"></ion-icon><span class="ml-2">Kode Produk</span></div>
                        <div>: sdfsdf</div>
                    </div>

                    <div class="flex mt-3 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="hardware-chip-outline"></ion-icon><span class="ml-2">Kode RFID</span></div>
                        <div>: sdfs234df</div>
                    </div>

                    <div class="flex mt-3 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="cash-outline"></ion-icon><span class="ml-2">Harga Jual</span></div>
                        <div>: Rp30.000,00</div>
                    </div>

                    <hr class="mt-5">

                    <div class="flex gap-3 mt-5 text-sm">
                        <button class="flex items-center"><ion-icon name="eye-outline"></ion-icon><span class="ml-2">Preview</span></button>
                        <button class="flex items-center"><ion-icon name="create-outline"></ion-icon><span class="ml-2">Edit</span></button>
                        <button class="flex items-center text-red-500"><ion-icon name="trash-outline"></ion-icon><span class="ml-2">Delete</span></button>
                    </div>
                </div>

                <div class="p-5 rounded-lg bg-white">
                    <div class="rounded-md overflow-hidden h-36 bg-bottom bg-cover relative"
                        style="background-image: url('/img/ilustrasi.png')">
                        <div class="absolute w-full h-full bg-gradient-to-t from-gray-800">
                            <div class="absolute bottom-3 left-3">
                                <div class="text-white">Kursi</div>
                                <div class="text-gray-300 text-sm">Perkayuan</div>
                            </div>
                        </div>
                    </div>

                    <div class="flex mt-5 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="pricetags-outline"></ion-icon><span class="ml-2">Kode Produk</span></div>
                        <div>: sdfsdf</div>
                    </div>

                    <div class="flex mt-3 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="hardware-chip-outline"></ion-icon><span class="ml-2">Kode RFID</span></div>
                        <div>: sdfs234df</div>
                    </div>

                    <div class="flex mt-3 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="cash-outline"></ion-icon><span class="ml-2">Harga Jual</span></div>
                        <div>: Rp30.000,00</div>
                    </div>

                    <hr class="mt-5">

                    <div class="flex gap-3 mt-5 text-sm">
                        <button class="flex items-center"><ion-icon name="eye-outline"></ion-icon><span class="ml-2">Preview</span></button>
                        <button class="flex items-center"><ion-icon name="create-outline"></ion-icon><span class="ml-2">Edit</span></button>
                        <button class="flex items-center text-red-500"><ion-icon name="trash-outline"></ion-icon><span class="ml-2">Delete</span></button>
                    </div>
                </div>

                <div class="p-5 rounded-lg bg-white">
                    <div class="rounded-md overflow-hidden h-36 bg-bottom bg-cover relative"
                        style="background-image: url('/img/ilustrasi.png')">
                        <div class="absolute w-full h-full bg-gradient-to-t from-gray-800">
                            <div class="absolute bottom-3 left-3">
                                <div class="text-white">Kursi</div>
                                <div class="text-gray-300 text-sm">Perkayuan</div>
                            </div>
                        </div>
                    </div>

                    <div class="flex mt-5 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="pricetags-outline"></ion-icon><span class="ml-2">Kode Produk</span></div>
                        <div>: sdfsdf</div>
                    </div>

                    <div class="flex mt-3 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="hardware-chip-outline"></ion-icon><span class="ml-2">Kode RFID</span></div>
                        <div>: sdfs234df</div>
                    </div>

                    <div class="flex mt-3 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="cash-outline"></ion-icon><span class="ml-2">Harga Jual</span></div>
                        <div>: Rp30.000,00</div>
                    </div>

                    <hr class="mt-5">

                    <div class="flex gap-3 mt-5 text-sm">
                        <button class="flex items-center"><ion-icon name="eye-outline"></ion-icon><span class="ml-2">Preview</span></button>
                        <button class="flex items-center"><ion-icon name="create-outline"></ion-icon><span class="ml-2">Edit</span></button>
                        <button class="flex items-center text-red-500"><ion-icon name="trash-outline"></ion-icon><span class="ml-2">Delete</span></button>
                    </div>
                </div>

                <div class="p-5 rounded-lg bg-white">
                    <div class="rounded-md overflow-hidden h-36 bg-bottom bg-cover relative"
                        style="background-image: url('/img/ilustrasi.png')">
                        <div class="absolute w-full h-full bg-gradient-to-t from-gray-800">
                            <div class="absolute bottom-3 left-3">
                                <div class="text-white">Kursi</div>
                                <div class="text-gray-300 text-sm">Perkayuan</div>
                            </div>
                        </div>
                    </div>

                    <div class="flex mt-5 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="pricetags-outline"></ion-icon><span class="ml-2">Kode Produk</span></div>
                        <div>: sdfsdf</div>
                    </div>

                    <div class="flex mt-3 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="hardware-chip-outline"></ion-icon><span class="ml-2">Kode RFID</span></div>
                        <div>: sdfs234df</div>
                    </div>

                    <div class="flex mt-3 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="cash-outline"></ion-icon><span class="ml-2">Harga Jual</span></div>
                        <div>: Rp30.000,00</div>
                    </div>

                    <hr class="mt-5">

                    <div class="flex gap-3 mt-5 text-sm">
                        <button class="flex items-center"><ion-icon name="eye-outline"></ion-icon><span class="ml-2">Preview</span></button>
                        <button class="flex items-center"><ion-icon name="create-outline"></ion-icon><span class="ml-2">Edit</span></button>
                        <button class="flex items-center text-red-500"><ion-icon name="trash-outline"></ion-icon><span class="ml-2">Delete</span></button>
                    </div>
                </div>

                <div class="p-5 rounded-lg bg-white">
                    <div class="rounded-md overflow-hidden h-36 bg-bottom bg-cover relative"
                        style="background-image: url('/img/ilustrasi.png')">
                        <div class="absolute w-full h-full bg-gradient-to-t from-gray-800">
                            <div class="absolute bottom-3 left-3">
                                <div class="text-white">Kursi</div>
                                <div class="text-gray-300 text-sm">Perkayuan</div>
                            </div>
                        </div>
                    </div>

                    <div class="flex mt-5 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="pricetags-outline"></ion-icon><span class="ml-2">Kode Produk</span></div>
                        <div>: sdfsdf</div>
                    </div>

                    <div class="flex mt-3 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="hardware-chip-outline"></ion-icon><span class="ml-2">Kode RFID</span></div>
                        <div>: sdfs234df</div>
                    </div>

                    <div class="flex mt-3 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="cash-outline"></ion-icon><span class="ml-2">Harga Jual</span></div>
                        <div>: Rp30.000,00</div>
                    </div>

                    <hr class="mt-5">

                    <div class="flex gap-3 mt-5 text-sm">
                        <button class="flex items-center"><ion-icon name="eye-outline"></ion-icon><span class="ml-2">Preview</span></button>
                        <button class="flex items-center"><ion-icon name="create-outline"></ion-icon><span class="ml-2">Edit</span></button>
                        <button class="flex items-center text-red-500"><ion-icon name="trash-outline"></ion-icon><span class="ml-2">Delete</span></button>
                    </div>
                </div>

                <div class="p-5 rounded-lg bg-white">
                    <div class="rounded-md overflow-hidden h-36 bg-bottom bg-cover relative"
                        style="background-image: url('/img/ilustrasi.png')">
                        <div class="absolute w-full h-full bg-gradient-to-t from-gray-800">
                            <div class="absolute bottom-3 left-3">
                                <div class="text-white">Kursi</div>
                                <div class="text-gray-300 text-sm">Perkayuan</div>
                            </div>
                        </div>
                    </div>

                    <div class="flex mt-5 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="pricetags-outline"></ion-icon><span class="ml-2">Kode Produk</span></div>
                        <div>: sdfsdf</div>
                    </div>

                    <div class="flex mt-3 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="hardware-chip-outline"></ion-icon><span class="ml-2">Kode RFID</span></div>
                        <div>: sdfs234df</div>
                    </div>

                    <div class="flex mt-3 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="cash-outline"></ion-icon><span class="ml-2">Harga Jual</span></div>
                        <div>: Rp30.000,00</div>
                    </div>

                    <hr class="mt-5">

                    <div class="flex gap-3 mt-5 text-sm">
                        <button class="flex items-center"><ion-icon name="eye-outline"></ion-icon><span class="ml-2">Preview</span></button>
                        <button class="flex items-center"><ion-icon name="create-outline"></ion-icon><span class="ml-2">Edit</span></button>
                        <button class="flex items-center text-red-500"><ion-icon name="trash-outline"></ion-icon><span class="ml-2">Delete</span></button>
                    </div>
                </div>

                <div class="p-5 rounded-lg bg-white">
                    <div class="rounded-md overflow-hidden h-36 bg-bottom bg-cover relative"
                        style="background-image: url('/img/ilustrasi.png')">
                        <div class="absolute w-full h-full bg-gradient-to-t from-gray-800">
                            <div class="absolute bottom-3 left-3">
                                <div class="text-white">Kursi</div>
                                <div class="text-gray-300 text-sm">Perkayuan</div>
                            </div>
                        </div>
                    </div>

                    <div class="flex mt-5 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="pricetags-outline"></ion-icon><span class="ml-2">Kode Produk</span></div>
                        <div>: sdfsdf</div>
                    </div>

                    <div class="flex mt-3 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="hardware-chip-outline"></ion-icon><span class="ml-2">Kode RFID</span></div>
                        <div>: sdfs234df</div>
                    </div>

                    <div class="flex mt-3 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="cash-outline"></ion-icon><span class="ml-2">Harga Jual</span></div>
                        <div>: Rp30.000,00</div>
                    </div>

                    <hr class="mt-5">

                    <div class="flex gap-3 mt-5 text-sm">
                        <button class="flex items-center"><ion-icon name="eye-outline"></ion-icon><span class="ml-2">Preview</span></button>
                        <button class="flex items-center"><ion-icon name="create-outline"></ion-icon><span class="ml-2">Edit</span></button>
                        <button class="flex items-center text-red-500"><ion-icon name="trash-outline"></ion-icon><span class="ml-2">Delete</span></button>
                    </div>
                </div>

                <div class="p-5 rounded-lg bg-white">
                    <div class="rounded-md overflow-hidden h-36 bg-bottom bg-cover relative"
                        style="background-image: url('/img/ilustrasi.png')">
                        <div class="absolute w-full h-full bg-gradient-to-t from-gray-800">
                            <div class="absolute bottom-3 left-3">
                                <div class="text-white">Kursi</div>
                                <div class="text-gray-300 text-sm">Perkayuan</div>
                            </div>
                        </div>
                    </div>

                    <div class="flex mt-5 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="pricetags-outline"></ion-icon><span class="ml-2">Kode Produk</span></div>
                        <div>: sdfsdf</div>
                    </div>

                    <div class="flex mt-3 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="hardware-chip-outline"></ion-icon><span class="ml-2">Kode RFID</span></div>
                        <div>: sdfs234df</div>
                    </div>

                    <div class="flex mt-3 text-gray-600 text-sm">
                        <div class="flex items-center"><ion-icon name="cash-outline"></ion-icon><span class="ml-2">Harga Jual</span></div>
                        <div>: Rp30.000,00</div>
                    </div>

                    <hr class="mt-5">

                    <div class="flex gap-3 mt-5 text-sm">
                        <button class="flex items-center"><ion-icon name="eye-outline"></ion-icon><span class="ml-2">Preview</span></button>
                        <button class="flex items-center"><ion-icon name="create-outline"></ion-icon><span class="ml-2">Edit</span></button>
                        <button class="flex items-center text-red-500"><ion-icon name="trash-outline"></ion-icon><span class="ml-2">Delete</span></button>
                    </div>
                </div> --}}
            </div>

            <div id="pagination-wrapper" x-data class="absolute bottom-0 flex h-10 gap-2 text-sm"></div>
        </div>
    </x-data-list>
@endsection

@push('script')
    <script>
        // state.columnName = ["Nomor", "Nama Produk", "Kode Produk", "RFID", "Harga Jual", "Aksi"]

        // document.querySelector(".table-fixed").appendChild(buildHeader())

        const products = {!! $products !!}
        // const products = [{
        //         name: 'rasikh',
        //         code: 'asdf234',
        //         rfid: 'ab',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'imam',
        //         code: 'makan234',
        //         rfid: 'ac',
        //         sell_price: '2223433454232'
        //     },
        //     {
        //         name: 'gelas',
        //         code: 'asdf234',
        //         rfid: 'ac',
        //         sell_price: '24'
        //     },
        //     {
        //         name: 'rido',
        //         code: 'laper',
        //         rfid: 'aa',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'hape',
        //         code: 'aduh',
        //         rfid: 'ad',
        //         sell_price: '679'
        //     },
        //     {
        //         name: 'rasikh',
        //         code: 'asdf234',
        //         rfid: 'ab',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'imam',
        //         code: 'makan234',
        //         rfid: 'ac',
        //         sell_price: '2223433454232'
        //     },
        //     {
        //         name: 'rido',
        //         code: 'laper',
        //         rfid: 'aa',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'hape',
        //         code: 'aduh',
        //         rfid: 'ad',
        //         sell_price: '679'
        //     },
        //     {
        //         name: 'rasikh',
        //         code: 'asdf234',
        //         rfid: 'ab',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'imam',
        //         code: 'makan234',
        //         rfid: 'ac',
        //         sell_price: '2223433454232'
        //     },
        //     {
        //         name: 'rido',
        //         code: 'laper',
        //         rfid: 'aa',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'hape',
        //         code: 'aduh',
        //         rfid: 'ad',
        //         sell_price: '679'
        //     },
        //     {
        //         name: 'rasikh',
        //         code: 'asdf234',
        //         rfid: 'ab',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'imam',
        //         code: 'makan234',
        //         rfid: 'ac',
        //         sell_price: '2223433454232'
        //     },
        //     {
        //         name: 'rido',
        //         code: 'laper',
        //         rfid: 'aa',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'hape',
        //         code: 'aduh',
        //         rfid: 'ad',
        //         sell_price: '679'
        //     },
        //     {
        //         name: 'rasikh',
        //         code: 'asdf234',
        //         rfid: 'ab',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'imam',
        //         code: 'makan234',
        //         rfid: 'ac',
        //         sell_price: '2223433454232'
        //     },
        //     {
        //         name: 'rido',
        //         code: 'laper',
        //         rfid: 'aa',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'hape',
        //         code: 'aduh',
        //         rfid: 'ad',
        //         sell_price: '679'
        //     },
        //     {
        //         name: 'rasikh',
        //         code: 'asdf234',
        //         rfid: 'ab',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'imam',
        //         code: 'makan234',
        //         rfid: 'ac',
        //         sell_price: '2223433454232'
        //     },
        //     {
        //         name: 'rido',
        //         code: 'laper',
        //         rfid: 'aa',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'hape',
        //         code: 'aduh',
        //         rfid: 'ad',
        //         sell_price: '679'
        //     },
        //     {
        //         name: 'rasikh',
        //         code: 'asdf234',
        //         rfid: 'ab',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'imam',
        //         code: 'makan234',
        //         rfid: 'ac',
        //         sell_price: '2223433454232'
        //     },
        //     {
        //         name: 'rido',
        //         code: 'laper',
        //         rfid: 'aa',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'hape',
        //         code: 'aduh',
        //         rfid: 'ad',
        //         sell_price: '679'
        //     },
        //     {
        //         name: 'rasikh',
        //         code: 'asdf234',
        //         rfid: 'ab',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'imam',
        //         code: 'makan234',
        //         rfid: 'ac',
        //         sell_price: '2223433454232'
        //     },
        //     {
        //         name: 'rido',
        //         code: 'laper',
        //         rfid: 'aa',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'hape',
        //         code: 'aduh',
        //         rfid: 'ad',
        //         sell_price: '679'
        //     },
        //     {
        //         name: 'rasikh',
        //         code: 'asdf234',
        //         rfid: 'ab',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'imam',
        //         code: 'makan234',
        //         rfid: 'ac',
        //         sell_price: '2223433454232'
        //     },
        //     {
        //         name: 'rido',
        //         code: 'laper',
        //         rfid: 'aa',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'hape',
        //         code: 'aduh',
        //         rfid: 'ad',
        //         sell_price: '679'
        //     },
        //     {
        //         name: 'rasikh',
        //         code: 'asdf234',
        //         rfid: 'ab',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'imam',
        //         code: 'makan234',
        //         rfid: 'ac',
        //         sell_price: '2223433454232'
        //     },
        //     {
        //         name: 'rido',
        //         code: 'laper',
        //         rfid: 'aa',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'hape',
        //         code: 'aduh',
        //         rfid: 'ad',
        //         sell_price: '679'
        //     },
        //     {
        //         name: 'rasikh',
        //         code: 'asdf234',
        //         rfid: 'ab',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'imam',
        //         code: 'makan234',
        //         rfid: 'ac',
        //         sell_price: '2223433454232'
        //     },
        //     {
        //         name: 'rido',
        //         code: 'laper',
        //         rfid: 'aa',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'hape',
        //         code: 'aduh',
        //         rfid: 'ad',
        //         sell_price: '679'
        //     },
        //     {
        //         name: 'rasikh',
        //         code: 'asdf234',
        //         rfid: 'ab',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'imam',
        //         code: 'makan234',
        //         rfid: 'ac',
        //         sell_price: '2223433454232'
        //     },
        //     {
        //         name: 'rido',
        //         code: 'laper',
        //         rfid: 'aa',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'hape',
        //         code: 'aduh',
        //         rfid: 'ad',
        //         sell_price: '679'
        //     },
        //     {
        //         name: 'rasikh',
        //         code: 'asdf234',
        //         rfid: 'ab',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'imam',
        //         code: 'makan234',
        //         rfid: 'ac',
        //         sell_price: '2223433454232'
        //     },
        //     {
        //         name: 'rido',
        //         code: 'laper',
        //         rfid: 'aa',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'hape',
        //         code: 'aduh',
        //         rfid: 'ad',
        //         sell_price: '679'
        //     },
        //     {
        //         name: 'rasikh',
        //         code: 'asdf234',
        //         rfid: 'ab',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'imam',
        //         code: 'makan234',
        //         rfid: 'ac',
        //         sell_price: '2223433454232'
        //     },
        //     {
        //         name: 'rido',
        //         code: 'laper',
        //         rfid: 'aa',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'hape',
        //         code: 'aduh',
        //         rfid: 'ad',
        //         sell_price: '679'
        //     },
        //     {
        //         name: 'rasikh',
        //         code: 'asdf234',
        //         rfid: 'ab',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'imam',
        //         code: 'makan234',
        //         rfid: 'ac',
        //         sell_price: '2223433454232'
        //     },
        //     {
        //         name: 'rido',
        //         code: 'laper',
        //         rfid: 'aa',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'hape',
        //         code: 'aduh',
        //         rfid: 'ad',
        //         sell_price: '679'
        //     },
        //     {
        //         name: 'rasikh',
        //         code: 'asdf234',
        //         rfid: 'ab',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'imam',
        //         code: 'makan234',
        //         rfid: 'ac',
        //         sell_price: '2223433454232'
        //     },
        //     {
        //         name: 'rido',
        //         code: 'laper',
        //         rfid: 'aa',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'hape',
        //         code: 'aduh',
        //         rfid: 'ad',
        //         sell_price: '679'
        //     },
        //     {
        //         name: 'rasikh',
        //         code: 'asdf234',
        //         rfid: 'ab',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'imam',
        //         code: 'makan234',
        //         rfid: 'ac',
        //         sell_price: '2223433454232'
        //     },
        //     {
        //         name: 'rido',
        //         code: 'laper',
        //         rfid: 'aa',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'hape',
        //         code: 'aduh',
        //         rfid: 'ad',
        //         sell_price: '679'
        //     },
        //     {
        //         name: 'rasikh',
        //         code: 'asdf234',
        //         rfid: 'ab',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'imam',
        //         code: 'makan234',
        //         rfid: 'ac',
        //         sell_price: '2223433454232'
        //     },
        //     {
        //         name: 'rido',
        //         code: 'laper',
        //         rfid: 'aa',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'hape',
        //         code: 'aduh',
        //         rfid: 'ad',
        //         sell_price: '679'
        //     },
        //     {
        //         name: 'rasikh',
        //         code: 'asdf234',
        //         rfid: 'ab',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'imam',
        //         code: 'makan234',
        //         rfid: 'ac',
        //         sell_price: '2223433454232'
        //     },
        //     {
        //         name: 'rido',
        //         code: 'laper',
        //         rfid: 'aa',
        //         sell_price: '234'
        //     },
        //     {
        //         name: 'hape',
        //         code: 'aduh',
        //         rfid: 'ad',
        //         sell_price: '679'
        //     },
        // ]

        state.menu = "products"
        state.columnQuery = ["name", "code", "rfid", "sell_price"]
        state.data = products
        state.allData = products
        state.isGrid = true

        paginate()
        pageNumber()
        buildTable()

        function show(id) {
            const product = products.find(data => data.id === id);

            const modal = document.querySelector('#modal');
            document.querySelector('#modal-background').classList.remove('hidden');

            modal.classList.remove('opacity-0', '-z-40');
            modal.classList.add('opacity-100', 'z-40');

            let components_lists = '';
            let supplier_list = '';
            let components_price = 0;
            product.components.forEach((cp, i) => {
                components_lists += `<tr>
                                <td class="px-4 py-2 text-center">${i+1}</td>
                                <td class="px-4 py-2">${cp.name}</td>
                                <td class="px-4 py-2">${cp.pivot.quantity}</td>
                                <td class="px-4 py-2">${cp.unit}</td>
                                <td class="px-4 py-2">${toRupiah(cp.price_per_unit)}</td>
                                <td class="px-4 py-2">${toRupiah(cp.price_per_unit*cp.pivot.quantity)}</td>
                            </tr>`;
            })

            product.suppliers.forEach((sp, i) => {
                supplier_list += `<tr>
                                <td class="px-4 py-2 text-center">${i+1}</td>
                                <td class="px-4 py-2">${sp.name}</td>
                                <td class="px-4 py-2">${toRupiah(sp.pivot.price_per_unit)}</td>
                            </tr>`;
            })

            components_lists += `<tr class="border-gray-200 border-y-2">
                            <td class="px-4 py-2"></td>
                            <td class="px-4 py-2"></td>
                            <td class="px-4 py-2"></td>
                            <td class="px-4 py-2"></td>
                            <td class="px-4 py-2 font-bold">Total</td>
                            <td class="px-4 py-2 font-bold">${toRupiah(components_price)}</td>
                        </tr>`

            let total_produksi = toRupiah(product.production_costs.total);

            let total_packing = toRupiah(product.pack.total)

            let total_lain_lain = toRupiah(product.other_costs.total)

            let hpp = toRupiah(product.hpp);

            modal.innerHTML = `
            <div class="w-[960px] bg-white rounded-xl text-gray-800">
                <div class="py-[20px] px-[30px] w-full relative border-b-2 border-gray-200 flex justify-between items-center">
                    <div class="text-xl font-bold">Detail Produk</div>
                    <div onclick="hideModal()" class="absolute flex items-center p-1 text-2xl transition-all rounded-full cursor-pointer right-5 hover:bg-slate-100"><ion-icon name="close-outline"></ion-icon>
                    </div>
                </div>

                <div class="px-[30px] py-[34px] w-full h-[500px] overflow-y-scroll overscroll-none">
                    <div class="flex justify-between gap-5">
                        <div>
                            <div class="mb-2 font-bold">Produk</div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] mb-1 text-xs">
                                <div class="flex justify-between">
                                    <div class="font-bold">Nama</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.name}</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs mb-1">
                                <div class="flex justify-between">
                                    <div class="font-bold">Logo</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.logo}</div>
                            </div>

                            <div class="mb-1 text-xs font-bold">Kode</div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Barcode</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.barcode}</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>RFID</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.rfid}</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Produk</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.code}</div>
                            </div>

                            <div class="mb-1 text-xs font-bold">Dimensi</div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Panjang</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.length} cm</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Lebar</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.width} cm</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Tinggi</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.height} cm</div>
                            </div>
                        </div>

                        <div>
                            <div class="mb-2 font-bold">Pack</div>

                            <div class="mb-1 text-xs font-bold">Dimensi Dalam</div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Panjang</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.pack.inner_length} cm</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Lebar</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.pack.inner_width} cm</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Tinggi</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.pack.inner_height} cm</div>
                            </div>

                            <div class="mb-1 text-xs font-bold">Dimensi Luar</div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Panjang</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.pack.outer_length} cm</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Lebar</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.pack.outer_width} cm</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Tinggi</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.pack.outer_height} cm</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>Volume</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.pack.outer_length*product.pack.outer_width*product.pack.outer_length} cm</div>
                            </div>

                            <div class="mb-1 text-xs font-bold">Berat</div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>NW</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.pack.nw} kg</div>
                            </div>

                            <div class="grid grid-cols-[1fr_1fr] w-[150px] text-xs ml-3 mb-1">
                                <div class="flex justify-between">
                                    <div>GW</div>
                                    <div class="whitespace-pre">: </div>
                                </div>
                                <div>${product.pack.gw} kg</div>
                            </div>
                        </div>

                        <div>
                            <div class="mb-3 font-bold">Komponen</div>

                            <table class="w-full text-xs table-fixed">
                                <thead class="border-gray-200 border-y-2">
                                    <tr>
                                        <th class="w-10 px-4 py-2">No</th>
                                        <th class="w-20 px-4 py-2 text-start">Komponen</th>
                                        <th class="w-20 px-4 py-2 text-start">Jumlah</th>
                                        <th class="w-10 px-4 py-2 text-start">Unit</th>
                                        <th class="px-4 py-2 text-start">Harga per Satuan</th>
                                        <th class="px-4 py-2 text-start">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${components_lists}
                                </tbody>
                            </table>

                            <div class="my-3 font-bold">Pemasok</div>

                            <table class="w-full text-xs table-fixed">
                                <thead class="border-gray-200 border-y-2">
                                    <tr>
                                        <th class="w-10 px-4 py-2">No</th>
                                        <th class="px-4 py-2 text-start">Pemasok</th>
                                        <th class="px-4 py-2 text-start">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${supplier_list}
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-3 mt-8">
                        <div>
                            <div class="mb-3 font-bold">Biaya Produksi</div>

                            <table class="w-full text-xs table-fixed">
                                <thead class="border-gray-200 border-y-2">
                                    <tr>
                                        <th class="px-4 py-2 text-start">Deskripsi</th>
                                        <th class="px-4 py-2 text-start">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="px-4 py-2">Harga Perakitan</td>
                                        <td class="px-4 py-2">${toRupiah(product.production_costs.price_perakitan)}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2">Harga Perakitan PRJ</td>
                                        <td class="px-4 py-2">${toRupiah(product.production_costs.price_perakitan_prj)}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2">Harga Grendo</td>
                                        <td class="px-4 py-2">${toRupiah(product.production_costs.price_grendo)}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2">Harga Obat</td>
                                        <td class="px-4 py-2">${toRupiah(product.production_costs.price_obat)}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2">Upah</td>
                                        <td class="px-4 py-2">${toRupiah(product.production_costs.upah)}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2 text-transparent">d</td>
                                        <td class="px-4 py-2"></td>
                                    </tr>
                                    <tr class="border-gray-200 border-y-2">
                                        <td class="px-4 py-2 font-bold">Total</td>
                                        <td class="px-4 py-2 font-bold">${total_produksi}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        <div>
                            <div class="mb-3 font-bold">Biaya Packing</div>

                            <table class="w-full text-xs table-fixed">
                                <thead class="border-gray-200 border-y-2">
                                    <tr>
                                        <th class="px-4 py-2 text-start">Deskripsi</th>
                                        <th class="px-4 py-2 text-start">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="px-4 py-2">Harga Box</td>
                                        <td class="px-4 py-2">${toRupiah(product.pack.box_price)}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2">Box Hardware</td>
                                        <td class="px-4 py-2">${toRupiah(product.pack.box_hardware)}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2">Assembling</td>
                                        <td class="px-4 py-2">${toRupiah(product.pack.assembling)}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2">Stiker</td>
                                        <td class="px-4 py-2">${toRupiah(product.pack.stiker)}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2">Hagtag</td>
                                        <td class="px-4 py-2">${toRupiah(product.pack.hagtag)}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2">Maintenance</td>
                                        <td class="px-4 py-2">${toRupiah(product.pack.maintenance)}</td>
                                    </tr>
                                    <tr class="border-gray-200 border-y-2">
                                        <td class="px-4 py-2 font-bold">Total</td>
                                        <td class="px-4 py-2 font-bold">${total_packing}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        <div>
                            <div class="mb-3 font-bold">Biaya Lain-Lain</div>

                            <table class="w-full text-xs table-fixed">
                                <thead class="border-gray-200 border-y-2">
                                    <tr>
                                        <th class="px-4 py-2 text-start">Deskripsi</th>
                                        <th class="px-4 py-2 text-start">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="px-4 py-2">Overhead Pabrik</td>
                                        <td class="px-4 py-2">${toRupiah(product.other_costs.biaya_overhead_pabrik)}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2">Listrik</td>
                                        <td class="px-4 py-2">${toRupiah(product.other_costs.biaya_listrik)}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2">Pajak</td>
                                        <td class="px-4 py-2">${toRupiah(product.other_costs.biaya_pajak)}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2">Export+Usaha</td>
                                        <td class="px-4 py-2">${toRupiah(product.other_costs.biaya_ekspor)}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2 text-transparent">d</td>
                                        <td class="px-4 py-2"></td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2 text-transparent">d</td>
                                        <td class="px-4 py-2"></td>
                                    </tr>
                                    <tr class="border-gray-200 border-y-2">
                                        <td class="px-4 py-2 font-bold">Total</td>
                                        <td class="px-4 py-2 font-bold">${total_lain_lain}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="flex justify-end w-full mt-8 text-xs">
                        <div class="w-60">
                            <div class="grid w-full grid-cols-2 mb-2 font-bold">HPP<span>: ${hpp}</span></div>
                            <div class="grid w-full grid-cols-2 font-bold">Harga Jual<span>: ${toRupiah(product.sell_price)}</span></div>
                        </div>
                    </div>
                </div>

                <div class="py-[20px] px-[30px] w-full flex justify-end items-center">
                    <button onclick="hideModal()" class="py-2 px-5 border text-[#768498] text-sm rounded-lg hover:bg-[#F7F9F9]">Kembali</button>
                </div>
            </div>
            `


        }
    </script>
@endpush
