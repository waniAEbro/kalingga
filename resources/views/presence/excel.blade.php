<table>
    <thead>
        <tr>
            <th colspan="4">Presensi Pegawai</th>
        </tr>
        <tr></tr>
        <tr>
            <th>Nama Pegawai</th>
            <th>{{ $employee->employee_name }}</th>
        </tr>
        <tr>
            <th>Bulan</th>
            <th>{{ Carbon\Carbon::createFromFormat('Y-m', $bulan)->format('F') . ' ' . Carbon\Carbon::createFromFormat('Y-m', $bulan)->year }}
            </th>
        </tr>
        <tr></tr>
        <tr>
            <th>Tanggal</th>
            <th>Masuk</th>
            <th>Pulang</th>
            <th>deskripsi</th>
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
                $masuk = $presence && $presence->in ? $presence->created_at->format('H:i:s') : 'N/A';
                $pulang = $presence && $presence->out ? $presence->updated_at->format('H:i:s') : 'N/A';

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
    </tbody>
</table>
