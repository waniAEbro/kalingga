<table>
    <thead>
        <tr>
            <th rowspan="3">Kalingga Keling Jati</th>
            <th colspan="5">Jl. Citrosumo No. 11 RT.017 RW.006</th>
        </tr>
        <tr>
            <th colspan="5">Senenan, tahunan - Jepara - Jawa Tengah</th>
        </tr>
        <tr>
            <th colspan="5">Fax. : (0291) 597784 - Telp. : (0291) 595628, 591637</th>
        </tr>
        <tr></tr>
        <tr>
            <th colspan="6">
                Invoice
            </th>
        </tr>
        <tr>
            <th colspan="6">
                No : {{ $purchase->code }}
            </th>
        </tr>
        <tr></tr>
        <tr>
            <th colspan="3">
                Customer Information
            </th>
            <th colspan="3">
                Purchase Information
            </th>
        </tr>
        <tr>
            <th>Client</th>
            <th>:</th>
            <th>{{ $purchase->supplier->name }}</th>
            <th>Tanggal Pembelian</th>
            <th>:</th>
            <th>{{ $purchase->purchase_date }}</th>
        </tr>
        <tr>
            <th>Email</th>
            <th>:</th>
            <th>{{ $purchase->supplier->email }}</th>
            <th>Tanggal Jatuh Tempo</th>
            <th>:</th>
            <th>{{ $purchase->due_date }}</th>
        </tr>
        <tr>
            <th>Address</th>
            <th>:</th>
            <th>{{ $purchase->supplier->address }}</th>
            <th>Total</th>
            <th>:</th>
            <th>{{ $purchase->total_bill }}</th>
        </tr>
        <tr>
            <th>Phone</th>
            <th>:</th>
            <th>{{ $purchase->supplier->phone }}</th>
            <th>Sudah Dibayar</th>
            <th>:</th>
            <th>{{ $purchase->paid }}</th>
        </tr>
        <tr>
            <th colspan="3"></th>
            <th>Sisa</th>
            <th>:</th>
            <th>{{ $purchase->remain_bill }}</th>
        </tr>
        <tr></tr>
    </thead>
    <tbody>
        <tr>
            <th>
                #
            </th>
            <th>
                Name
            </th>
            <th>
                Quantity
            </th>
            <th>
                Unit
            </th>
            <th>
                Price
            </th>
            <th>
                SubTotal
            </th>
        </tr>
        @foreach ($purchase->components as $index => $component)
            <tr>
                <td>
                    {{ $index + 1 }}
                </td>
                <td>
                    {{ $component->name }}
                </td>
                <td>
                    {{ $component->pivot->quantity }}
                </td>
                <td>
                    {{ $component->unit }}
                </td>
                <td>
                    {{ $component->suppliers->find($purchase->supplier_id)->pivot->price_per_unit }}
                </td>
                <td>
                    {{ $component->pivot->quantity * $component->suppliers->find($purchase->supplier_id)->pivot->price_per_unit }}
                </td>
            </tr>
        @endforeach
    </tbody>

    <thead>
        <tr></tr>
        <tr>
            <th>
                #
            </th>
            <th>
                Name
            </th>
            <th>
                Quantity
            </th>
            <th>
                Price
            </th>
            <th></th>
            <th>
                SubTotal
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($purchase->products as $index => $product)
            <tr>
                <td>
                    {{ $index + 1 }}
                </td>
                <td>
                    <img style="width: 10%;"
                        src="{{ public_path($product->image ? '/storage/' . $product->image : '/img/default-placeholder.png') }}"
                        alt="">
                </td>
                <td>
                    {{ $product->name }}
                </td>
                <td>
                    {{ $product->pivot->quantity }}
                </td>
                <td>
                    {{ $product->suppliers->find($purchase->supplier_id)->pivot->price_per_unit }}
                </td>
                <td>
                    {{ $product->pivot->quantity * $product->suppliers->find($purchase->supplier_id)->pivot->price_per_unit }}
                </td>
            </tr>
        @endforeach
        <tr></tr>
        <tr>
            <th>Payment Method T/T to 0</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>Best Regard</th>
        </tr>
        <tr>
            <th>Bank Details</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>CV. Kalingga Keling Jati</th>
        </tr>
        <tr>
            <th>Beneficiary's bank</th>
            <th>:</th>
            <th>{{ $purchase->payment_purchases->beneficiary_bank }}</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th>Beneficiary's A/C USD</th>
            <th>:</th>
            <th>{{ $purchase->payment_purchases->beneficiary_ac_usd }}</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th>Bank Add</th>
            <th>:</th>
            <th>{{ $purchase->payment_purchases->bank_address }}</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th>Swift code</th>
            <th>:</th>
            <th>{{ $purchase->payment_purchases->swift_code }}</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th>Beneficiary's Name</th>
            <th>:</th>
            <th>{{ $purchase->payment_purchases->beneficiary_name }}</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th>Address</th>
            <th>:</th>
            <th>{{ $purchase->payment_purchases->beneficiary_address }}</th>
            <th></th>
            <th></th>
            <th>Rensi Eka Prattistia</th>
        </tr>
        <tr>
            <th>Phone</th>
            <th>:</th>
            <th>{{ $purchase->payment_purchases->phone }}</th>
            <th></th>
            <th></th>
            <th>Director</th>
        </tr>
    </tbody>
</table>
