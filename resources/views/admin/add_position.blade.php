@extends('layout.admin')

@section('content')
    <div class="row mb-3">
        <div class="col-5 mx-auto">
            <form action="{{ route('admin.add_position.post') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="formGroupExampleInput2">Name of New Position</label>
                    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Position"
                           name="nama_position" value="{{ old('nama_position') }}">
                    @error('nama_position')
                    <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Subposition</label>
                    <select id="inputState" class="form-control" name="id_subposition">
                        @foreach($positions as $pstn)
                            <option
                                value="{{ $pstn->subposition->id_subposition }}">{{ $pstn->subposition->nama_subposition }}</option>
                        @endforeach
                    </select>
                    @error('id_subposition')
                    <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Add Position</button>
            </form>
        </div>
    </div>
@endsection
