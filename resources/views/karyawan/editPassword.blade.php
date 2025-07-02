@extends('../layout')
@section('content')
@include('components.toast-validation-errors')
@include('components.toast-validation-success')
<div class="col-md-12">
    <div class="nav-align-top">
        <ul class="nav nav-pills flex-column flex-md-row mb-6 gap-2 gap-lg-0">
            <li class="nav-item">
                <a class="nav-link waves-effect waves-light" href="{{ route('karyawan.edit', $karyawan->id) }}"><i class="ri-group-line me-1_5"></i>Account</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active waves-effect waves-light" href="#"><i class="ri-lock-line me-1_5"></i>Ubah Password</a>
            </li>
        </ul>
    </div>
    @if(Auth::user()->hasRole('Administrator'))
    {{-- Admin  --}}
    <div class="card">
        <h1 class="card-header">Update Password</h1>
        <div class="card-body">
            <div class="row">
                <form action=" {{ route('password.update',$karyawan->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="password" class="form-control" id="basic-default-fullname" placeholder="" name="new_password" required>
                            <label for="basic-default-fullname">New Password</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="password" class="form-control" id="basic-default-fullname" placeholder="" name="new_password_confirmation" required>
                            <label for="basic-default-fullname">New Password</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
    {{-- User  --}}
    @else
    <div class="card">
        <h1 class="card-header">Update Password</h1>
        <div class="card-body">
            <div class="row">
                <form action=" {{ route('password.update',$karyawan->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="password" class="form-control" id="basic-default-fullname" placeholder="" name="current_password" required>
                            <label for=" basic-default-fullname">Old Password</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="password" class="form-control" id="basic-default-fullname" placeholder="" name="new_password" required>
                            <label for="basic-default-fullname">New Password</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="password" class="form-control" id="basic-default-fullname" placeholder="" name="new_password_confirmation" required>
                            <label for="basic-default-fullname">New Password</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection
