@extends('../layout')
@section('content')
<div class="col-md-12">
    <div class="nav-align-top">
        <ul class="nav nav-pills flex-column flex-md-row mb-6 gap-2 gap-lg-0">
            <li class="nav-item">
                <a class="nav-link active waves-effect waves-light" href="javascript:void(0);"><i class="ri-group-line me-1_5"></i>Account</a>
            </li>
            <li class="nav-item">
                <a class="nav-link waves-effect waves-light" href="{{ route('password.edit', $karyawan->id) }}"><i class="ri-lock-line text-primary me-1_5"></i>Ubah Password</a>
            </li>
        </ul>
    </div>
    <div class="card">
        <h1 class="card-header">Edit Karyawan</h1>
        <div class="card mb-6">
            <!-- Account -->
            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-6">
                    @if (is_null($karyawan->foto))
                    <img src="{{ asset('assets/img/karyawan/null.png') }}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar">
                    @else
                    <img src="{{ url('/') }}/assets/img/karyawan/{{ $karyawan->foto }}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar">
                    @endif
                    <form action="{{ route('karyawan.update',$karyawan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="button-wrapper">
                            <label for="upload" class="btn btn-sm btn-primary me-3 mb-4 waves-effect waves-light" tabindex="0">
                                <span class="d-none d-sm-block">Upload new photo</span>
                                <i class="ri-upload-2-line d-block d-sm-none"></i>
                                <input name="foto" type="file" id="upload" class="account-file-input" hidden="">
                            </label>

                            <div>Allowed JPG, GIF or PNG. Max size of 800K</div>
                        </div>
                </div>
            </div>
            <div class="card-body pt-0">
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('foto')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="row mt-1 g-5">
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control" type="text" id="firstName" name="nama" value="{{ $karyawan->nama }}" autofocus="">
                            <label for="firstName">Name Lengkap</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control" type="text" id="email" name="email" value="{{ $karyawan->email }}" placeholder="john.doe@example.com">
                            <label for="email">E-mail</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group input-group-merge">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="phoneNumber" name="no_hp" class="form-control" value="{{ $karyawan->no_hp }}" placeholder="1234567890">
                                <label for="phoneNumber">Nomor Handphone</label>
                            </div>
                            <span class="input-group-text">ID (+62)</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" class="form-control" id="address" name="alamat" value="{{ $karyawan->alamat }}">
                            <label for="address">Alamat</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-floating form-floating-outline">
                            <select id="country" class="select2 form-select" name="status">
                                <option @if($karyawan->status == 'aktif') selected @endif value="aktif">aktif</option>
                                <option @if($karyawan->status == 'cuti') selected @endif value="cuti">cuti</option>
                                <option @if($karyawan->status == 'sakit') selected @endif value="sakit">sakit</option>
                            </select>
                            <label for="country">Status</label>
                        </div>
                    </div>
                </div>
                <div class="mt-6">
                    <button type="submit" class="btn btn-primary me-3 waves-effect waves-light">Save changes</button>
                </div>
                </form>
            </div>
            <!-- /Account -->
        </div>
        {{-- <div class="card-body">
            <form action=" {{ route('karyawan.update',$karyawan->id) }}" method="post">
        @csrf
        @method('put')
        <div class="form-floating form-floating-outline mb-6">
            <input type="text" class="form-control" id="basic-default-fullname" placeholder="John Doe" name="nama" value="{{ old('title', $karyawan->nama) }}">
            <label for=" basic-default-fullname">Nama</label>
        </div>
        <div class="form-floating form-floating-outline mb-6">
            <input type="text" class="form-control" id="basic-default-fullname" placeholder="Jl.xxx No.x" name="alamat" value="{{ old('title', $karyawan->alamat) }}">
            <label for="basic-default-fullname">Alamat</label>
        </div>
        <div class="form-floating form-floating-outline mb-6">
            <input type="email" class="form-control" id="basic-default-fullname" placeholder="example@example.com" name="email" value="{{ old('title', $karyawan->email) }}">
            <label for="basic-default-email">Email</label>
        </div>
        <div class="form-floating form-floating-outline mb-6">
            <input type="text" class="form-control" id="basic-default-fullname" placeholder="081234567890" name="no_hp" value="{{ old('title', $karyawan->no_hp) }}">
            <label for="basic-default-fullname">No. Handphone</label>
        </div>
        <div>
            <label for="smallSelect" class="form-label">Status</label>
            <select id="smallSelect" class="form-select form-select-sm">
                <option>Small select</option>
                <option value="active">One</option>
                <option value="cuti">Two</option>
                <option value="sakit">Three</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div> --}}
</div>
@endsection
