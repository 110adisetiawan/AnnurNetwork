@extends('../layout')
@section('content')
@include('components.toast-validation-errors')
@include('components.toast-validation-success')
<div class="col-md-6">
    <div class="card">
        <h1 class="card-header">Setting APP</h1>
        <div class="card-body">
            <form action=" {{ route('app_setting.update', $app_settings[0]->id) }}" method="post" enctype="multipart/form-data">
                <div class="d-flex align-items-start align-items-sm-center gap-6">
                    @csrf
                    @method('put')
                    @if (is_null($app_settings[0]->app_logo))
                    <img src="{{ asset('assets/img/karyawan/null.png') }}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar">
                    @else
                    <img src="{{ url('/') }}/assets/img/app_setting/{{ $app_settings[0]->app_logo }}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar">
                    @endif
                    <div class="button-wrapper">
                        <label for="upload" class="btn btn-sm btn-primary me-3 mb-4 waves-effect waves-light" tabindex="0">
                            <span class="d-none d-sm-block">Upload new Logo</span>
                            <i class="ri-upload-2-line d-block d-sm-none"></i>
                            <input name="foto" type="file" id="upload" class="account-file-input" hidden="">
                        </label>
                        <div id="file-name">Allowed JPG, GIF or PNG. Max size of 800K</div>
                    </div>
                </div>

                <div class="form-floating form-floating-outline my-6">
                    <input type="text" class="form-control" id="basic-default-fullname" placeholder="Masukkan nama SLA" name="app_name" value="{{ $app_settings[0]->app_name }}">
                    <label for="basic-default-fullname">Nama App</label>
                </div>


                <div class="form-floating form-floating-outline mb-6">
                    <select id="country" class="select2 form-select" name="telegram_alert">
                        <option value="">Pilih Status</option>
                        <option value="active" {{ $app_settings[0]->telegram_alert == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="nonactive" {{ $app_settings[0]->telegram_alert == 'nonactive' ? 'selected' : '' }}>Non Active</option>
                    </select>
                    <label for="country">Telegram Alert</label>
                </div>
                <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('upload');
        const label = document.getElementById('file-name');

        input.addEventListener('change', function() {
            if (input.files.length > 0) {
                label.textContent = "Dipilih: " + input.files[0].name;
            } else {
                label.textContent = "";
            }
        });
    });

</script>
@endsection
