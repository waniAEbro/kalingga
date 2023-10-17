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

        thead {
            display: table-header-group;
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
    <h1 class="header">Proforma Invoice</h1>
    <p style="text-align: center;"><strong>No</strong> {{ ': ' . $sale->code }}</p>
    <table class="content">
        <tbody>
            <tr>
                <td style="width:50%;">
                    <div class="invoice-header">
                        <h1>Curtomer Information</h1>
                    </div>
                    <div class="invoice-details">
                        <p><b>Client</b> {{ ': ' . $sale->customer->name }}</p>
                        <p><b>Email</b> {{ ': ' . $sale->customer->email }}</p>
                        <p><b>Address</b> {{ ': ' . $sale->customer->address }}</p>
                        <p><b>Phone</b> {{ ': ' . $sale->customer->phone }}</p>
                    </div>
                </td>
                <td>
                    <div class="invoice-header">
                        <h1>Sale Information</h1>
                    </div>
                    <div class="invoice-details">
                        <p><b>Tanggal Penjualan</b> {{ ': ' . $sale->sale_date }}</p>
                        <p><b>Tanggal Jatuh Tempo</b> {{ ': ' . $sale->due_date }}</p>
                        @if ($sale->paid > 0)
                            <p><b>Sudah Dibayar</b> {{ ': ' . $sale->paid }}</p>
                            <p><b>Sisa</b> {{ ': ' . $sale->remain_bill }}</p>
                        @endif
                        <p><b>Total</b> {{ ': ' . $sale->total_bill }}</p>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <h1 class="header">Produk</h1>
    <table>
        <thead style="page-break-inside: auto;">
            <tr>
                <th rowspan="2">#</th>
                <th rowspan="2">Artikelnummer</th>
                <th rowspan="2">Artikelomschrijving</th>
                <th colspan="3">Dimension (cm)</th>
                <th rowspan="2">Quantity</th>
                <th rowspan="2">Price</th>
                <th rowspan="2">SubTotal</th>
            </tr>
            <tr>
                <th>P</th>
                <th>L</th>
                <th>T</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sale->product as $no => $item)
                <tr>
                    <td>{{ $no + 1 }}</td>
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->length }}</td>
                    <td>{{ $item->width }}</td>
                    <td>{{ $item->height }}</td>
                    <td>{{ $item->pivot->quantity }}</td>s
                    <td>{{ $item->sell_price }}</td>
                    <td>{{ $item->pivot->quantity * $item->sell_price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if ($sale->histories->count() > 0)
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
                @foreach ($sale->histories as $no => $item)
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
                    <p>Payment method</p>
                    <p>Bank Details</p>
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
