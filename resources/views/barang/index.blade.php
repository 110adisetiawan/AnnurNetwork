@extends('../layout')

@section('content')
<div class="container">
    <h1>Data Barang</h1>
    @can('data-create')
    <a href="{{ route('barang.create') }}" class="btn btn-primary mb-5">Tambah Barang</a>
    @endcan
    @if(session('success'))
    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif
    <div class="card">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Kode Barang</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    @can('data-master')
                    <th>Action</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @if($barangs->count() == 0)
                <tr>
                    <td colspan="6" class="text-center">Data tidak ditemukan</td>
                </tr>
                @endif
                @foreach ($barangs as $k)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $k->nama_barang }}</td>
                    <td>{{ $k->kode_barang }}</td>
                    <td>@currency($k->harga)</td>
                    <td>{{ $k->stok }}</td>
                    <td>
                        @can('data-master')
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-more-2-line"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                                <a href="{{ route('barang.edit', $k->id) }}" class="dropdown-item waves-effect"><i class="ri-pencil-line text-warning me-1"></i> Edit</a>
                                <form action="{{ route('karyawan.destroy', $k->id) }}" method="post" style="display: inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="dropdown-item waves-effect"><i class="ri-delete-bin-6-line text-danger me-1"></i> Delete</button>
                                </form>
                            </div>
                        </div>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
