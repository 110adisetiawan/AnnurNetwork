@extends('../layout')

@section('content')
<div class="container">
    <h1>Transaksi Barang</h1>
    <a href="#" class="btn btn-primary mb-5" data-bs-toggle="modal" data-bs-target="#modalCenter">Tambah Transaksi</a>
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success'
            , title: 'Sukses!'
            , text: '{{ session('success') }}'
            , timer: 4000
            , showConfirmButton: false
        });

    </script>

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
                    <th>Kode Transaksi</th>
                    <th>Barang</th>
                    <th>Tanggal</th>
                    <th>Stok</th>
                    <th>Kondisi Barang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if($product_movements->count() == 0)
                <tr>
                    <td colspan="8" class="text-center">Data tidak ditemukan</td>
                </tr>
                @endif
                @foreach ($product_movements as $k)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $k->custom_id }}</td>
                    <td>{{ $k->product->name ?? 'Tidak ada barang' }}</td>
                    <td>{{ $k->transaction_date }}</td>
                    <td>{{ $k->quantity }}</td>
                    <td>
                    @if($k->damage_status == 'none')
                        <span class="badge rounded-pill bg-label-success me-1">Normal</span>
                    @elseif($k->damage_status == 'damaged')
                        <span class="badge rounded-pill bg-label-danger me-1">Rusak</span>
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-more-2-line"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                                <a href="{{ route('product_stock_movements.edit', $k->id) }}" class="dropdown-item waves-effect"><i class="ri-pencil-line text-warning me-1"></i> Edit</a>
                                <form action="{{ route('product_stock_movements.destroy', $k->id) }}" method="post" style="display: inline">
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
                <h5 class="modal-title" id="modalCenterTitle">Tambah Transaksi Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-6 mt-2">
                        <form action=" {{ route('product_stock_movements.store') }}" method="post">
                            @csrf
                            @error('product_id')
                            <div class="alert alert-danger alert-dismissible" role="alert">{{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @enderror
                            <div class="form-floating form-floating-outline mb-6">
                                <select id="country" class="select2 form-select" name="product_id">
                                    <option value="">Pilih Nama Barang</option>
                                    @foreach ($product as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }} - stok : {{ $product->stock }}</option>
                                    @endforeach
                                </select>
                                <label for="country">Nama Barang</label>
                            </div>
                            @error('movement_type')
                            <div class="alert alert-danger alert-dismissible" role="alert">{{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @enderror
                            <div class="form-floating form-floating-outline mb-6">
                                <select id="country" class="select2 form-select" name="movement_type">
                                    <option value="masuk">Masuk</option>
                                    <option value="keluar">Keluar</option>
                                </select>
                                <label for="country">Jenis Transaksi</label>
                            </div>
                            @error('quantity')
                            <div class="alert alert-danger alert-dismissible" role="alert">{{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @enderror
                            <div class="form-floating form-floating-outline">
                                <input type="text" class="form-control" name="quantity" placeholder="Masukkan quantity barang" value="{{ old('quantity') }}">
                                <label for="nameWithTitle">Qty</label>
                            </div>
                            @error('damage_status')
                            <div class="alert alert-danger alert-dismissible" role="alert">{{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @enderror
                            <div class="mb-3">
                                <label class="form-label d-block mt-3">Status Barang</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="damage_status" id="statusNormal" value="none" {{ (!old('damage_status')) ? 'checked' : '' }}{{ old('damage_status') == 'normal' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="statusNormal">Normal</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="damage_status" id="statusRusak" value="damaged" {{ old('damage_status') =='damaged' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="statusRusak">Rusak</label>
                                </div>
                            </div>
                            @error('damage_reason')
                            <div class="alert alert-danger alert-dismissible" role="alert">{{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @enderror
                            <div class="form-floating form-floating-outline mb-6" id="keteranganRusakContainer" style="display:none;">
                                <textarea class="form-control" placeholder="Jelaskan kerusakan barang" id="keteranganRusak" name="damage_reason" style="height: 100px">{{ old('damage_reason') }}</textarea>
                                <label for="keteranganRusak">Keterangan Kerusakan</label>
                            </div>
                            @error('transaction_date')
                            <div class="alert alert-danger alert-dismissible" role="alert">{{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @enderror
                            <div class="mb-3">
                                <label for="transaction_date" class="form-label">Tanggal Transaksi</label>
                                <input type="date" name="transaction_date" id="transaction_date" class="form-control" value="{{ date('Y-m-d') }}" required>
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

<script>
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

{{-- end modal create  --}}
@endsection
