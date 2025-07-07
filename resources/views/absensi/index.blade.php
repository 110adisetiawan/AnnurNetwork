@extends('../layout')
@section('content')
@include('components.toast-validation-errors')
@include('components.toast-validation-success')

<div class="container">
    <div class="row">
        <div class="col-12">

            <div class="card mb-6">
                <h5 class="card-header">Laporan Absensi Karyawan</h5>
                <div class="d-flex gap-2 mb-3 px-6 my-4">
                    <form action="{{ route('absensi.export.pdf') }}" method="GET" target="_blank">
                        @foreach(request()->all() as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        <input type="hidden" name="month" value="{{ request('month') }}">
                        <input type="hidden" name="year" value="{{ request('year') }}">
                        <input type="hidden" name="filter" value="{{ request('filter') }}">
                        @endforeach
                        <button type="submit" class="btn btn-xs btn-danger">
                            <i class="ri-file-pdf-2-line"></i>Export PDF
                        </button>
                    </form>

                    <form action="{{ route('absensi.export.excel') }}" method="GET" target="_blank">
                        @foreach(request()->except('filter') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        <input type="hidden" name="month" value="{{ request('month') }}">
                        <input type="hidden" name="year" value="{{ request('year') }}">
                        <input type="hidden" name="filter" value="{{ request('filter') }}">
                        @endforeach
                        <button type="submit" class="btn btn-xs btn-success">
                            <i class="ri-file-excel-2-line"></i>Export Excel
                        </button>
                    </form>

                    @php
                    $filterAktif = request('month') || request('year') || request('user_id') || request('from_date') || request('to_date');
                    @endphp
                    @if ($filterAktif)
                    <a href="{{ route('absensi.index') }}" class="btn btn-xs btn-warning">
                        <span class="tf-icons ri-search-line ri-16px me-1_5"></span> Reset Filter
                    </a>
                    @endif
                </div>
                <div class="col-xl-6 col-md-12">
                    <form method="GET" action="{{ route('absensi.index') }}" class="px-6 my-4">
                        <div class="form-floating form-floating-outline mb-2">
                            @if(Auth::user()->hasRole('Administrator'))
                            <select id="country" name="user_id" class="form-select">
                                <option value="">-- Semua Karyawan --</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                                @endforeach
                            </select>
                            <label for="country">Karyawan</label>
                            @else
                            <div class="form-floating form-floating-outline mb-2">
                                <input class="form-control" type="hidden" name="user_id" value="{{ Auth::user()->id }}" readonly>
                                <input class="form-control" type="text" name="" value="{{ Auth::user()->name }}" readonly>
                                <label for="html5-datetime-local-input">Nama Karyawan</label>
                            </div>
                            @endif
                        </div>
                </div>
                <div class="row row-bordered g-0">
                    <div class="col-lg-6 p-6">
                        <form method="GET" action="{{ route('absensi.index') }}">
                            <small class="text-light fw-medium">Filter by date</small>
                            <div class="demo-inline-spacing">
                                <div class="form-floating form-floating-outline mb-2">
                                    <input class="form-control" type="date" name="from_date" value="{{ request('from_date') }}">
                                    <label for="html5-datetime-local-input">Start Date</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-2">
                                    <input class="form-control" type="date" name="to_date" value="{{ request('to_date') }}">
                                    <label for="html5-datetime-local-input">End Date</label>
                                </div>
                            </div>
                            <div class="demo-inline-spacing">
                                <button type="submit" name="filter" value="date" class="btn rounded-pill btn-primary waves-effect waves-light">
                                    <span class="tf-icons ri-search-line ri-16px me-1_5"></span>Filter by Date
                                </button>
                            </div>
                    </div>
                    @php
                    $bulanIndo = [
                    1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                    ];
                    @endphp
                    <div class="col-lg-6 p-6">
                        <small class="text-light fw-medium">Filter by Month</small>
                        <div class="demo-inline-spacing">
                            <div class="form-floating form-floating-outline mb-2">
                                <select name="month" id="month" class="form-select">
                                    @foreach($bulanIndo as $num => $nama)
                                    <option value="{{ $num }}" {{ request('month', now()->month) == $num ? 'selected' : '' }}>
                                        {{ $nama }}
                                    </option>
                                    @endforeach
                                </select>
                                <label for="country">Bulan</label>
                            </div>
                            <div class="form-floating form-floating-outline mb-2 col-6">
                                <select name="year" id="year" class="form-select">
                                    @foreach(range(date('Y'), 2020) as $y)
                                    <option value="{{ $y }}" {{ request('year', now()->year) == $y ? 'selected' : '' }}>
                                        {{ $y }}
                                    </option>
                                    @endforeach
                                </select>
                                <label for="country">Tahun</label>
                            </div>
                        </div>
                        <div class="demo-inline-spacing">
                            <button type="submit" name="filter" value="month" class="btn rounded-pill btn-primary waves-effect">
                                <span class="tf-icons ri-search-line ri-16px me-1_5"></span>Filter by Month
                            </button>
                        </div>
                    </div>
                </div>
                </form>
                <hr class="m-0">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nama Karyawan</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($absensis as $a)
                            <tr>
                                <td>{{ $a->created_at->isoFormat('dddd, D MMMM Y') }}</td>
                                <td>{{ $a->user->name }}</td>
                                <td>{{ $a->masuk->format('H:i:s') }}</td>
                                <td>{{ $a->pulang?->format('H:i:s') }}</td>
                                <td>{{ $a->keterangan }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
