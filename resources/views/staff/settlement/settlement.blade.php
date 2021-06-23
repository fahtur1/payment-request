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
                        <th>Tanggal Pengajuan</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($settlements as $settlement)
                        <tr>
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $settlement->tanggal_pengajuan }}</td>
                            <td class="align-middle text-center">
                                @if($settlement->status == 'Settlement' || $settlement->status == 'Requested')
                                    <span class="badge badge-pill badge-primary">{{ $settlement->status }}</span>
                                @else
                                    <span class="badge badge-pill badge-success">{{ $settlement->status }}</span>
                                @endif
                            </td>
                            <td class="align-middle text-center">
                                @if($settlement->status == 'Settlement')
                                    <a class="btn btn-warning"
                                       href="{{ route('staff.settlement.upload', encrypt($settlement)) }}">
                                        <i class="fas fa-upload"></i>
                                    </a>
                                @elseif($settlement->status == 'Done')
                                    <a href="{{ route('export.pr', encrypt($settlement)) }}" class="btn btn-warning">
                                        <i class="fas fa-print"></i>
                                    </a>
                                @endif
                                <a class="btn btn-primary"
                                   href="{{ route('staff.request.myrequestbyid', encrypt($settlement)) }}">
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
