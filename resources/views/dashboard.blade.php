@extends('layout')

@section('content')

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

<!-- Congratulations card -->
<div class="col-md-12 col-lg-4">
    <div class="card">
        <div class="card-body text-nowrap">
            <h5 class="card-title mb-0 flex-wrap text-nowrap">Selamat <label id="greeting"></label> {{ Auth::user()->name }}!</h5>
            <p class="mb-2">Selamat datang di sistem</p>
            <h1 class="text-primary mb-0"><label class="mb-8 mt-3" id="time"></label></h1>
            <p class="small mb-0"><span class="h6 mb-0" id="date">{{ $now }}</span></p>
        </div>
        <img src="{{ asset('assets/img/illustrations/tree.png') }}" class="position-absolute bottom-0 end-0 me-3 mb-1" style="" width="80" alt="view sales" />
    </div>
</div>

<!--/ Congratulations card -->
@if (Auth::user()->hasRole('Karyawan'))
<div class="col-md-12 col-lg-4">
    <div class="card">
        <div class="card-body text-nowrap">
            <h5 class="card-title mb-0 flex-wrap text-nowrap">Absensi Masuk</h5>
            @if (!$absensi)
            <p class="mb-2">Silahkan Absen Masuk</p>
            <form action="{{ route('absensi.store') }}" method="post">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::user()->id; }}">
                <input type="hidden" name="status" value="hadir">
                <button type="submit" class="btn btn-success mt-4 mb-4">Absen Masuk</button>
            </form>
            @else
            <p class="mb-2">Absen Masuk : <br>{{ $absensi->masuk }}</p>
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
            @if ($absensi && !optional($absensi)->pulang)
            <form action="{{ route('absensi.update', $absensi->id) }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" value="{{ Auth::user()->id; }}">
                <p class="mb-2">Pastikan pulang <br> sesuai waktu!</p>
                <button type="submit" class="btn btn-primary mt-4 mb-4">Absen Pulang</button>
            </form>
            @elseif (optional($absensi)->pulang)
            <p class="mb-2">Absen Keluar : <br>{{ optional($absensi)->pulang }}</p>
            <button class="btn btn-danger mt-4 mb-4" disabled>Sudah Absen Keluar!</button>

            @else
            <p class="mb-2">Belum absen masuk</p>
            <button class="btn btn-danger mt-4 mb-4" disabled>Belum absen masuk!</button>
            @endif

        </div>
        <img src="{{ asset('assets/img/illustrations/clock-out.png') }}" class="position-absolute bottom-0 end-0 me-3 mb-1" style="" width="150" alt="view sales" />
    </div>
</div>

<!-- Weekly Overview Chart -->
<div class="col-xl-12 col-md-6">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h5 class="mb-1">Tiket</h5>
            </div>
        </div>
        <div class="card-body pt-lg-2">
            <table class="table table-hover" @if($tickets->isEmpty()) "" @else id="myTable" @endif>
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
                    @if($tickets->isEmpty())
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada tiket</td>
                    </tr>
                    @endif
                    @foreach ($tickets as $ticket)
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

