@extends('../layout')

@section('content')
<div class="container">
    <h1>Data Priority</h1>
    <a href="{{ route('priority.create') }}" class="btn btn-primary mb-5">Tambah Priority</a>
    @if(session('success'))
    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif
    <div class="card">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width=10%>No</th>
                    <th>Nama</th>
                    <th width=20%>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if($priorities->count() == 0)
                <tr>
                    <td colspan="6" class="text-center">Data tidak ditemukan</td>
                </tr>
                @endif
                @foreach ($priorities as $k)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $k->nama_prioritas }}</td>
                    <td>
                        <a href="{{ route('priority.edit', $k->id) }}" class="btn btn-warning">Edit Data</a>
                        <form action="{{ route('priority.destroy', $k->id) }}" method="post" style="display: inline">
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
