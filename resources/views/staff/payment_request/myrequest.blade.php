@extends('layout.app')

@section('button')
    <a href="{{ route('staff.request.add_request') }}"
       class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-plus fa-sm text-white-50"></i> New Request</a>
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($myrequests as $myrequest)
                        <tr>
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $myrequest->tanggal_pengajuan }}</td>
                            <td class="align-middle text-center">
                                @if($myrequest->status == 'Settlement' || $myrequest->status == 'Requested')
                                    <span class="badge badge-pill badge-primary">{{ $myrequest->status }}</span>
                                @elseif($myrequest->status == 'Rejected')
                                    <span class="badge badge-pill badge-danger">{{ $myrequest->status }}</span>
                                @else
                                    <span class="badge badge-pill badge-success">{{ $myrequest->status }}</span>
                                @endif
                            </td>
                            <td class="align-middle text-center">
                                <a class="btn btn-primary"
                                   href="{{ route('staff.request.myrequestbyid', encrypt($myrequest)) }}">
                                    <i class="fas fa-info-circle"></i>
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
