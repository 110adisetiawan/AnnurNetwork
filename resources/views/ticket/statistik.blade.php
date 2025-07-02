@extends('layout')
@section('content')

<div class="col-md-12">
    <div class="card">
        <h3 class="card-header">Filter</h3>
        <div class="card-body">
            <form method="GET" class="row mb-1 g-2 px-5">
                <div class="col-md-3">
                    <label>Start Date</label>
                    <input type="date" name="from_date" value="{{ $request->from_date }}" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>End Date</label>
                    <input type="date" name="to_date" value="{{ $request->to_date }}" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>SLA</label>
                    <select name="sla_id" class="form-select">
                        <option value="">-- Semua SLA --</option>
                            @foreach($slas as $sla)
                            <option value="{{ $sla->id }}" {{ $request->sla_id == $sla->id ? 'selected' : '' }}>
                                {{ $sla->nama_sla }}
                            </option>
                            @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Teknisi</label>
                    <select name="user_id" class="form-select">
                        <option value="">-- Semua Teknisi --</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $request->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 mt-3">
                <button class="btn btn-primary">🔍 Filter</button>
                    <a href="{{ route('ticket.statistik') }}" class="btn btn-warning">⟳ Reset</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-md-12">
  <div class="card">
    <h3 class="card-header">Statistik SLA Tiket</h3>
    <div class="card-body">
      <div class="row text-center">
    <div class="col-md-3 col-6 mb-3">
        <div class="border rounded p-3 bg-light h-100">
            <h6 class="mb-1">Total Tiket Open</h6>
            <strong class="fs-5 text-warning">{{ $totalOpen }}</strong>
        </div>
    </div>
    <div class="col-md-3 col-6 mb-3">
        <div class="border rounded p-3 bg-light h-100">
            <h6 class="mb-1">Total Tiket Closed</h6>
            <strong class="fs-5 text-dark">{{ $total }}</strong>
        </div>
    </div>
    <div class="col-md-3 col-6 mb-3">
        <div class="border rounded p-3 bg-light h-100">
            <h6 class="mb-1 text-success">✅ SLA Sesuai</h6>
            <strong class="fs-5 text-success">{{ $sla_ok }} ({{ $persen_ok }}%)</strong>
        </div>
    </div>
    <div class="col-md-3 col-6 mb-3">
        <div class="border rounded p-3 bg-light h-100">
            <h6 class="mb-1 text-danger">❌ SLA Terlewat</h6>
            <strong class="fs-5 text-danger">{{ $sla_miss }} ({{ $persen_miss }}%)</strong>
        </div>
    </div>
</div>
      <div class="row">
        <div class="col-md-6">
          <h5 class="text-center">Performa SLA</h5>
          <div id="donut-chart"></div>
        </div>
        <div class="col-md-6">
          <h5 class="text-center">Distribusi SLA Tiket</h5>
          <div id="bar-chart"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
var donut = new ApexCharts(document.querySelector("#donut-chart"), {
    chart: {
        type: 'donut',
        height: 300
    },
    series: [{{ $sla_ok }}, {{ $sla_miss }}],
    labels: ['✅ Meet SLA', '⏱️ Over SLA'],
    colors: ['#28c76f', '#ea5455'], // hijau & merah
    legend: {
        position: 'bottom'
    },
    dataLabels: {
        enabled: true,
        formatter: function (val) {
            return val.toFixed(1) + "%";
        }
    },
    tooltip: {
        y: {
            formatter: function (val) {
                return val + " Tiket";
            }
        }
    },
    responsive: [{
        breakpoint: 480,
        options: {
            chart: { width: 250 },
            legend: { position: 'bottom' }
        }
    }]
});
donut.render();

var bar = new ApexCharts(document.querySelector("#bar-chart"), {
    chart: {
        type: 'bar',
        height: 320
    },
    series: [{
        name: 'Jumlah Tiket',
        data: [
            @foreach ($slas as $sla)
                {{ $sla->tickets()->count() }},
            @endforeach
        ]
    }],
    xaxis: {
        categories: [
            @foreach ($slas as $sla)
                '{{ $sla->nama_sla }}',
            @endforeach
        ],
        labels: { style: { fontSize: '13px' } }
    },
    plotOptions: {
        bar: {
            borderRadius: 4,
            columnWidth: '45%',
            distributed: true
        }
    },
    colors: ['#00cfe8', '#7367f0', '#ea5455', '#ff9f43', '#28c76f'],
    dataLabels: { enabled: true },
    tooltip: {
        y: {
            formatter: function (val) {
                return val + " Tiket";
            }
        }
    }
});
bar.render();
</script>

@endsection
