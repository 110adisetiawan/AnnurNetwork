@extends('../layout')
@section('content')
<div class="col-md-6">
    <div class="card">
        <h1 class="card-header">Tambah Tugas</h1>
        <div class="card-body">
            <form action=" {{ route('task.store') }}" method="post">
                @csrf
                <div class="form-floating form-floating-outline mb-6">
                    <input type="text" class="form-control" id="basic-default-fullname" placeholder="Pasang Baru" name="nama_tugas">
                    <label for="basic-default-fullname">Nama Tugas</label>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
    @endsection
