@extends('layout.admin')

@section('button')
    <a href="{{ route('admin.add_position') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-user-plus fa-sm text-white-50"></i> Add New Position
    </a>
@endsection

@section('content')
    @if(session('status'))
        <div class="alert alert-{{ session('class') }} alert-dismissible fade show"
             role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Position Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($positions as $position)
                        <tr>
                            <td class="align-middle">{{ $position['id_position'] }}</td>
                            <td class="align-middle">{{ $position['nama_position'] }}</td>
                            <td class="align-middle text-center">
                                <a class="btn btn-primary"
                                   href="{{ route('admin.edit_position', encrypt($position['id_position'])) }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a class="btn btn-danger"
                                   onclick="return confirm('Are you sure to delete {{ $position['nama_position'] }} ?')"
                                   href="{{ route('admin.delete_position', encrypt($position['id_position'])) }}">
                                    <i class="fas fa-trash-alt"></i></a>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script src="{{ asset('assets') }}/js/demo/datatables-demo.js"></script>
@endpush
