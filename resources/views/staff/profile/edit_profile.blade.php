@extends('layout.app')

@section('back')
<a class="btn btn-outline-primary" href="{{ route('staff.profile') }}"><i class="fa fa-arrow-left"></i></a>
@endsection

@section('content')
<form action="{{ route('staff.edit_profile.post') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-5 mx-auto">
            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session('message'))
            <div class="alert alert-{{ session('class') }} alert-dismissible fade show" role="alert">
                {{ session('message') }}.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="text" class="form-control" aria-describedby="emailHelp" value="{{ auth()->user()->email_staff}}" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Staff</label>
                <input type="text" name="nama_staff" class="form-control" aria-describedby="emailHelp" value="{{ auth()->user()->nama_staff }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" aria-describedby="emailHelp" value="{{ date('Y-m-d', strtotime(auth()->user()->tanggal_lahir)) }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Tanggal Masuk</label>
                <input type="date" class="form-control" aria-describedby="emailHelp" value="{{ date('Y-m-d', strtotime(auth()->user()->tanggal_masuk)) }}" readonly>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="checkboxPassword" name="checkboxPassword">
                <label class="form-check-label" for="exampleCheck1">Edit Password</label>
            </div>
            <div id="inputPassword" style="display: none">
                <div class="form-group">
                    <label for="exampleInputEmail1">Old Password</label>
                    <input type="password" name="old_password" class="form-control" aria-describedby="emailHelp">
                    @error('old_password')
                    <small class="ml-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">New Password</label>
                    <input type="password" name="new_password" class="form-control" aria-describedby="emailHelp">
                    @error('new_password')
                    <small class="ml-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const checkboxPassword = document.getElementById('checkboxPassword');
        const inputPassword = document.getElementById('inputPassword');

        checkboxPassword.addEventListener('change', (e) => {
            if (!e.target.checked) {
                inputPassword.style.display = "none";
            } else {
                inputPassword.style.display = "block";
            }
        });
    });

</script>
@endpush
