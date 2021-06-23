@extends('layout.admin')

@section('content')
    <div class="row mb-3">
        <div class="col-5 mx-auto">
            <form action="{{ route('admin.add_staff.post') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="formGroupExampleInput2">Name</label>
                    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Full Name"
                           name="nama_staff" value="{{ old('nama_staff') }}">
                    @error('nama_staff')
                    <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Email</label>
                    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Email"
                           name="email_staff" value="{{ old('email_staff') }}">
                    @error('email_staff')
                    <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Date Join</label>
                    <input type="date" class="form-control" id="formGroupExampleInput2" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}">
                    @error('tanggal_masuk')
                    <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Date of Birth</label>
                    <input type="date" class="form-control" id="formGroupExampleInput2" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                    @error('tanggal_lahir')
                    <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Position</label>
                    <select id="inputState" class="form-control" name="id_position">
                        <option selected hidden value="0">Choose...</option>
                        @foreach($positions as $position)
                            <option value="{{ $position->id_position }}">{{ $position->nama_position }}</option>
                        @endforeach
                    </select>
                    @error('id_position')
                    <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
