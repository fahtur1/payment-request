@extends('layout.app')

@section('back')
    <a class="btn btn-outline-primary" href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i></a>
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Description</th>
                        <th>Reference</th>
                        <th>Budget Available</th>
                        <th>Amount</th>
                        <th>Quantity</th>
                        <th>UOM</th>
                        <th>Estimated Unit Price</th>
                        <th>Project</th>
                        <th>Account Code</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($myrequest->item as $req)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $req->description }}</td>
                            <td>{{ $req->references }}</td>
                            <td>{{ $req->budget_available }}</td>
                            <td>{{ $req->amount }}</td>
                            <td>{{ $req->quantity }}</td>
                            <td>{{ $req->unit_of_measurement }}</td>
                            <td>{{ $req->estimated_unit_price }}</td>
                            <td>{{ $req->project }}</td>
                            <td>{{ $req->account_code }}</td>
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
