@extends('../layout')
@section('content')
<div class="col-md-6">
    <div class="card">
        <h1 class="card-header">Tambah Prioritas</h1>
        <div class="card-body">
            <form action=" {{ route('priority.store') }}" method="post">
                @csrf
                <div class="form-floating form-floating-outline mb-6">
                    <input type="text" class="form-control" id="basic-default-fullname" placeholder="Urgent / Medium / Low" name="nama_prioritas" required>
                    <label for="basic-default-fullname">Nama Prioritas</label>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
    @endsection
