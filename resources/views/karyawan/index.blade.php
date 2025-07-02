@extends('../layout')

@section('content')
<div class="container">
    <h1>Data Karyawan</h1>
    <a href="{{ route('karyawan.create') }}" class="btn btn-primary mb-5">Tambah Karyawan</a>
    @if(session('success'))
    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No. Telepon</th>
                        <th>Telegram ID</th>
                        <th>Role</th>
                        <th>Foto</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($karyawans->count() == 0)
                    <tr>
                        <td colspan="9" class="text-center">Data tidak ditemukan</td>
                    </tr>
                    @endif
                    @foreach ($karyawans as $k)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $k->name }}</td>
                        <td>{{ $k->alamat }}</td>
                        <td>{{ $k->no_hp }}</td>
                        <td>{{ $k->telegram_id }}</td>
                        <td>
                            @foreach ($k->getRoleNames() as $role)
                            <button class="btn btn-success">{{ $role }}</button>
                            @endforeach
                        </td>
                        <td>@if (is_null($k->foto))
                            <img src="{{ asset('assets/img/karyawan/null.png') }}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar">
                            @else
                            <img class="d-block w-px-100 h-px-100 rounded" src="{{ url('/') }}/assets/img/karyawan/{{ $k->foto }}" alt=" {{ $k->nama }}">
                            @endif
                        </td>
                        <td>@if($k->status == 'aktif')
                            <span class="badge rounded-pill bg-label-success me-1">Active</span>
                            @elseif($k->status == 'cuti' || $k->status == 'sakit')
                            <span class="badge rounded-pill bg-label-warning me-1">{{ $k->status }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ri-more-2-line"></i>
                                </button>
                                <div class="dropdown-menu" style="">
                                    <a href="{{ route('karyawan.edit', $k->id) }}" class="dropdown-item waves-effect"><i class="ri-pencil-line text-warning me-1"></i> Edit</a>
                                    <a href="{{ route('password.edit', $k->id) }}" class="dropdown-item waves-effect"><i class="ri-lock-line text-primary me-1"></i> Update Password</a>
                                    <form action="{{ route('karyawan.destroy', $k->id) }}" method="post" style="display: inline">
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
</div>
@endsection
