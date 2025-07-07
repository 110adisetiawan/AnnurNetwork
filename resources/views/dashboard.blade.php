@extends('layout')

@section('content')
@php
            $absenHariIni = Auth::user()->absensis()->whereDate('masuk', now()->toDateString())->first();
            $absenKemarin = Auth::user()->absensis()->whereDate('masuk', now()->subDay()->toDateString())->first();
            $lupaPulang = $absenKemarin && is_null($absenKemarin->pulang);
            @endphp
@push('waktuOnload')
<script type="text/javascript">
    window.setTimeout("waktu()", 1000);

    function waktu() {
        var currentTime = new Date();
        setTimeout("waktu()", 1000);
        var time = currentTime.toLocaleTimeString();
        document.getElementById('time').innerHTML = time;
    }

</script>
@endpush
@include('components.toast-validation-errors')
@include('components.toast-validation-success')
@if(Auth::user()->hasRole('Karyawan'))
@if(Auth::user()->telegram_id == null)
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'info'
            , title: 'Lengkapi Profil'
            , html: 'Kamu belum menambahkan Telegram ID.<br>Silahkan update data kamu'
            , showCancelButton: false
            , confirmButtonText: 'Update Data'
            , allowOutsideClick: false

        , }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ url('karyawan/' . auth()->id() . '/edit') }}";
            }
        });
    });
    </script>

    @elseif (!Auth::user()->absensis()->whereDate('masuk', now()->toDateString())->exists())
    <script>
    Swal.fire({
        icon: 'warning',
        title: 'Belum Absen Hari Ini',
        text: 'Silakan lakukan absen terlebih dahulu.',
        confirmButtonText: 'tutup',
        allowOutsideClick: true
    }).then((result) => {
        if (result.isConfirmed) {
            // ganti dengan route absen kamu
        }
    });
</script>
@endif
@if ($lupaPulang)
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'warning',
            title: 'Lupa Absen Pulang?',
            html: 'Kamu belum melakukan absen pulang kemarin.<br>Silakan hubungi admin dan jangan diulang lagi!',
            confirmButtonText: 'Isi Sekarang',
            allowOutsideClick: true
        }).then((result) => {
            if (result.isConfirmed) {
            }
        });
    });
    </script>
    @endif
    @endif
<!-- User Dashboard -->
@if (Auth::user()->hasRole('Karyawan'))
<div class="col-md-12 col-lg-4">
    <div class="card">
        <div class="card-body text-nowrap">
            <h5 class="card-title mb-0 flex-wrap text-nowrap"><span id="greeting"></span> {{ Auth::user()->name }}!</h5>
            <p class="mb-2">Selamat datang di sistem</p>
            <h1 class="text-primary mb-0"><label class="mb-8 mt-3" id="time"></label></h1>
            <p class="small mb-0"><span class="h6 mb-0" id="date">{{ $now }}</span></p>
        </div>
        <img src="{{ asset('assets/img/illustrations/tree.png') }}" class="position-absolute bottom-0 end-0 me-3 mb-1" style="" width="80" alt="view sales" />
    </div>
</div>

<!--/ Absensi card -->

<div class="col-md-12 col-lg-4">
    <div class="card">
        <div class="card-body text-nowrap">
            <h5 class="card-title mb-0 flex-wrap text-nowrap">Absensi Masuk</h5>


            @if (!$absenHariIni)
            <p class="mb-2">Silahkan Absen Masuk</p>
            <form action="{{ route('absensi.store') }}" method="post">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::user()->id; }}">
                <input type="hidden" name="status" value="hadir">
                <button type="submit" class="btn btn-success mt-4 mb-4">Absen Masuk</button>
            </form>
            @else
            <p class="mb-2">Absen Masuk : <br>{{ $absenHariIni->masuk }}</p>
            <button class="btn btn-success mt-4 mb-4" disabled>Sudah absen masuk!</button>
            @endif
        </div>
        <img src="{{ asset('assets/img/illustrations/clock-in.png') }}" class="position-absolute bottom-0 end-0 me-3 mb-1" style="" width="150" alt="view sales" />
    </div>
</div>

