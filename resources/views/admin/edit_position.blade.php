@extends('layout.admin')

@section('back')
    <a class="btn btn-outline-primary" href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i></a>
@endsection

@section('content')
    <div class="row mb-3">
        <div class="col-5 mx-auto">
            <form action="{{ route('admin.edit_position.post', $position) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="formGroupExampleInput2">Name of New Position</label>
                    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Position"
                           name="nama_position" value="{{ $position['nama_position'] }}">
                    @error('nama_position')
                    <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Choose a Position</label>
                    <select id="inputState" class="form-control" name="id_subposition">
                        <option selected
                                value="{{ $position->subposition->id_subposition }}">{{ $position->subposition->nama_subposition }}</option>
                        @foreach($positions as $pstn)
                            @if($position->subposition->nama_subposition == $pstn->subposition->nama_subposition)
                                @continue
                            @else
                                <option
                                    value="{{ $pstn->subposition->id_subposition }}">{{ $pstn->subposition->nama_subposition }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('id_subposition')
                    <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Edit Position</button>
            </form>
        </div>
    </div>
@endsection
