@extends('layout.app')

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
                        <th>No</th>
                        <th>Request Date</th>
                        <th>Requestor</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($acceptances as $accept)
                        <tr>
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $accept->tanggal_pengajuan }}</td>
                            <td class="align-middle">{{ $accept->staff->nama_staff }}</td>
                            <td class="align-middle text-center">
                                @if($accept->status == 'Settlement' || $accept->status == 'Requested')
                                    <span class="badge badge-pill badge-primary">{{ $accept->status }}</span>
                                @elseif ($accept->status == 'Rejected')
                                    <span class="badge badge-pill badge-danger">{{ $accept->status }}</span>
                                @else
                                    <span class="badge badge-pill badge-success">{{ $accept->status }}</span>
                                @endif
                            </td>
                            <td class="align-middle text-center">
                                {{--                                <a class="btn btn-primary"--}}
                                {{--                                   href="{{ route('staff.request.myrequestbyid', encrypt($accept->id_request)) }}">--}}
                                {{--                                    <i class="fas fa-info-circle"></i>--}}
                                {{--                                </a>--}}
                                <a class="btn btn-primary"
                                   href="{{ route('staff.request.myrequestbyid', $accept->id_request) }}">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                @if($accept->status == 'Requested')
                                    @if($accept->acceptance->hasPermission(auth()->user()->id_staff, $accept->id_request) == 1)
                                        <a class="btn btn-success"
                                           href="{{ route('staff.acceptance.accept', $accept->id_request) }}"
                                           onclick="return confirm('Are you sure to accept this request ?')">
                                            <i class="fas fa-check"></i>
                                        </a>
                                        <a class="btn btn-danger"
                                           href="{{ route('staff.acceptance.decline', $accept->id_request) }}"
                                           onclick="return confirm('Are you sure to decline this request ?')">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    @endif
                                @endif
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
