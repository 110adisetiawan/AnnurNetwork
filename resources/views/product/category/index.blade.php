@extends('../layout')

@section('content')
<div class="container">
    <h1>Kategori Barang</h1>
    <button type="button" class="btn btn-primary waves-effect waves-light mb-6" data-bs-toggle="modal" data-bs-target="#modalCenter">
        Tambah Kategori Barang
    </button>
    @if(session('success'))
    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif
    @error('name')
    <div class="alert alert-danger alert-dismissible" role="alert">{{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @enderror
    <div class="card">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if($categories->count() == 0)
                <tr>
                    <td colspan="8" class="text-center">Data tidak ditemukan</td>
                </tr>
                @endif
                @foreach ($categories as $k)
                <tr>
                    <td>{{ $categories->firstItem() + $loop->index }}</td>
                    <td>{{ $k->name }}</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-more-2-line"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                                <a data-bs-toggle="modal" data-bs-target="#editModal{{ $k->id }}" class="dropdown-item waves-effect"><i class="ri-pencil-line text-warning me-1"></i> Edit</a>
                                <form action="{{ route('product_categories.destroy', $k->id) }}" method="post" style="display: inline">
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
                                <h5 class="modal-title" id="modalCenterTitle">Edit Kategori Barang</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col mb-6 mt-2">
                                        <form action=" {{ route('product_categories.update', $k->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-floating form-floating-outline">
                                                <input type="hidden" id="nameWithTitle" class="form-control" name="id" value="{{ $k->id }}">
                                                <input type="text" id="nameWithTitle" class="form-control" name="name" placeholder="Masukkan nama kategori barang" value="{{ $k->name }}">
                                                <label for="nameWithTitle">Nama Kategori Barang</label>
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
{{ $categories->onEachSide(5)->links() }}

{{-- Modal Create Form  --}}
<div class="modal fade" id="modalCenter" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Tambah Kategori Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-6 mt-2">
                        <form action=" {{ route('product_categories.store') }}" method="post">
                            @csrf
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="nameWithTitle" class="form-control" name="name" placeholder="Masukkan nama kategori barang" value="{{ old('name') }}">
                                <label for="nameWithTitle">Nama Kategori Barang</label>
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
