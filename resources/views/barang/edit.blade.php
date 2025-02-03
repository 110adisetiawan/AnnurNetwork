@extends('../layout')
@section('content')
<div class="col-md-6">
    <div class="card">
        <h1 class="card-header">Edit Barang</h1>
        <div class="card-body">
            <form action=" {{ route('barang.update',$barang->id) }}" method="post">
                @csrf
                @method('put')
                <div class="form-floating form-floating-outline mb-6">
                    <input type="text" class="form-control" id="basic-default-fullname" placeholder="MODEM / ONT / HTB" name="nama_barang" value="{{ old('title', $barang->nama_barang) }}">
                    <label for=" basic-default-fullname">Nama Barang</label>
                </div>
                <div class="form-floating form-floating-outline mb-6">
                    <input type="text" class="form-control" id="basic-default-fullname" placeholder="XXXX XX X" name="kode_barang" value="{{ old('title', $barang->kode_barang) }}">
                    <label for=" basic-default-fullname">Kode Barang</label>
                </div>
                <div class="form-floating form-floating-outline mb-6">
                    <input type="text" class="form-control" id="basic-default-fullname" placeholder="xxx.xxx" name="harga" value="{{ old('title', $barang->harga) }}">
                    <label for=" basic-default-fullname">Harga</label>
                </div>
                <div class="form-floating form-floating-outline mb-6">
                    <input type="text" class="form-control" id="basic-default-fullname" placeholder="xx" name="stok" value="{{ old('title', $barang->stok) }}">
                    <label for=" basic-default-fullname">Stock</label>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
    @endsection
