@extends('layout.admin')

@section('button')
<a href="{{ route('admin.add_staff.post') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
    <i class="fas fa-user-plus fa-sm text-white-50"></i> Add Staff
</a>
@endsection

@section('content')
@if(session('status'))
<div class="alert alert-{{ session('class') }} alert-dismissible fade show" role="alert">
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date Birth</th>
                        <th>Date Join</th>
                        <th>Position</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($staffs as $staff)
                    <tr>
                        <td class="align-middle">{{ $staff['nama_staff'] }}</td>
                        <td class="align-middle">{{ $staff['email_staff'] }}</td>
                        <td class="align-middle">{{ $staff['tanggal_lahir'] }}</td>
                        <td class="align-middle">{{ $staff['tanggal_masuk'] }}</td>
                        <td class="align-middle">{{ $staff['position']['nama_position'] }}</td>
                        <td class="text-center align-middle">
                            <a class="btn btn-primary" href="{{ route('admin.edit_staff', encrypt($staff['id_staff'])) }}">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a class="btn btn-danger" onclick="return confirm(`Are you sure to delete {{ $staff['nama_staff'] }} ?`)" href="{{ route('admin.delete_staff', encrypt($staff['id_staff'])) }}"><i class="fas fa-trash-alt"></i></a>
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
