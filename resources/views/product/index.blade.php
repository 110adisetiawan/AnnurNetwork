@extends('../layout')

@section('content')
<div class="container">
    <h1>Data Barang</h1>
    <a href="#" class="btn btn-primary mb-5" data-bs-toggle="modal" data-bs-target="#modalCenter">Tambah Barang</a>
    @if(session('success'))
    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif
    @if($errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert">terjadi kesalahan, silahkan periksa kembali data yang anda masukkan.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
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

{{-- Modal Create Form  --}}
<div class="modal fade" id="modalCenter" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Tambah Data Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-6 mt-2">
                        <form action=" {{ route('products.store') }}" method="post">
                            @csrf
                            @error('name')
                            <div class="alert alert-danger alert-dismissible" role="alert">{{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @enderror
                            <div class="form-floating form-floating-outline mb-6">
                                <input type="text" class="form-control" id="basic-default-fullname" placeholder="Masukkan nama Barang" name="name" value="{{ old('name') }}">
                                <label for="basic-default-fullname">Nama Barang</label>
                            </div>
                            @error('sku')
                            <div class="alert alert-danger alert-dismissible" role="alert">{{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @enderror
                            <div class="form-floating form-floating-outline mb-6">
                                <input type="text" class="form-control" id="basic-default-fullname" placeholder="Masukkan SKU (kode unik)" name="sku" value="{{ old('sku') }}">
                                <label for="basic-default-fullname">SKU</label>
                            </div>
                            @error('product_category_id')
                            <div class="alert alert-danger alert-dismissible" role="alert">{{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @enderror
                            <div class="form-floating form-floating-outline mb-6">
                                <select id="country" class="select2 form-select" name="product_category_id">
                                    <option value="">Pilih Kategori Barang</option>
                                    @foreach ($category as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <label for="country">Kategori</label>
                            </div>
                            @error('product_supplier_id')
                            <div class="alert alert-danger alert-dismissible" role="alert">{{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @enderror
                            <div class="form-floating form-floating-outline mb-6">
                                <select id="country" class="select2 form-select" name="product_supplier_id">
                                    <option value="">Pilih Supplier Barang</option>
                                    @foreach ($supplier as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                                <label for="country">Supplier</label>
                            </div>
                            @error('price')
                            <div class="alert alert-danger alert-dismissible" role="alert">{{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @enderror
                            <div class="form-floating form-floating-outline mb-6">
                                <input type="text" class="form-control" id="price_display" placeholder="Masukkan harga" oninput="formatRupiah(this)" value="{{ old('price') }}">
                                <input type="hidden" id="price" name="price">
                                <label for="basic-default-fullname">Harga</label>
                            </div>
                            @error('stock')
                            <div class="alert alert-danger alert-dismissible" role="alert">{{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @enderror
                            <div class="form-floating form-floating-outline mb-6">
                                <input type="number" class="form-control" id="basic-default-fullname" placeholder="Masukkan Stok" name="stock" value="{{ old('stock') }}">
                                <label for="basic-default-fullname">Stok</label>
                            </div>
                            @error('condition')
                            <div class="alert alert-danger alert-dismissible" role="alert">{{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @enderror
                            <div class="mb-3">
                                <label class="form-label d-block">Status Barang</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="condition" id="statusNormal" value="normal" {{ (!old('condition')) ? 'checked' : '' }}{{ old('condition') == 'normal' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="statusNormal">Normal</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="condition" id="statusRusak" value="damaged" {{ old('condition') =='damaged' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="statusRusak">Rusak</label>
                                </div>
                            </div>
                            @error('damage_description')
                            <div class="alert alert-danger alert-dismissible" role="alert">{{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @enderror
                            <div class="form-floating form-floating-outline mb-6" id="keteranganRusakContainer" style="display:none;">
                                <textarea class="form-control" placeholder="Jelaskan kerusakan barang" id="keteranganRusak" name="damage_description" style="height: 100px">{{ old('damage_description') }}</textarea>
                                <label for="keteranganRusak">Keterangan Kerusakan</label>
                            </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary waves-effect" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">Insert</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- end modal create  --}}


<script>
    function formatRupiah(input) {
        let rawValue = input.value.replace(/\D/g, ''); // Ambil angka tanpa titik/koma
        document.getElementById('price').value = rawValue; // Simpan nilai asli tanpa format ke hidden input
        input.value = rawValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Tambahkan titik ribuan di tampilan
    }




    document.addEventListener('DOMContentLoaded', function() {
        const rusakRadio = document.getElementById('statusRusak');
        const normalRadio = document.getElementById('statusNormal');
        const keteranganContainer = document.getElementById('keteranganRusakContainer');

        function toggleKeterangan() {
            if (rusakRadio.checked) {
                keteranganContainer.style.display = '';
            } else {
                keteranganContainer.style.display = 'none';
            }
        }

        rusakRadio.addEventListener('change', toggleKeterangan);
        normalRadio.addEventListener('change', toggleKeterangan);

        // Initial state
        toggleKeterangan();
    });

</script>

@endsection
