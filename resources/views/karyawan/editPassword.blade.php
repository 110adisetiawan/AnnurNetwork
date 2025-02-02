@extends('../layout')
@section('content')
<div class="col-md-6">
    <div class="card">
        <h1 class="card-header">Update Password</h1>
        @if(session('error'))
        <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
        @endif
        <div class="card-body">
            <form action=" {{ route('password.update',$karyawan->id) }}" method="post">
                @csrf
                @method('put')
                <div class="form-floating form-floating-outline mb-6">
                    <input type="password" class="form-control" id="basic-default-fullname" placeholder="" name="current_password" required>
                    <label for=" basic-default-fullname">Old Password</label>
                </div>
                @error('new_password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <input type="password" class="form-control" id="basic-default-fullname" placeholder="" name="new_password" required>
                    <label for="basic-default-fullname">New Password</label>
                </div>
                <div class="form-floating form-floating-outline mb-6">
                    <input type="password" class="form-control" id="basic-default-fullname" placeholder="" name="new_password_confirmation" required>
                    <label for="basic-default-fullname">New Password</label>
                </div>


                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
    @endsection
