@extends('../layout')
@section('content')
<div class="col-md-6">
    <div class="card">
        <h1 class="card-header">Edit Barang</h1>
        <div class="card-body">
            <form action=" {{ route('products.update', $product->id) }}" method="post">
                @csrf
                @method('PUT')
                @error('name')
                <div class="alert alert-danger alert-dismissible" role="alert">{{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <input type="text" class="form-control" id="basic-default-fullname" placeholder="Masukkan nama Barang" name="name" value="{{ $product->name }}">
                    <label for="basic-default-fullname">Nama Barang</label>
                </div>
                @error('sku')
                <div class="alert alert-danger alert-dismissible" role="alert">{{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <input type="text" class="form-control" id="basic-default-fullname" placeholder="Masukkan SKU (kode unik)" value="{{ $product->sku }}" disabled>
                    <label for="basic-default-fullname">SKU</label>
                </div>
                @error('product_category_id')
                <div class="alert alert-danger alert-dismissible" role="alert">{{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <select id="country" class="select2 form-select" name="product_category_id">
                        <option value="{{ $product->product_category_id }}">{{ $product->product_category->name }}</option>
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
                        <option value="{{ $product->product_supplier_id }}">{{ $product->product_supplier->name }}</option>
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
                    <input type="text" class="form-control" id="price_display" placeholder="Masukkan harga" oninput="formatRupiah(this)" value="{{ $product->price }}" name="price" onkeyup="formatRupiah(this)">
                    <input type="hidden" id="price" name="price" value="{{ $product->price }}">
                    <label for="basic-default-fullname">Harga</label>
                </div>
                @error('stock')
                <div class="alert alert-danger alert-dismissible" role="alert">{{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <input type="number" class="form-control" id="basic-default-fullname" placeholder="Masukkan Stok" name="stock" value="{{ $product->stock }}">
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
                        <input class="form-check-input" type="radio" name="condition" id="statusNormal" value="normal" {{ (!$product->condition) ? 'checked' : '' }}{{ $product->condition == 'normal' ? 'checked' : '' }}>
                        <label class="form-check-label" for="statusNormal">Normal</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="condition" id="statusRusak" value="damaged" {{ $product->condition =='damaged' ? 'checked' : '' }}>
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


                <button type="submit" class="btn btn-primary mt-2">Simpan</button>
            </form>
        </div>
    </div>
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
</div>
@endsection
