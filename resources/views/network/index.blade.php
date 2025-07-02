@extends('../layout')

@section('content')
<div class="container">
    <h1>Data OLT</h1>
    @can('data create')
    <a href="{{ route('network.create') }}" class="btn btn-primary mb-5">Tambah Device</a>
    @endcan
    @if(session('success'))
    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width=10%>No</th>
                        <th>Nama Device</th>
                        <th>Serial Number</th>
                        <th>IP Address</th>
                        <th>Status</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        @can('data edit')
                        <th width=20%>Aksi</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>

                    @if($networks->count() == 0)
                    <tr>
                        <td colspan="8" class="text-center">Data tidak ditemukan</td>
                    </tr>
                    @endif
                    @foreach ($networks as $k)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $k->nama_device }}</td>
                        <td>{{ $k->serial_number }}</td>
                        <td>{{ $k->ip_address }}</td>
                        <td>@if($k->status == 'active')
                            <span class="badge rounded-pill bg-label-success me-1">Active</span>
                            @elseif($k->status == 'offline')
                            <span class="badge rounded-pill bg-label-danger me-1">{{ $k->status }}</span>
                            @elseif($k->status == 'rusak')
                            <span class="badge rounded-pill bg-label-dark me-1">{{ $k->status }}</span>
                        </td>
                        @endif
                        <td>{{ $k->latitude }}</td>
                        <td>{{ $k->longitude }}</td>
                        @can('data edit')
                        <td>
                            <a href="{{ route('network.edit', $k->id) }}" class="btn btn-warning">Edit</a>
                            @can('data delete')
                            <form action="{{ route('network.destroy', $k->id) }}" method="post" style="display: inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                            @endcan
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
