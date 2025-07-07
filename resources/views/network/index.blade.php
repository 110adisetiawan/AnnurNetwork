@extends('../layout')

@section('content')
<div class="container">
    <h1>Data OLT</h1>
    @can('data-master')
    <a href="{{ route('network.create') }}" class="btn btn-primary mb-5">Tambah Device</a>
    @endcan
    @if(session('success'))
    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width=10%>No</th>
                        <th>Nama Device</th>
                        <th>Serial Number</th>
                        <th>IP Address</th>
                        <th>Status</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        @can('data-master')
                        <th width=20%>Aksi</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>

                    @if($networks->count() == 0)
                    <tr>
                        <td colspan="8" class="text-center">Data tidak ditemukan</td>
                    </tr>
                    @endif
                    @foreach ($networks as $k)
                    <tr id="device-{{ $k->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $k->nama_device }}</td>
                        <td>{{ $k->serial_number }}</td>
                        <td>{{ $k->ip_address }}</td>
                        <td> <span class="status">Checking...</span></td>
                        {{-- <td>@if($k->status == 'active')
                            <span class="badge rounded-pill bg-label-success me-1">Active</span>
                            @elseif($k->status == 'offline')
                            <span class="badge rounded-pill bg-label-danger me-1">{{ $k->status }}</span>
                        @elseif($k->status == 'rusak')
                        <span class="badge rounded-pill bg-label-dark me-1">{{ $k->status }}</span>
                        </td> --}}
                        {{-- @endif  --}}
                        <td>{{ $k->latitude }}</td>
                        <td>{{ $k->longitude }}</td>
                        @can('data-master')
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ri-more-2-line"></i>
                                </button>
                                <div class="dropdown-menu" style="">
                                    <a href="{{ route('network.edit', $k->id) }}" class="dropdown-item waves-effect"><i class="ri-pencil-line text-primary me-1"></i> Edit</a>
                                    @can('data-delete')
                                    <form id="delete-form-{{ $k->id }}" action="{{ route('network.destroy', $k->id) }}" method="post" style="display: inline">
                                        @csrf
                                        @method('delete')
                                        <button type="button" onclick="hapusData({{ $k->id }})" class="dropdown-item waves-effect"><i class="ri-delete-bin-6-line text-danger me-1"></i> Delete</button>
                                        <script>
                                            function hapusData(id) {
                                                Swal.fire({
                                                    title: 'Yakin ingin menghapus?'
                                                    , text: 'Data akan hilang permanen.'
                                                    , icon: 'warning'
                                                    , showCancelButton: true
                                                    , confirmButtonColor: '#d33'
                                                    , cancelButtonColor: '#3085d6'
                                                    , confirmButtonText: 'Ya, hapus!'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        document.getElementById('delete-form-' + id).submit();
                                                    }
                                                });
                                            }

                                        </script>
                                    </form>

                                    @endcan
                                </div>
                            </div>
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const devices = @json($networks->map(fn($d) => [
            'id' => $d->id,
            'nama_device' => $d->nama_device,
            'ip_address' => $d->ip_address
        ])->values()->all());

        devices.forEach(device => {
            fetch(`/networks/${device.id}/ping`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(res => res.json())
            .then(data => {
                const row = document.getElementById(`device-${device.id}`);
                if (row) {
                    const statusCell = row.querySelector('.status');
                    if (statusCell) {
                        statusCell.textContent = data.status.charAt(0).toUpperCase() + data.status.slice(1);
                        statusCell.className = 'badge rounded-pill ' + (data.status === 'online' ? 'bg-label-success' : 'bg-label-danger');
                    }
                }
            });
        });
    });
</script>

@endsection
