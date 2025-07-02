<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Produk</title>
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

    <h2>Laporan Pergerakan Stok</h2>
    <p><strong>Periode:</strong>
        @if(request('filter') === 'date' && $from && $to)
        {{ $from }} - {{ $to }}
        @elseif(request('filter') === 'month')
        {{ \Carbon\Carbon::createFromDate(request('year'), (int) request('month'), 1)->locale('id')->isoFormat('MMMM Y') }}
        @else
        Semua Transaksi
        @endif
    </p>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Kode</th>
                <th>Produk</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Status Kerusakan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $r)
            <tr>
                <td>{{ $r->transaction_date }}</td>
                <td>{{ $r->custom_id }}</td>
                <td>{{ $r->product->name ?? '-' }}</td>
                <td>{{ ucfirst($r->movement_type) }}</td>
                <td>{{ $r->quantity }}</td>
                <td>{{ $r->damage_status == 'none' ? 'Normal' : 'Rusak - '.$r->damage_reason }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
