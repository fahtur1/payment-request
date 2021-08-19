@extends('layout.app')

@section('button')
<a type="button" class="btn btn-primary" href="{{ route('staff.edit_profile') }}">
    <i class="fas fa-pencil-alt"></i> Edit Profile
</a>
@endsection

@section('content')
<div class="row">
    <div class="col-md-5 mx-auto">
        @if(session('message'))
        <div class="alert alert-{{ session('class') }} alert-dismissible fade show" role="alert">
            {{ session('message') }}.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="form-group">
            <label for="exampleInputEmail1">Nama Staff</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ auth()->user()->nama_staff }}" readonly>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ auth()->user()->email_staff}}" readonly>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Tanggal Lahir</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ auth()->user()->tanggal_lahir}}" readonly>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Tanggal Masuk</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ auth()->user()->tanggal_masuk}}" readonly>
        </div>
    </div>
</div>
@endsection
