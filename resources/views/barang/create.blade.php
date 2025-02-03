@extends('../layout')
@section('content')
<div class="col-md-6">
    <div class="card">
        <h1 class="card-header">Tambah Barang</h1>
        <div class="card-body">
            <form action=" {{ route('barang.store') }}" method="post">
                @csrf
                @error('nama_barang')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <input type="text" class="form-control" id="basic-default-fullname" placeholder="Switch / Modem / ONU" name="nama_barang" value="{{ @old('nama_barang') }}">
                    <label for="basic-default-fullname">Nama Barang</label>
                </div>
                @error('kode_barang')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <input type="text" class="form-control" id="basic-default-fullname" placeholder="XXXX XXXX XX" name="kode_barang" value="{{ @old('kode_barang') }}">
                    <label for=" basic-default-fullname">Kode Barang</label>
                </div>
                @error('harga')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <input type="number" class="form-control" id="basic-default-fullname" placeholder="100.000" name="harga" value="{{ @old('harga') }}">
                    <label for=" basic-default-email">Harga</label>
                </div>
                @error('stok')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <input type="number" class="form-control" id="basic-default-fullname" placeholder="100" name="stok" value="{{ @old('stok') }}">
                    <label for="basic-default-fullname">Stok</label>
                </div>


                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
    @endsection
