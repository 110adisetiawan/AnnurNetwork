@extends('../layout')

@section('content')
<div class="container">
    <h1>Supplier Barang</h1>
    <button type="button" class="btn btn-primary waves-effect waves-light mb-6" data-bs-toggle="modal" data-bs-target="#modalCenter">
        Tambah Supplier Barang
    </button>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible" role="alert">{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @error('name')
    <div class="alert alert-danger alert-dismissible" role="alert">{{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @enderror
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Supplier</th>
                        <th>No. Telepon</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($suppliers->count() == 0)
                    <tr>
                        <td colspan="8" class="text-center">Data tidak ditemukan</td>
                    </tr>
                    @endif
                    @foreach ($suppliers as $k)
                    <tr>
                        <td>{{ $suppliers->firstItem() + $loop->index }}</td>
                        <td>{{ $k->name }}</td>
                        <td>{{ $k->contact_info ?? '-' }}</td>
                        <td>{{ $k->address ?? '-' }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ri-more-2-line"></i>
                                </button>
                                <div class="dropdown-menu" style="">
                                    <a data-bs-toggle="modal" data-bs-target="#editModal{{ $k->id }}" class="dropdown-item waves-effect"><i class="ri-pencil-line text-warning me-1"></i> Edit</a>
                                    <form action="{{ route('product_suppliers.destroy', $k->id) }}" method="post" style="display: inline">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" id="nameWithTitle" class="form-control" name="id" value="{{ $k->id }}">
                                        <input type="hidden" id="nameWithTitle" class="form-control" name="name" value="{{ $k->name }}">
                                        <button type="submit" class="dropdown-item waves-effect"><i class="ri-delete-bin-6-line text-danger me-1"></i> Delete</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>

                    {{-- Modal Edit Form  --}}
                    <div class="modal fade" id="editModal{{ $k->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCenterTitle">Edit Supplier Barang</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col mb-6 mt-2">
                                            <form action=" {{ route('product_suppliers.update', $k->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" id="nameWithTitle" class="form-control" name="id" value="{{ $k->id }}">
                                                <div class="form-floating form-floating-outline mb-6">
                                                    <input type="text" id="nameWithTitle" class="form-control" name="name" placeholder="Masukkan nama Supplier barang" value="{{ $k->name }}">
                                                    <label for="nameWithTitle">Nama Supplier Barang</label>
                                                </div>
                                                <div class="form-floating form-floating-outline mb-6">
                                                    <input type="text" id="nameWithTitle" class="form-control" name="contact_info" placeholder="Masukkan No.Telepon supplier barang" value="{{ $k->contact_info }}">
                                                    <label for="nameWithTitle">Telepon Supplier Barang</label>
                                                </div>
                                                <div class="form-floating form-floating-outline mb-6">
                                                    <input type="text" id="nameWithTitle" class="form-control" name="address" placeholder="Masukkan alamat supplier barang" value="{{ $k->address }}">
                                                    <label for="nameWithTitle">Alamat Supplier Barang</label>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary waves-effect" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- end modal edit  --}}

                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
{{ $suppliers->onEachSide(5)->links() }}

{{-- Modal Create Form  --}}
<div class="modal fade" id="modalCenter" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Tambah Supplier Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-6 mt-2">
                        <form action=" {{ route('product_suppliers.store') }}" method="post">
                            @csrf
                            <div class="form-floating form-floating-outline mb-6">
                                <input type="text" id="nameWithTitle" class="form-control" name="name" placeholder="Masukkan nama Supplier barang" value="{{ old('name') }}">
                                <label for="nameWithTitle">Nama Supplier Barang</label>
                            </div>
                            <div class="form-floating form-floating-outline mb-6">
                                <input type="text" id="nameWithTitle" class="form-control" name="contact_info" placeholder="Masukkan No. Telepon supplier barang" value="{{ old('contact_info') }}">
                                <label for="nameWithTitle">No. Telepon Supplier Barang</label>
                            </div>
                            <div class="form-floating form-floating-outline mb-6">
                                <input type="text" id="nameWithTitle" class="form-control" name="address" placeholder="Masukkan Alamat supplier barang" value="{{ old('address') }}">
                                <label for="nameWithTitle">Alamat Supplier Barang</label>
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


@endsection
