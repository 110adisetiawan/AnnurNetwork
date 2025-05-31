@extends('../layout')
@section('content')
<div class="col-md-6">
    <div class="card">
        <h1 class="card-header">Tambah Role</h1>
        <div class="card-body">
            <form action=" {{ route('role.store') }}" method="post">
                @csrf
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <input type="text" class="form-control" id="basic-default-fullname" placeholder="Masukkan nama Role" name="name" value="{{ old('nama_sla') }}">
                    <label for="basic-default-fullname">Nama Role</label>
                </div>
                <div class="mt-2">
                    <h3>Permission</h3>
                    @foreach($permissions as $permission)
                    <label>
                        <input type="checkbox" name="permissions[{{ $permission->name }}]" value="{{ $permission->name }}">
                        {{ $permission->name }}
                    </label>
                    <br>
                    @endforeach
                </div>


                <button type="submit" class="btn btn-primary mt-2">Simpan</button>
            </form>
        </div>
    </div>
    @endsection
