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

            .employee-belumpulang {
                background-color: yellow;
            }

            .employee-kuning {
                background-color: rgb(255, 241, 137);
            }

            .employee-hadir {
                background-color: rgb(137, 255, 157);
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
                            <p><b>Bulan</b> {{ ': ' . Carbon\Carbon::createFromFormat("Y-m", $bulan)->format("F") . " " . Carbon\Carbon::createFromFormat("Y-m", $bulan)->year }}</p>
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
                    <th>Pulang</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < Carbon\Carbon::createFromFormat("Y-m", $bulan)->daysInMonth; $i++)
                    @php
                        $date = Carbon\Carbon::today()->startOfMonth()->addDays($i);
                        $presence = $employee->presence()->whereDate("created_at", $date)->first();
                        $masuk = $presence ? $presence->created_at->format('H:i:s') : '-';
                        $pulang = $presence && $masuk != $presence->updated_at->format('H:i:s') ? $presence->updated_at->format('H:i:s') : '-';
                        $deskripsi = '';

                        if ($masuk != '-' && $pulang != '-' && \Carbon\Carbon::createFromFormat('H:i:s', $masuk)->isBefore(\Carbon\Carbon::createFromFormat('H:i:s', '07:00:00')) && \Carbon\Carbon::createFromFormat('H:i:s', $pulang)->isAfter(\Carbon\Carbon::createFromFormat('H:i:s', '16:00:00'))) {
                            $deskripsi = 'Tepat waktu';
                        } elseif ($masuk != '-' && $pulang != '-' && \Carbon\Carbon::createFromFormat('H:i:s', $masuk)->isBefore(\Carbon\Carbon::createFromFormat('H:i:s', '07:00:00')) && \Carbon\Carbon::createFromFormat('H:i:s', $pulang)->isBefore(\Carbon\Carbon::createFromFormat('H:i:s', '16:00:00'))) {
                            $deskripsi = 'Pulang Cepat';
                        } elseif ($masuk != '-' && $pulang == '-' && \Carbon\Carbon::createFromFormat('H:i:s', $masuk)->isBefore(\Carbon\Carbon::createFromFormat('H:i:s', '07:00:00'))) {
                            $deskripsi = 'Belum Absen Pulang';
                        } elseif ($masuk != '-' && \Carbon\Carbon::createFromFormat('H:i:s', $masuk)->isAfter(\Carbon\Carbon::createFromFormat('H:i:s', '07:00:00'))) {
                            $deskripsi = 'Telat';
                        } else {
                            $deskripsi = 'Tidak Absen';
                        }
                    @endphp
                    @switch($deskripsi)
                        @case('Tepat waktu')
                        <tr>
                            <td class="employee-hadir">{{ $date->format('Y-m-d') }}</td>
                            <td class="employee-hadir">{{ $masuk }}</td>
                            <td class="employee-hadir">{{ $pulang }}</td>
                            <td class="employee-hadir">{{ $deskripsi }}</td>
                        </tr>
                            @break
                        @case('Pulang Cepat')
                        <tr>
                            <td class="employee-kuning">{{ $date->format('Y-m-d') }}</td>
                            <td class="employee-kuning">{{ $masuk }}</td>
                            <td class="employee-kuning">{{ $pulang }}</td>
                            <td class="employee-kuning">{{ $deskripsi }}</td>
                        </tr>
                            @break
                        @case('Belum Absen Pulang')
                        <tr>
                            <td class="employee-kuning">{{ $date->format('Y-m-d') }}</td>
                            <td class="employee-kuning">{{ $masuk }}</td>
                            <td class="employee-kuning">{{ $pulang }}</td>
                            <td class="employee-kuning">{{ $deskripsi }}</td>
                        </tr>
                            @break
                        @case('Telat')
                        <tr>
                            <td class="employee-kuning">{{ $date->format('Y-m-d') }}</td>
                            <td class="employee-kuning">{{ $masuk }}</td>
                            <td class="employee-kuning">{{ $pulang }}</td>
                            <td class="employee-kuning">{{ $deskripsi }}</td>
                        </tr>
                            @break

                        @default
                        <tr>
                            <td>{{ $date->format('Y-m-d') }}</td>
                            <td>{{ $masuk }}</td>
                            <td>{{ $pulang }}</td>
                            <td>{{ $deskripsi }}</td>
                        </tr>

                    @endswitch

                @endfor
            </tbody>
        </table>

</body>


</html>
