@extends('../layout')

@section('content')
<div class="container">
    <h1>TIKET</h1>
    <a href="{{ route('ticket.create') }}" class="btn btn-primary mb-5">Tambah Ticket</a>
    @if(session('success'))
    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif
    <div class="card">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width=10%>No</th>
                    <th>Ticket ID</th>
                    <th>Customer</th>
                    <th>Teknisi</th>
                    <th>Urgensi</th>
                    <th>Status</th>
                    <th>Tanggal Dibuat</th>
                    <th width=20%>Aksi</th>
                </tr>
            </thead>
            <tbody>

                @if($tickets->count() == 0)
                <tr>
                    <td colspan="8" class="text-center">Data tidak ditemukan</td>
                </tr>
                @endif
                @foreach ($tickets as $ticket)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->customer_name }}</td>
                    @foreach ($ticket->karyawan()->get() as $karyawan)
                    <td>{{ $karyawan->nama }}</td>
                    @endforeach
                    @foreach ($ticket->priority()->get() as $priority)
                    <td>{{ $priority->nama_prioritas }}</td>
                    @endforeach
                    <td>
                        @if($ticket->status == 'open')
                        <span class="badge rounded-pill bg-label-success me-1">OPEN</span>
                        @elseif($ticket->status == 'onprogress')
                        <span class="badge rounded-pill bg-label-warning me-1">ON PROGRESS</span>
                        @else
                        <span class="badge rounded-pill bg-label-dark me-1">CLOSED</span>@endif
                    </td>
                    <td>{{ $ticket->created_at }}</td>
                    <td>
                        <a href="{{ route('ticket.edit', $ticket->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('ticket.destroy', $ticket->id) }}" method="post" style="display: inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
