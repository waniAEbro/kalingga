<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Masuk</th>
            <th>Pulang</th>
            <th>deskripsi</th>
        </tr>
    </thead>
    <tbody>
        @for ($i = 0; $i < \Carbon\Carbon::today()->daysInMonth; $i++)
            @php
                $date = \Carbon\Carbon::today()
                    ->startOfMonth()
                    ->addDays($i);
                $presence = $employees[0]->presence();
                $presence = $presence->whereDate('created_at', $date)->first();
                $masuk = $presence ? $presence->created_at->format('H:i:s') : 'N/A';
                $pulang = $presence && $masuk != $presence->updated_at->format('H:i:s') ? $presence->updated_at->format('H:i:s') : 'N/A';
                // $deskripsi = $masuk != 'N/A' && \Carbon\Carbon::createFromFormat('H:i:s', $masuk)->isBefore(\Carbon\Carbon::createFromFormat('H:i:s', '07:00:00')) ? 'Tepat waktu' : 'telat';

                $deskripsi = '';

                if ($masuk != 'N/A' && $pulang != 'N/A' && \Carbon\Carbon::createFromFormat('H:i:s', $masuk)->isBefore(\Carbon\Carbon::createFromFormat('H:i:s', '07:00:00')) && \Carbon\Carbon::createFromFormat('H:i:s', $pulang)->isAfter(\Carbon\Carbon::createFromFormat('H:i:s', '16:00:00'))) {
                    $deskripsi = 'Tepat waktu';
                } elseif ($masuk != 'N/A' && $pulang != 'N/A' && \Carbon\Carbon::createFromFormat('H:i:s', $masuk)->isBefore(\Carbon\Carbon::createFromFormat('H:i:s', '07:00:00')) && \Carbon\Carbon::createFromFormat('H:i:s', $pulang)->isBefore(\Carbon\Carbon::createFromFormat('H:i:s', '16:00:00'))) {
                    $deskripsi = 'Pulang Cepat';
                } elseif ($masuk != 'N/A' && $pulang == 'N/A' && \Carbon\Carbon::createFromFormat('H:i:s', $masuk)->isBefore(\Carbon\Carbon::createFromFormat('H:i:s', '07:00:00'))) {
                    $deskripsi = 'Belum Absen Pulang';
                } elseif ($masuk != 'N/A' && \Carbon\Carbon::createFromFormat('H:i:s', $masuk)->isAfter(\Carbon\Carbon::createFromFormat('H:i:s', '07:00:00'))) {
                    $deskripsi = 'Telat';
                } else {
                    $deskripsi = 'Tidak Absen';
                }

            @endphp
            <tr>
                <td>{{ $date->format('Y-m-d') }}</td>
                <td>{{ $masuk }}</td>
                <td>{{ $pulang }}</td>
                <td>{{ $deskripsi }}</td>
            </tr>
        @endfor
        <tr>
            <td>12</td>
            <td>12</td>
            <td>13</td>
            <td>masuk</td>
        </tr>
    </tbody>
</table>
