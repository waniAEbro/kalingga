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
                No : {{ $sale->code }}
            </th>
        </tr>
        <tr></tr>
        <tr>
            <th colspan="3">
                Customer Information
            </th>
            <th colspan="3">
                Sale Information
            </th>
        </tr>
        <tr>
            <th>Client</th>
            <th>:</th>
            <th>{{ $sale->customer->name }}</th>
            <th>Tanggal Pembelian</th>
            <th>:</th>
            <th>{{ $sale->purchase_date }}</th>
        </tr>
        <tr>
            <th>Email</th>
            <th>:</th>
            <th>{{ $sale->customer->email }}</th>
            <th>Tanggal Jatuh Tempo</th>
            <th>:</th>
            <th>{{ $sale->due_date }}</th>
        </tr>
        <tr>
            <th>Address</th>
            <th>:</th>
            <th>{{ $sale->customer->address }}</th>
            <th>Total</th>
            <th>:</th>
            <th>{{ $sale->total_bill }}</th>
        </tr>
        <tr>
            <th>Phone</th>
            <th>:</th>
            <th>{{ $sale->customer->phone }}</th>
            <th>Sudah Dibayar</th>
            <th>:</th>
            <th>{{ $sale->paid }}</th>
        </tr>
        <tr>
            <th colspan="3"></th>
            <th>Sisa</th>
            <th>:</th>
            <th>{{ $sale->remain_bill }}</th>
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
                Price
            </th>
            <th>
                SubTotal
            </th>
        </tr>
        @foreach ($sale->products as $index => $product)
            <tr>
                <td>
                    {{ $index + 1 }}
                </td>
                <td>
                    {{ $product->name }}
                </td>
                <td>
                    {{ $product->pivot->quantity }}
                </td>
                <td>
                    {{ $product->sell_price }}
                </td>
                <td>
                    {{ $product->pivot->quantity * $product->sell_price }}
                </td>
            </tr>
        @endforeach
    </tbody>
    <tbody>
        <tr></tr>
        <tr>
            <th>Payment Method T/T to {{ $sale->payment_sales->beneficiary_name }}</th>
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
            <th>{{ $sale->payment_sales->beneficiary_bank }}</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th>Beneficiary's A/C USD</th>
            <th>:</th>
            <th>{{ $sale->payment_sales->beneficiary_ac_usd }}</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th>Bank Add</th>
            <th>:</th>
            <th>{{ $sale->payment_sales->bank_address }}</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th>Swift code</th>
            <th>:</th>
            <th>{{ $sale->payment_sales->swift_code }}</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th>Beneficiary's Name</th>
            <th>:</th>
            <th>{{ $sale->payment_sales->beneficiary_name }}</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th>Address</th>
            <th>:</th>
            <th>{{ $sale->payment_sales->beneficiary_address }}</th>
            <th></th>
            <th></th>
            <th>Rensi Eka Prattistia</th>
        </tr>
        <tr>
            <th>Phone</th>
            <th>:</th>
            <th>{{ $sale->payment_sales->phone }}</th>
            <th></th>
            <th></th>
            <th>Director</th>
        </tr>
    </tbody>
</table>
