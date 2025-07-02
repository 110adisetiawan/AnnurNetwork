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
            <th>Kerusakan</th>
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
