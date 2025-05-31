@extends('../layout')
@section('content')
<div class="col-md-6">
    <div class="card">
        <h1 class="card-header">Tambah Karyawan</h1>
        <div class="card-body">
            <form action=" {{ route('karyawan.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @error('nama')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <input type="text" class="form-control" id="basic-default-fullname" placeholder="John Doe" name="nama" value="{{ @old('nama') }}">
                    <label for="basic-default-fullname">Nama</label>
                </div>
                @error('alamat')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <input type="text" class="form-control" id="basic-default-fullname" placeholder="Jl.xxx No.x" name="alamat" value="{{ @old('alamat') }}">
                    <label for=" basic-default-fullname">Alamat</label>
                </div>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <input type="email" class="form-control" id="basic-default-fullname" placeholder="example@example.com" name="email" value="{{ @old('email') }}">
                    <label for=" basic-default-email">Email</label>
                </div>
                @error('no_hp')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <input type="text" class="form-control" id="basic-default-fullname" placeholder="081234567890" name="no_hp" value="{{ @old('no_hp') }}">
                    <label for="basic-default-fullname">No. Handphone</label>
                </div>
                @error('foto')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="mb-6">
                    <label for="formFile" class="form-label">Upload Foto</label>
                    <input class="form-control" type="file" id="formFile" name="foto">
                </div>
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <input type="password" class="form-control" id="basic-default-fullname" placeholder="" name="password">
                    <label for="basic-default-fullname">Password</label>
                </div>
                <select class="select2 form-select" name="role">
                    <option value="">Pilih Role User</option>
                    @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-primary mt-6">Simpan</button>
            </form>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="card">
        <h1 class="card-header">Preview Foto</h1>
        <div class="card-body text-center">
            <img class="d-block mx-auto w-full h-100 rounded" id="preview-image" src="{{ url('/') }}/assets/img/karyawan/null.png" alt="Preview Foto" class="img-fluid" style="max-height: 300px; display: none;">
        </div>
    </div>
</div>

<script>
    document.getElementById('formFile').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const previewImage = document.getElementById('preview-image');
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            previewImage.src = '#';
            previewImage.style.display = 'none';
        }
    });

</script>
@endsection
