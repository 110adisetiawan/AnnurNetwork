@extends('../layout')
@section('content')

<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('ticket.edit', $ticket->id) }}" class="btn btn-warning waves-effect waves-light float-end" name="status" value="onprogress">
                Edit Ticket<span class="ri-arrow-drop-right-line ri-25px"></span>
            </a>
            <h3>Detail Ticket</h3>
        </div>
        <div class="card-body">
            <div class="form-floating form-floating-outline mb-6">
                <input type="text" class="form-control" id="basic-default-fullname" placeholder="" name="ticket_id" value="{{ $ticket->id }}" readonly>
                <label for="basic-default-fullname">Tiket ID</label>
            </div>
            <div class="form-floating form-floating-outline mb-6">
                <input type="text" class="form-control" id="basic-default-fullname" placeholder="Pak RT" name="customer_name" value="{{ $ticket->customer_name }}" readonly>
                <label for="basic-default-fullname">Nama Customer</label>
            </div>
            <div class="form-floating form-floating-outline mb-6">
                <input type="text" class="form-control" id="basic-default-fullname" placeholder="Jl.xx xx" name="customer_address" value="{{ $ticket->customer_address }}" readonly>
                <label for="basic-default-fullname">Alamat Customer</label>
            </div>
            <div class="form-floating form-floating-outline mb-6">
                <input type="text" class="form-control" id="basic-default-fullname" placeholder="Jl.xx xx" name="customer_address" value="{{ $ticket->user->name }}" readonly>
                <label for="basic-default-fullname">Teknisi</label>
            </div>
            <div class="mb-6">
                <div class="mt-4">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success waves-effect waves-light mb-2" data-bs-toggle="modal" data-bs-target="#modalCenter">
                        <span class="ri-image-line ri-16px me-1_5"></span>Lihat Foto Lokasi
                    </button>
                    <a class="btn btn-success waves-effect waves-light mb-2" target="_blank" href="https://www.google.com/maps/place/{{ $ticket->latitude_ticket }},{{ $ticket->longitude_ticket }}">
                        <span class="ri-map-2-line ri-16px me-1_5"></span>Lihat Maps Lokasi
                    </a>
                </div>
            </div>
            @if($ticket->status == 'onprogress')
            <div class="form-floating form-floating-outline mb-6">
                <input type="text" class="form-control" id="basic-default-fullname" placeholder="" value="{{ $ticket->start_date }}" readonly>
                <label for="basic-default-fullname">Start Date</label>
            </div>
            @endif
            <div class="mb-6"> Ticket Status :
                @if($ticket->status == 'open')
                <span class="badge rounded-pill bg-label-success me-1">OPEN</span>
                @elseif($ticket->status == 'onprogress')
                <span class="badge rounded-pill bg-label-warning me-1">ON PROGRESS</span>
                @else
                <span class="badge rounded-pill bg-label-dark me-1">CLOSED by : {{ $ticket->closed_by }}</span>@endif
            </div>
        </div>
    </div>
</div>
@if($ticket->status == 'closed')

<div class="col-md-6">
    <div class="card">
        <div class="card-body">
            @php
            $date_start = $ticket->start_date;
            $date_end = $ticket->end_date;
            $dateStart = new DateTime($date_start);
            $dateEnd = new DateTime($date_end);

            $slaDiffHari = $dateStart->diff($dateEnd)->d;
            $slaDiffJam = $dateStart->diff($dateEnd)->h;
            $ticket->sla->time;
            if($slaDiffHari >= 1){
            echo "<span class='badge rounded-pill bg-label-danger me-1 float-end'>OVER SLA</span>";
            }else if($slaDiffJam >= $ticket->sla->time){
            echo "<span class='badge rounded-pill bg-label-danger me-1 float-end'>OVER SLA</span>";
            }else{
            echo "<span class='badge rounded-pill bg-label-success me-1 float-end'>MEET SLA</span>";
            }
            @endphp
            <h3>On Progress Form</h3>
            <div class="form-floating form-floating-outline mb-6">
                <input type="text" class="form-control" id="basic-default-fullname" placeholder="" value="{{ $ticket->start_date }}" readonly>
                <label for="basic-default-fullname">Start Date</label>
            </div>
            <div class="form-floating form-floating-outline mb-6">
                <input type="text" class="form-control {{ ($slaDiffHari >= 1 || $slaDiffJam >= $ticket->sla->time) ? 'border border-danger text-danger' : 'border border-success text-success' }} " id="basic-default-fullname" placeholder="" value="{{ $ticket->end_date }}" readonly>
                <label for="basic-default-fullname" class="{{ ($slaDiffHari >= 1 || $slaDiffJam >= $ticket->sla->time) ? 'text-danger' : 'text-success' }}">End Date</label>
            </div>
            <div class="form-floating form-floating-outline mb-6">
                <input type="text" class="form-control" id="basic-default-fullname" placeholder="" value="{{ $ticket->sla->nama_sla }}" readonly>
                <label for="basic-default-fullname">SLA</label>
            </div>
            <div class="input-group mb-6">
                <span class="input-group-text"><span class="ri-gps-line ri-16px me-1_5"></span>GPS</span>
                <input type="text" aria-label="First name" class="form-control" name="latitude_task" id="latitude_karyawan" value="{{ $ticket->latitude_task }}" readonly>
                <input type="text" aria-label="Last name" class="form-control" name='longitude_task' id="longitude_karyawan" value="{{ $ticket->longitude_task }}" readonly>
            </div>
            <div class="mb-6">
                <button type="button" class="btn btn-success waves-effect waves-light mb-2" data-bs-toggle="modal" data-bs-target="#modalCenterTask">
                    <span class="ri-image-line ri-16px me-1_5"></span>Lihat Foto Pekerjaan
                </button>
                <a class="btn btn-success waves-effect waves-light mb-2" target="_blank" href="https://www.google.com/maps/place/{{ $ticket->latitude_task }},{{ $ticket->longitude_task }}">
                    <span class="ri-map-2-line ri-16px me-1_5"></span>Lihat Maps Lokasi Teknisi
                </a>
            </div>
            <div class="form-floating form-floating-outline mb-6">
                <textarea class="form-control h-px-100" id="exampleFormControlTextarea1" placeholder="Opsional" name="note" readonly>{{ $ticket->note }}</textarea>
                <label for="exampleFormControlTextarea1">Catatan</label>
            </div>
        </div>
    </div>
</div>
@endif

<div class="modal fade" id="modalCenter" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Foto Lokasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-12 mb-6 mt-2 text-center">
                        <div class="form-floating form-floating-outline">
                            <img class="img-fluid rounded mx-auto d-block" src="{{ url('/') }}/assets/img/customer/{{ $ticket->image_address }}" alt="{{ $ticket->customer_name }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalCenterTask" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Foto Lokasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-12 mb-6 mt-2 text-center">
                        <div class="form-floating form-floating-outline">
                            <img class="img-fluid rounded mx-auto d-block" src="{{ url('/') }}/assets/img/ticket_task/{{ $ticket->image_task }}" alt="{{ $ticket->customer_name }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
