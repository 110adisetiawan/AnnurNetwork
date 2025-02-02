@extends('../layout')

@section('content')
<div class="container">
    <h1>Data Jenis Tugas</h1>
    <a href="{{ route('task.create') }}" class="btn btn-primary mb-5">Tambah Tugas</a>
    @if(session('success'))
    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif
    <div class="card">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width=10%>No</th>
                    <th>Nama Tugas</th>
                    <th width=20%>Aksi</th>
                </tr>
            </thead>
            <tbody>

                @if($tasks->count() == 0)
                <tr>
                    <td colspan="3" class="text-center">Data tidak ditemukan</td>
                </tr>
                @endif
                @foreach ($tasks as $k)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $k->nama_tugas }}</td>
                    <td>
                        <a href="{{ route('task.edit', $k->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('task.destroy', $k->id) }}" method="post" style="display: inline">
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
