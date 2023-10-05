@extends('layouts.layout')

@section('content')
    {{-- @dd($warehouse[0]->production->product->name) --}}
    <x-data-list :isReadOnly="true">
        <div class="h-[550px] relative">
            <table class="w-full mt-5 border-separate table-fixed border-spacing-y-3">
                <thead>
                    <tr class="text-center">
                        <th class="px-4 py-5 font-[500] w-14">No</th>
                        <th class="px-4 py-5 font-[500]">Nama Produk</th>
                        <th class="px-4 py-5 font-[500]">Kode RFID</th>
                        <th class="px-4 py-5 font-[500]">Barcode</th>
                        <th class="px-4 py-5 font-[500]">Kuantitas</th>
                    </tr>
                </thead>
                <tbody id="table-body" class="text-center ">

                </tbody>
            </table>
            <div id="pagination-wrapper" class="absolute bottom-0 flex h-10 gap-2 my-5 text-sm"></div>
        </div>
    </x-data-list>
@endsection

@push('script')
    <script>
        // const warehouse = {!! $warehouse !!}
        const warehouse = [{
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
            {
                production: {
                    product: {
                        name: 'rasikh',
                        rfid: 99999,
                        barcode: 023984,
                    }
                },
                quantity: 999
            },
        ]
        console.log(warehouse)

        let state = {
            'querySet': warehouse,

            'page': 1,
            'rows': 5,
            'window': 5,
            'no': 1
        }

        buildTable()

        function pagination(querySet, page, rows) {

            let trimStart = (page - 1) * rows
            let trimEnd = trimStart + rows

            let trimmedData = querySet.slice(trimStart, trimEnd)

            let pages = Math.ceil(querySet.length / rows);

            return {
                'querySet': trimmedData,
                'pages': pages,
                'trimStart': trimStart
            }
        }

        function pageButtons(pages, trimStart) {
            let wrapper = document.getElementById('pagination-wrapper')
            document.getElementById('info-pagination').innerText =
                `Showing ${trimStart + 1} to ${((trimStart + 5) > state.querySet.length) ? state.querySet.length : trimStart + 5} of ${state.querySet.length} entries`;

            wrapper.innerHTML = ``
            console.log('Pages:', pages)

            let maxLeft = (state.page - Math.floor(state.window / 2))
            let maxRight = (state.page + Math.floor(state.window / 2))

            if (maxLeft < 1) {
                maxLeft = 1
                maxRight = state.window
            }

            if (maxRight > pages) {
                maxLeft = pages - (state.window - 1)

                if (maxLeft < 1) {
                    maxLeft = 1
                }
                maxRight = pages
            }

            for (let page = maxLeft; page <= maxRight; page++) {
                if (page == state.page) {
                    wrapper.innerHTML +=
                        `<button value="${page}" onclick="pindahHalaman(this.value)" class="px-4 flex items-center bg-white drop-shadow-[0_0_15px_rgba(0,0,0,0.05)] hover:bg-gray-50 focus:bg-gray-100 rounded">${page}</button>`
                } else {
                    wrapper.innerHTML +=
                        `<button value="${page}" onclick="pindahHalaman(this.value)" class="flex items-center px-4 transition-all rounded hover:bg-gray-50 focus:bg-gray-100">${page}</button>`
                }
            }

            if (state.page != 1) {
                wrapper.innerHTML =
                    `<button value="${state.page - 1}" onclick="pindahHalaman(this.value)" class="flex items-center px-4 py-2 rounded hover:bg-gray-50 focus:bg-gray-100"><span class="material-symbols-outlined" style="font-size: 16px">keyboard_arrow_left</span></button>` +
                    wrapper.innerHTML

                wrapper.innerHTML =
                    `<button value="${1}" onclick="pindahHalaman(this.value)" class="flex items-center px-4 py-2 rounded hover:bg-gray-50 focus:bg-gray-100"><span class="material-symbols-outlined"
                style="font-size: 16px">keyboard_double_arrow_left</span></button>` +
                    wrapper.innerHTML
            }

            if (state.page != pages) {
                wrapper.innerHTML +=
                    `<button value="${state.page + 1}" onclick="pindahHalaman(this.value)" class="flex items-center px-4 py-2 rounded hover:bg-gray-50 focus:bg-gray-100"><span class="material-symbols-outlined" style="font-size: 16px">keyboard_arrow_right</span></button>`

                wrapper.innerHTML +=
                    `<button value="${pages}" onclick="pindahHalaman(this.value)" class="flex items-center px-4 py-2 rounded hover:bg-gray-50 focus:bg-gray-100"><span class="material-symbols-outlined"
                style="font-size: 16px">keyboard_double_arrow_right</span></button>`
            }

        }

        function pindahHalaman(value) {
            document.getElementById('table-body').innerHTML = '';

            state.page = Number(value);

            buildTable();
        }


        function buildTable() {
            let table = document.getElementById('table-body');


            let data = pagination(state.querySet, state.page, state.rows)
            pageButtons(data.pages, data.trimStart)

            let myList = data.querySet

            myList.forEach(list => {
                let row = `
                <tr id="daftar-item" class="text-sm bg-white drop-shadow-[0_0_15px_rgba(0,0,0,0.05)]">
                            <td class="px-4 py-5 border-r rounded-l-lg border-slate-200">${ ++data.trimStart }</td>
                            <td class="px-4 py-5">${ list.production.product.name }</td>
                            <td class="px-4 py-5">${ list.production.product.rfid }</td>
                            <td class="px-4 py-5">${ list.production.product.barcode }</td>
                            <td class="px-4 py-5 rounded-r-lg">${ list.quantity }</td>
        
                        </tr>`
                table.innerHTML += row

            })

        }
    </script>
@endpush
