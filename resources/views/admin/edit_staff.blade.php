@extends('layout.admin')

@section('back')
<a class="btn btn-outline-primary" href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i></a>
@endsection

@section('content')
<div class="row mb-3">
    <div class="col-5 mx-auto">
        <form action="{{ route('admin.edit_staff.post', encrypt($staff->id_staff)) }}" method="post">
            @csrf
            <div class="form-group">
                <label for="formGroupExampleInput2">Name</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Full Name" name="nama_staff" value="{{ $staff->nama_staff }}" readonly>
                @error('nama_staff')
                <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Email</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Email" name="email_staff" value="{{ $staff->email_staff }}" readonly>
                @error('email_staff')
                <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Date Join</label>
                <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="{{ date('Y-m-d', strtotime($staff->tanggal_masuk)) }}" readonly>
                @error('tanggal_masuk')
                <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Date of Birth</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ date('Y-m-d', strtotime($staff->tanggal_lahir)) }}" readonly>
                @error('tanggal_lahir')
                <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Position</label>
                <select id="inputState" class="form-control" name="id_position">
                    <option selected value="{{ $staff->position->id_position }}">{{ $staff->position->nama_position }}</option>
                    @foreach($positions as $position)
                    @if($staff->position->id_position == $position->id_position)
                    @continue
                    @endif
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

@push('js')
<script>
    let tanggalLahir = "{{ $staff->tanggal_lahir }}";
    console.log(tanggalLahir)

</script>
@endpush