<!-- Transactions -->
<div class="col-lg-8">
    <div class="card h-100">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0 me-2">Data Master</h5>
            </div>
            <p class="small mb-0"><span class="h6 mb-0">Total 48.5% Growth</span> 😎 this month</p>
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
                            <h5 class="mb-0">{{ $karyawan }}</h5>
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
<div class="col-xl-12 col-md-6">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h5 class="mb-1">Tiket Onprogres</h5>
            </div>
        </div>
        <div class="card-body pt-lg-2">
            <table class="table table-hover" @if($tickets->where('status', 'onprogress')->isEmpty()) @else id="myTable" @endif>
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
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->customer_name }}</td>
                        <td>{{ $ticket->karyawan->nama }}</td>
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
                        <td>{{ $ticket->start_date }}</td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
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
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm me-4">
                                    <img src="../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />
                                </div>
                                <div>
                                    <h6 class="mb-0 text-truncate">Jordan Stevenson</h6>
                                    <small class="text-truncate">@amiccoo</small>
                                </div>
                            </div>
                        </td>
                        <td class="text-truncate">susanna.Lind57@gmail.com</td>
                        <td class="text-truncate">
                            <div class="d-flex align-items-center">
                                <i class="ri-vip-crown-line ri-22px text-primary me-2"></i>
                                <span>Admin</span>
                            </div>
                        </td>
                        <td><span class="badge bg-label-warning rounded-pill">Pending</span></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm me-4">
                                    <img src="../assets/img/avatars/3.png" alt="Avatar" class="rounded-circle" />
                                </div>
                                <div>
                                    <h6 class="mb-0 text-truncate">Benedetto Rossiter</h6>
                                    <small class="text-truncate">@brossiter15</small>
                                </div>
                            </div>
                        </td>
                        <td class="text-truncate">estelle.Bailey10@gmail.com</td>
                        <td class="text-truncate">
                            <div class="d-flex align-items-center">
                                <i class="ri-edit-box-line text-warning ri-22px me-2"></i>
                                <span>Editor</span>
                            </div>
                        </td>
                        <td><span class="badge bg-label-success rounded-pill">Active</span></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm me-4">
                                    <img src="../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle" />
                                </div>
                                <div>
                                    <h6 class="mb-0 text-truncate">Bentlee Emblin</h6>
                                    <small class="text-truncate">@bemblinf</small>
                                </div>
                            </div>
                        </td>
                        <td class="text-truncate">milo86@hotmail.com</td>
                        <td class="text-truncate">
                            <div class="d-flex align-items-center">
                                <i class="ri-computer-line text-danger ri-22px me-2"></i>
                                <span>Author</span>
                            </div>
                        </td>
                        <td><span class="badge bg-label-success rounded-pill">Active</span></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm me-4">
                                    <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
                                </div>
                                <div>
                                    <h6 class="mb-0 text-truncate">Bertha Biner</h6>
                                    <small class="text-truncate">@bbinerh</small>
                                </div>
                            </div>
                        </td>
                        <td class="text-truncate">lonnie35@hotmail.com</td>
                        <td class="text-truncate">
                            <div class="d-flex align-items-center">
                                <i class="ri-edit-box-line text-warning ri-22px me-2"></i>
                                <span>Editor</span>
                            </div>
                        </td>
                        <td><span class="badge bg-label-warning rounded-pill">Pending</span></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm me-4">
                                    <img src="../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle" />
                                </div>
                                <div>
                                    <h6 class="mb-0 text-truncate">Beverlie Krabbe</h6>
                                    <small class="text-truncate">@bkrabbe1d</small>
                                </div>
                            </div>
                        </td>
                        <td class="text-truncate">ahmad_Collins@yahoo.com</td>
                        <td class="text-truncate">
                            <div class="d-flex align-items-center">
                                <i class="ri-pie-chart-2-line ri-22px text-info me-2"></i>
                                <span>Maintainer</span>
                            </div>
                        </td>
                        <td><span class="badge bg-label-success rounded-pill">Active</span></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm me-4">
                                    <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
                                </div>
                                <div>
                                    <h6 class="mb-0 text-truncate">Bradan Rosebotham</h6>
                                    <small class="text-truncate">@brosebothamz</small>
                                </div>
                            </div>
                        </td>
                        <td class="text-truncate">tillman.Gleason68@hotmail.com</td>
                        <td class="text-truncate">
                            <div class="d-flex align-items-center">
                                <i class="ri-edit-box-line text-warning ri-22px me-2"></i>
                                <span>Editor</span>
                            </div>
                        </td>
                        <td><span class="badge bg-label-warning rounded-pill">Pending</span></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm me-4">
                                    <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                                </div>
                                <div>
                                    <h6 class="mb-0 text-truncate">Bree Kilday</h6>
                                    <small class="text-truncate">@bkildayr</small>
                                </div>
                            </div>
                        </td>
                        <td class="text-truncate">otho21@gmail.com</td>
                        <td class="text-truncate">
                            <div class="d-flex align-items-center">
                                <i class="ri-user-3-line ri-22px text-success me-2"></i>
                                <span>Subscriber</span>
                            </div>
                        </td>
                        <td><span class="badge bg-label-success rounded-pill">Active</span></td>
                    </tr>
                    <tr class="border-transparent">
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm me-4">
                                    <img src="../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />
                                </div>
                                <div>
                                    <h6 class="mb-0 text-truncate">Breena Gallemore</h6>
                                    <small class="text-truncate">@bgallemore6</small>
                                </div>
                            </div>
                        </td>
                        <td class="text-truncate">florencio.Little@hotmail.com</td>
                        <td class="text-truncate">
                            <div class="d-flex align-items-center">
                                <i class="ri-user-3-line ri-22px text-success me-2"></i>
                                <span>Subscriber</span>
                            </div>
                        </td>
                        <td><span class="badge bg-label-secondary rounded-pill">Inactive</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--/ Data Tables -->
@endif
@push('scripts')

<script>
    var myDate = new Date();
    var hrs = myDate.getHours();
    var mins = myDate.getMinutes();
    var greet;

    if (hrs >= 5 && ((hrs == 5 && mins >= 30) || (hrs > 5 && hrs < 12)))
        greet = 'Pagi';
    else if (hrs >= 12 && hrs < 18)
        greet = 'Sore';
    else if ((hrs >= 18 && hrs < 24) || hrs > 0)
        greet = 'Malam';
    else
        greet = 'Error';

    document.getElementById('greeting').innerHTML =
        '<b>' + greet;

</script>

@endpush
@endsection