<div class="col-md-12 col-lg-4">
    <div class="card">
        <div class="card-body text-nowrap">
            <h5 class="card-title mb-0 flex-wrap text-nowrap">Absensi Pulang</h5>
            @if ($absenHariIni && !optional($absenHariIni)->pulang)
            <form action="{{ route('absensi.update', $absenHariIni->id) }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" value="{{ Auth::user()->id; }}">
                <p class="mb-2">Pastikan pulang <br> sesuai jam kerja!</p>
                <button type="submit" class="btn btn-primary mt-4 mb-4">Absen Pulang</button>
            </form>
            @elseif (optional($absenHariIni)->pulang)
            <p class="mb-2">Absen Keluar : <br>{{ optional($absenHariIni)->pulang }}</p>
            <button class="btn btn-danger mt-4 mb-4" disabled>Sudah Absen Keluar!</button>

            @else
            <p class="mb-2">Belum absen masuk</p>
            <button class="btn btn-danger mt-4 mb-4" disabled>Belum absen masuk!</button>
            @endif

        </div>
        <img src="{{ asset('assets/img/illustrations/clock-out.png') }}" class="position-absolute bottom-0 end-0 me-3 mb-1" style="" width="150" alt="view sales" />
    </div>
</div>

<!-- Tiket Karyawan -->
<div class="col-xl-12 col-md-6">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h5 class="mb-1">Tiket</h5>
            </div>
        </div>
        <div class="card-body pt-lg-2">
            <div class="table-responsive">
                <table class="table table-hover" @if($tickets->where('status', 'onprogress')->isEmpty()) "" @else id="myTable" @endif>
            </div>
            <thead>
                <tr>
                    <th width=10px>No</th>
                    <th>Ticket ID</th>
                    <th>Customer</th>
                    <th>Teknisi</th>
                    <th>Urgensi</th>
                    <th>Status</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if($tickets->where('status', 'onprogress')->isEmpty())
                <tr>
                    <td colspan="8" class="text-center">Belum ada tiket untukmu</td>
                </tr>
                @endif
                @foreach ($tickets->where('user_id', Auth::user()->id)->where('status', 'onprogress') as $ticket)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->customer_name }}</td>
                    <td>{{ $ticket->user->name }}</td>
                    <td>{{ $ticket->priority->nama_prioritas }}</td>
                    <td>
                        @if($ticket->status == 'open')
                        <span class="badge rounded-pill bg-label-success me-1">OPEN</span>
                        @elseif($ticket->status == 'onprogress')
                        <span class="badge rounded-pill bg-label-warning me-1">ON PROGRESS</span>
                        @else
                        <span class="badge rounded-pill bg-label-dark me-1">CLOSED</span>
                        @endif
                    </td>
                    <td>{{ $ticket->created_at }}</td>
                    <td>
                        <a href="{{ url('/ticket/' . $ticket->id) }}" class="btn btn-warning">Lihat Tiket</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>
@else

<!-- Administrator card -->
<div class="col-md-12 col-lg-4">
    <div class="card">
        <div class="card-body text-nowrap">
            <h5 class="card-title mb-0 flex-wrap text-nowrap"><span id="greeting"></span> {{ Auth::user()->name }}!</h5>
            <p class="mb-2">Selamat datang di sistem</p>
            <h1 class="text-primary mb-0"><label class="mb-8 mt-3" id="time"></label></h1>
            <p class="small mb-0"><span class="h6 mb-0" id="date">{{ $now }}</span></p>
        </div>
        <img src="{{ asset('assets/img/illustrations/tree.png') }}" class="position-absolute bottom-0 end-0 me-3 mb-1" style="" width="80" alt="view sales" />
    </div>
