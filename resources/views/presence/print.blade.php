<!DOCTYPE html>
<html>

<head>
    <title>Presensi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        table th,
        table td {
            padding: 5px;
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

        .employee-details {
            margin-bottom: 40px;
        }

        .employee-details p {
            margin: 0;
        }

        .employee-details strong {
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
    <h1 class="header">Presensi</h1>
    <hr>
    <table class="content">
        <tbody>
            <tr>
                <td style="width:50%;">
                    <div class="employee-header">
                        <h1>Customer Information</h1>
                    </div>
                    <div class="employee-details">
                        <p><b>RFID</b> {{ ': ' . $employee->rfid }}</p>
                        <p><b>Nama Karyawan</b> {{ ': ' . $employee->employee_name }}</p>
                        <p><b>Bulan</b>
                            {{ ': ' . Carbon\Carbon::createFromFormat('Y-m', $bulan)->format('F') . ' ' . Carbon\Carbon::createFromFormat('Y-m', $bulan)->year }}
                        </p>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="content">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Masuk</th>
                <th>Keluar</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < Carbon\Carbon::createFromFormat('Y-m', $bulan)->daysInMonth; $i++)
                @php
                    $date = Carbon\Carbon::createFromFormat('Y-m', $bulan)
                        ->startOfMonth()
                        ->addDays($i);
                    $presence = $employee
                        ->presence()
                        ->whereDate('created_at', $date)
                        ->first();
                @endphp
                <tr>
                    <td>
                        {{ $date->format('Y-m-d') }}
                    </td>
                    <td>
                        {{ $presence ? $presence->created_at->format('H:i:s') : '-' }}
                    </td>
                    <td>
                        {{ $presence ? $presence->updated_at->format('H:i:s') : '-' }}
                    </td>
                </tr>
            @endfor
        </tbody>
    </table>

</body>





</html>
