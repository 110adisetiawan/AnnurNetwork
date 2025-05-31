@extends('../layout')

@section('content')
<div class="container">
    <h1>TIKET</h1>
    @can('ticket-create')
    <a href="{{ route('ticket.create') }}" class="btn btn-primary mb-5">Tambah Ticket</a>
    @endcan
    @if(session('success'))
    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif
    <div class="card">
        <div class="card-body pt-lg-2">
            <table class="table table-hover nowrap" @if($tickets->count() != 0) id="myTable" @endif>
                <thead>
                    <tr>
                        <th width=10px>No</th>
                        <th>Ticket ID</th>
                        <th>Customer</th>
                        <th>Teknisi</th>
                        <th>Urgensi</th>
                        <th>Status</th>
                        <th>Tanggal Dibuat</th>
                        <th width=90px>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @if($tickets->count() == 0)
                    <tr>
                        <td colspan="8" class="text-center">Data tidak ditemukan</td>
                    </tr>
                    @endif
                    @foreach ($tickets as $ticket)
                    <tr @php if($ticket->status == 'closed'){
                        $date_start = $ticket->start_date;
                        $date_end = $ticket->end_date;
                        $dateStart = new DateTime($date_start);
                        $dateEnd = new DateTime($date_end);

                        $slaDiffHari = $dateStart->diff($dateEnd)->d;
                        $slaDiffJam = $dateStart->diff($dateEnd)->h;
                        $ticket->sla->time;
                        if($slaDiffHari >= 1){
                        echo "class='table-danger'";
                        }else if($slaDiffJam >= $ticket->sla->time){
                        echo "class='table-danger'";
                        }
                        }
                        @endphp
                        >
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
                            @php
                            if($ticket->status == 'closed'){
                            $date_start = $ticket->start_date;
                            $date_end = $ticket->end_date;
                            $dateStart = new DateTime($date_start);
                            $dateEnd = new DateTime($date_end);

                            $slaDiffHari = $dateStart->diff($dateEnd)->d;
                            $slaDiffJam = $dateStart->diff($dateEnd)->h;
                            $ticket->sla->time;
                            if($slaDiffHari >= 1){
                            echo "<span class='badge rounded-pill bg-label-danger me-1'>OVER SLA</span>";
                            }else if($slaDiffJam >= $ticket->sla->time){
                            echo "<span class='badge rounded-pill bg-label-danger me-1'>OVER SLA</span>";
                            }else{
                            echo "<span class='badge rounded-pill bg-label-success me-1'>MEET SLA</span>";
                            }
                            }
                            @endphp

                        </td>
                        <td>{{ $ticket->created_at }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ri-more-2-line"></i>
                                </button>
                                <div class="dropdown-menu" style="">
                                    <a href="{{ route('ticket.show', $ticket->id) }}" class="dropdown-item waves-effect"><i class="ri-eye-line text-warning me-1"></i> Show</a>
                                    <a href="{{ route('ticket.edit', $ticket->id) }}" class="dropdown-item waves-effect"><i class="ri-pencil-line text-primary me-1"></i> Edit</a>
                                    @can('ticket-delete')
                                    <form action="{{ route('ticket.destroy', $ticket->id) }}" method="post" style="display: inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="dropdown-item waves-effect"><i class="ri-delete-bin-6-line text-danger me-1"></i> Delete</button>
                                    </form>
                                    @endcan
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
