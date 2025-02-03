@extends('../layout')
@section('content')
<div class="col-md-6">
    <div class="card">
        <h1 class="card-header">Tambah Ticket</h1>
        <div class="card-body">
            <form action=" {{ route('ticket.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @error('karyawan_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <select id="country" class="select2 form-select" name="karyawan_id">
                        <option value="">Pilih Karyawan</option>
                        @foreach ($karyawans as $karyawan)
                        <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                        @endforeach
                    </select>
                    <label for="country">Nama Karyawan</label>
                </div>
                @error('task_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <select id="country" class="select2 form-select" name="task_id">
                        <option value="">Pilih Pekerjaan</option>
                        @foreach ($tasks as $task)
                        <option value="{{ $task->id }}">{{ $task->nama_tugas }}</option>
                        @endforeach
                    </select>
                    <label for="country">Pilih Pekerjaan</label>
                </div>
                @error('priority_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <select id="country" class="select2 form-select" name="priority_id">
                        <option value="">Pilih Prioritas</option>
                        @foreach ($priorities as $priority)
                        <option value="{{ $priority->id }}">{{ $priority->nama_prioritas }}</option>
                        @endforeach
                    </select>
                    <label for="country">Prioritas</label>
                </div>
                @error('sla_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <select id="country" class="select2 form-select" name="sla_id">
                        <option value="">Pilih SLA</option>
                        @foreach ($sla as $sla)
                        <option value="{{ $sla->id }}">{{ $sla->nama_sla }}</option>
                        @endforeach
                    </select>
                    <label for="country">SLA</label>
                </div>
                @error('customer_name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <input type="text" class="form-control" id="basic-default-fullname" placeholder="Pak RT" name="customer_name" value="{{ old('customer_name') }}">
                    <label for="basic-default-fullname">Nama Customer</label>
                </div>
                @error('customer_address')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <input type="text" class="form-control" id="basic-default-fullname" placeholder="Jl.xx xx" name="customer_address" value="{{ old('customer_address') }}">
                    <label for="basic-default-fullname">Alamat Customer</label>
                </div>
                @error('image_address')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="mb-6">
                    <label for="formFile" class="form-label">Upload Foto Lokasi</label>
                    <input class="form-control" type="file" id="formFile" name="image_address">
                </div>
                @error('latitude_ticket')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <input type="text" class="form-control" id="basic-default-fullname" placeholder="" name="latitude_ticket" value="{{ old('latitude_ticket') }}">
                    <label for="basic-default-fullname">Latitude Customer</label>
                </div>
                @error('longitude_ticket')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating form-floating-outline mb-6">
                    <input type="text" class="form-control" id="basic-default-fullname" placeholder="" name="longitude_ticket" value="{{ old('longitude_ticket') }}">
                    <label for="basic-default-fullname">Longitude Customer</label>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="card">
        <h1 class="card-header">Tambah Tugas</h1>
        <div class="card-body">

        </div>
    </div>
</div>
@endsection