</div>
<!-- Transactions -->
<div class="col-lg-8">
    <div class="card h-100">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0 me-2">Data Master</h5>
            </div>
            <p class="small mb-0"><span class="h6 mb-0"></p>
        </div>
        <div class="card-body pt-lg-10">
            <div class="row g-6">
                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="avatar">
                            <div class="avatar-initial bg-primary rounded shadow-xs">
                                <i class="ri-pie-chart-2-line ri-24px"></i>
                            </div>
                        </div>
                        <div class="ms-3">
                            <p class="mb-0">Karyawan</p>
                            <h5 class="mb-0">{{ $users_count }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="avatar">
                            <div class="avatar-initial bg-success rounded shadow-xs">
                                <i class="ri-group-line ri-24px"></i>
                            </div>
                        </div>
                        <div class="ms-3">
                            <p class="mb-0">Barang</p>
                            <h5 class="mb-0">{{ $barang }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="avatar">
                            <div class="avatar-initial bg-warning rounded shadow-xs">
                                <i class="ri-macbook-line ri-24px"></i>
                            </div>
                        </div>
                        <div class="ms-3">
                            <p class="mb-0">OLT</p>
                            <h5 class="mb-0">{{ $olt }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="avatar">
                            <div class="avatar-initial bg-info rounded shadow-xs">
                                <i class="ri-money-dollar-circle-line ri-24px"></i>
                            </div>
                        </div>
                        <div class="ms-3">
                            <p class="mb-0">Ticket</p>
                            <h5 class="mb-0">{{ $ticket }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Transactions -->


<!-- Weekly Overview Chart -->
<div class="col-xl-12 col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h5 class="mb-1">Tiket On Progress</h5>
            </div>
        </div>
        <div class="card-body pt-lg-2">
            <div class="table-responsive">
                @php
                $hasOnProgress = $tickets->where('status', 'onprogress')->isNotEmpty();
                @endphp
                <table class="table table-hover" {{ $hasOnProgress ? 'id=myTable' : '' }}>
                    <thead>
                        <tr>
                            <th width=10px>No</th>
                            <th>Ticket ID</th>
                            <th>Customer</th>
                            <th>Teknisi</th>
                            <th>Urgensi</th>
                            <th>Status</th>
                            <th>Tanggal Dibuat</th>
                            <th>Onprogress</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($tickets->where('status', 'onprogress')->isEmpty())
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada tiket onprogress</td>
                        </tr>
                        @endif
                        @foreach ($tickets as $ticket)
                        @if($ticket->status == 'onprogress')
                        @php
                        $slaTime = $ticket->sla?->time ?? 0;
                        $start = \Carbon\Carbon::parse($ticket->start_date);
                        $now = \Carbon\Carbon::now();

                        $deadline = $start->copy()->addHours((int)$slaTime);
                        $selisih = $now->diffAsCarbonInterval($deadline);
                        $lewatSla = $now->greaterThan($deadline);
                        @endphp
                        <tr class="{{ $lewatSla ? 'table-danger' : '' }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $ticket->custom_id }}</td>
                            <td>{{ $ticket->customer_name }}</td>
                            <td>{{ $ticket->user->name }}</td>
                            <td>{{ $ticket->priority->nama_prioritas }}</td>
                            <td>
                                <span class="badge rounded-pill bg-label-warning me-1">
                                    ON PROGRESS
                                </span>
                                @if ($lewatSla)
                                <span class="badge rounded-pill bg-label-danger me-1">OVER SLA : {{ $selisih }}</span>
                                @endif
                            </td>
                            <td>{{ $ticket->created_at }}</td>
                            <td>{{ $ticket->start_date }}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--/ Weekly Overview Chart -->

<!-- Data Tables -->
<div class="col-12">
    <div class="card overflow-hidden">
        <div class="table-responsive">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th class="text-truncate">User</th>
                        <th class="text-truncate">Email</th>
                        <th class="text-truncate">Role</th>
                        <th class="text-truncate">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm me-4">
                                    @if(is_null($user->foto))
                                    <img src="{{ asset('assets/img/karyawan/null.png') }}" alt="Avatar" class="rounded-circle" />
                                    @else
                                    <img src="{{ url('/') }}/assets/img/karyawan/{{ $user->foto }}" alt="Avatar" class="rounded-circle" />
                                    @endif
                                </div>
                                <div>
                                    <h6 class="mb-0 text-truncate">{{ $user->name }}</h6>
                                </div>
                            </div>
                        </td>
                        <td class="text-truncate">{{ $user->email }}</td>
                        <td class="text-truncate">
                            <div class="d-flex align-items-center">
                                @foreach ($user->getRoleNames() as $role)
                                @php
                                if($role == 'Administrator') {
                                $badgeClass = 'bg-label-primary';
                                $badgeType = 'ri-vip-crown-line';
                                $textColor = 'primary';
                                } elseif($role == 'Karyawan') {
                                $badgeClass = 'bg-label-success';
                                $badgeType = 'ri-user-3-line';
                                $textColor = 'success';
                                }
                                @endphp
                                <i class="{{ $badgeType }} ri-22px text-{{ $textColor }} me-2"></i>
                                <span>{{ $role }}</span>
                                @endforeach
                            </div>
                        </td>
                        <td><span class="badge {{ $badgeClass }} rounded-pill">{{ $user->status }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--/ Data Tables -->
@endif
@push('scripts')

<script>
    const el = document.getElementById('greeting');

    const now = new Date();
    const hrs = now.getHours();
    const mins = now.getMinutes();

    let greet = '';
    let emoji = '';
    let english = '';

    if ((hrs == 5 && mins >= 30) || (hrs > 5 && hrs < 12)) {
        greet = 'Selamat Pagi';
        english = 'Good Morning';
        emoji = '🌅';
    } else if (hrs >= 12 && hrs < 18) {
        greet = 'Selamat Sore';
        english = 'Good Afternoon';
        emoji = '🌇';
    } else {
        greet = 'Selamat Malam';
        english = 'Good Evening';
        emoji = '🌙';
    }

    el.innerHTML = `<b>${emoji} ${greet}</b>`;

</script>

@endpush
@endsection
