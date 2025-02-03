@extends('../layout')
@section('content')
<div class="col-md-6">
    <div class="card">
        <h1 class="card-header">Tambah Tugas</h1>
        <div class="card-body">
            <form action=" {{ route('sla.store') }}" method="post">
                @csrf
                @error('nama_sla')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <input type="text" class="form-control" id="basic-default-fullname" placeholder="Masukkan nama SLA" name="nama_sla" value="{{ old('nama_sla') }}">
                    <label for="basic-default-fullname">Nama SLA</label>
                </div>
                @error('deskripsi')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <textarea class="form-control h-px-100" id="exampleFormControlTextarea1" placeholder="Masukkan deskripsi" name="description" value="{{ old('description') }}"></textarea>
                    <label for="exampleFormControlTextarea1">Deskripsi</label>
                </div>
                @error('time')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <input type="time" class="form-control" id="basic-default-fullname" placeholder="02:00 AM" name="time" value="{{ old('time') }}">
                    <label for="basic-default-fullname">Waktu</label>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
    @endsection
