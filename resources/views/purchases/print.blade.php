<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .invoice-details {
            margin-bottom: 40px;
        }

        .invoice-details p {
            margin: 0;
        }

        .invoice-details strong {
            display: inline-block;
            width: 150px;
        }

        .invoice-total {
            margin-top: 40px;
            text-align: right;
        }

        .invoice-total strong {
            display: inline-block;
            width: 150px;
        }

        .header {
            text-align: center;
        }

        table.content td {
            border-left: none;
            border-right: none;
        }
    </style>
</head>

<body>
    <table>
        <tbody>
            <tr>
                <td style="text-align: center; border: none;">
                    <img class="mt-1" src="{{ public_path('img/image 6.png') }}" alt="">
                </td>
                <td style="text-align: right; border: none;">
                    <p>Jl. Citrosumo No. 11 RT.017 RW.006</p>
                    <p>Senenan, tahunan - Jepara - Jawa Tengah</p>
                    <p>Fax. : (0291) 597784 - Telp. : (0291) 595628, 591637</p>
                </td>
            </tr>
        </tbody>
    </table>
    <hr>
    <h1 class="header">Invoice</h1>
    <p style="text-align: center;"><strong>No</strong> {{ ': ' . $purchase->code }}</p>
    <table class="content">
        <tbody>
            <tr>
                <td style="width:50%;">
                    <div class="invoice-header">
                        <h1>Curtomer Information</h1>
                    </div>
                    <div class="invoice-details">
                        <p><b>Client</b> {{ ': ' . $purchase->supplier->name }}</p>
                        <p><b>Email</b> {{ ': ' . $purchase->supplier->email }}</p>
                        <p><b>Address</b> {{ ': ' . $purchase->supplier->address }}</p>
                        <p><b>Phone</b> {{ ': ' . $purchase->supplier->phone }}</p>
                    </div>

                </td>
                <td>
                    <div class="invoice-header">
                        <h1>Purchase Information</h1>
                    </div>
                    <div class="invoice-details">
                        <p><b>Tanggal Pembelian</b> {{ ': ' . $purchase->purchase_date }}</p>
                        <p><b>Tanggal Jatuh Tempo</b> {{ ': ' . $purchase->due_date }}</p>
                        <p><b>Total</b> {{ ': ' . $purchase->total_bill }}</p>
                        <p><b>Sudah Dibayar</b> {{ ': ' . $purchase->paid }}</p>
                        <p><b>Sisa</b> {{ ': ' . $purchase->remain_bill }}</p>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <h1 class="header">Komponen</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Unit</th>
                <th>Price</th>
                <th>SubTotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($purchase->components as $no => $item)
                <tr>
                    <td>{{ $no + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->pivot->quantity }}</td>s
                    <td>{{ $item->suppliers->find($purchase->supplier_id)->pivot->price_per_unit }}</td>
                    <td>{{ $item->unit }}</td>
                    <td>{{ $item->pivot->quantity * $item->suppliers->find($purchase->supplier_id)->pivot->price_per_unit }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h1 class="header">Produk</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>SubTotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($purchase->products as $no => $item)
                <tr>
                    <td>{{ $no + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->pivot->quantity }}</td>s
                    <td>{{ $item->suppliers->find($purchase->supplier_id)->pivot->price_per_unit }}</td>
                    <td>{{ $item->pivot->quantity * $item->suppliers->find($purchase->supplier_id)->pivot->price_per_unit }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if ($purchase->histories->count() > 0)

        <h1 class="header">Riwayat Pembayaran</h1>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Payment</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchase->histories as $no => $item)
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                        <td>{{ $item->payment }}</td>
                        <td>{{ $item->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <table class="content">
        <tbody>
            <tr>
                <td>
                    <p style="margin:0"><b>Payment method T/T to
                            {{ $purchase->payment_purchases->beneficiary_name }}</b></p>
                    <p style="margin:0"><b>BANK DETAILS</b></p>
                    <p style="margin:0"><b>Beneficiary's Bank :
                            {{ $purchase->payment_purchases->beneficiary_bank }}</b></p>
                    <p style="margin:0"><b>Beneficiary's A/C USD :
                            {{ $purchase->payment_purchases->beneficiary_ac_usd }}</b></p>
                    <p style="margin:0">Bank Add. : {{ $purchase->payment_purchases->bank_address }}</p>
                    <p style="margin:0">Swift Code : <b>{{ $purchase->payment_purchases->swift_code }}</b></p>
                    <p style="margin:0">Beneficiary's Name :
                        <b></b>{{ $purchase->payment_purchases->beneficiary_name }}
                    </p>
                    <p style="margin:0">Address : {{ $purchase->payment_purchases->beneficiary_address }}</p>
                    <p style="margin:0">Phone : {{ $purchase->payment_purchases->phone }}</p>
                </td>
                <td style="width: 30%">
                    <p>Best Regard</p>
                    <p>CV. Kalingga Keling Jati</p>
                    <br>
                    <br>
                    <br>
                    <br>
                    <p style="text-decoration: underline;">Rensi Eka Prattistia</p>
                    <p>Director</p>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
