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
                                <span class="badge badge-pill badge-primary">{{ $accept->status }}</span>
                            </td>
                            <td class="align-middle text-center">
                                <a class="btn btn-primary"
                                   href="{{ route('staff.request.myrequestbyid', encrypt($accept)) }}">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                @if($accept->acceptance->hasPermission(auth()->user()->id_staff, $accept->id_request))
                                    @if($accept->status == 'Requested')
                                        <a class="btn btn-success"
                                           href="{{ route('staff.acceptance.accept', encrypt($accept)) }}"
                                           onclick="return confirm('Are you sure to accept this request ?')">
                                            <i class="fas fa-check"></i>
                                        </a>
                                        <a class="btn btn-danger"
                                           href="{{ route('staff.acceptance.decline', encrypt($accept)) }}"
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
