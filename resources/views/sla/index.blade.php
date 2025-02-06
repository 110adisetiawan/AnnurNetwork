@extends('../layout')

@section('content')
<div class="container">
    <h1>Data SLA</h1>
    <a href="{{ route('sla.create') }}" class="btn btn-primary mb-5">Tambah SLA</a>
    @if(session('success'))
    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif
    <div class="card">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width=10px>No</th>
                    <th>Nama SLA</th>
                    <th>Deskripsi</th>
                    <th>SLA Pekerjaan</th>
                    <th width=20%>Aksi</th>
                </tr>
            </thead>
            <tbody>

                @if($sla->count() == 0)
                <tr>
                    <td colspan="4" class="text-center">Data tidak ditemukan</td>
                </tr>
                @endif
                @foreach ($sla as $k)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $k->nama_sla }}</td>
                    <td>{{ $k->description }}</td>
                    <td>{{ $k->time }} Jam</td>
                    <td>
                        <a href="{{ route('sla.edit', $k->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('sla.destroy', $k->id) }}" method="post" style="display: inline">
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
