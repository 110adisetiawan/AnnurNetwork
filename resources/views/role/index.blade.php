@extends('../layout')

@section('content')
<div class="container">
    <h1>Data Role</h1>
    <a href="{{ route('role.create') }}" class="btn btn-primary mb-5">Tambah Role</a>
    @if(session('success'))
    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif
    <div class="card">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width=10px>No</th>
                    <th>Nama Role</th>
                    <th width=30%>Aksi</th>
                </tr>
            </thead>
            <tbody>

                @if($roles->count() == 0)
                <tr>
                    <td colspan="4" class="text-center">Data tidak ditemukan</td>
                </tr>
                @endif
                @foreach ($roles as $role)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a href="{{ route('role.edit', $role->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('role.destroy', $role->id) }}" method="post" style="display: inline">
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
