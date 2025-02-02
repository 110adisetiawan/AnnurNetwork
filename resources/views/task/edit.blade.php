@extends('../layout')
@section('content')
<div class="col-md-6">
    <div class="card">
        <h1 class="card-header">Edit Tugas</h1>
        <div class="card-body">
            <form action=" {{ route('task.update',$task->id) }}" method="post">
                @csrf
                @method('put')
                <div class="form-floating form-floating-outline mb-6">
                    <input type="text" class="form-control" id="basic-default-fullname" placeholder="Urgent / Medium / Low" name="nama_tugas" value="{{ old('title', $task->nama_tugas) }}">
                    <label for=" basic-default-fullname">Nama Tugas</label>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
    @endsection
