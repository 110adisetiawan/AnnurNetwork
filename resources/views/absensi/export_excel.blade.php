<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Absensi Karyawan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #444;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }

        h2 {
            margin-bottom: 0;
        }

    </style>
</head>
<body>

    @php
    use Carbon\Carbon;
    $from = request('from_date') ? Carbon::parse(request('from_date'))->locale('id')->translatedFormat('j F Y') : null;
    $to = request('to_date') ? Carbon::parse(request('to_date'))->locale('id')->translatedFormat('j F Y') : null;
    @endphp

    <h2>Laporan Absensi Karyawan</h2>
    <p><strong>Periode:</strong>
        @if(request('filter') === 'date' && $from && $to)
        {{ $from }} - {{ $to }}
        @elseif(request('filter') === 'month')
        {{ \Carbon\Carbon::createFromDate(request('year'), (int) request('month'), 1)->locale('id')->isoFormat('MMMM Y') }}
        @else
        Semua Periode Absensi
        @endif
    </p>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Karyawan</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absensis as $a)
            <tr>
                <td>{{ $a->created_at->isoFormat('dddd, D MMMM Y') }}</td>
                <td>{{ $a->user->name }}</td>
                <td>{{ $a->masuk->format('H:i:s') }}</td>
                <td>{{ $a->pulang->format('H:i:s') }}</td>
                <td>{{ $a->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
