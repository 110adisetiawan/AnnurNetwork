@extends('../layout')

@section('content')
<div class="container">
    <h1>Data Barang</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-5">Tambah Barang</a>
    @if(session('success'))
    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif
    <div class="card">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Supplier</th>
                    <th>Stok</th>
                    <th>Harga Barang</th>
                    <th>SKU</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if($products->count() == 0)
                <tr>
                    <td colspan="8" class="text-center">Data tidak ditemukan</td>
                </tr>
                @endif
                @foreach ($products as $k)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $k->name }}</td>
                    <td>{{ $k->product_category->name ?? 'Tidak ada kategori' }}</td>
                    <td>{{ $k->product_supplier->name ?? 'Tidak ada supplier' }}</td>
                    <td>{{ $k->stock }}</td>
                    <td>Rp {{ number_format($k->price, 0, ',', '.') }}</td>
                    <td>{{ $k->sku }}</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-more-2-line"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                                <a href="{{ route('products.edit', $k->id) }}" class="dropdown-item waves-effect"><i class="ri-pencil-line text-warning me-1"></i> Edit</a>
                                <form action="{{ route('products.destroy', $k->id) }}" method="post" style="display: inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="dropdown-item waves-effect"><i class="ri-delete-bin-6-line text-danger me-1"></i> Delete</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
