@extends('layout.app')

@section('back')
<a class="btn btn-outline-primary" href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i></a>
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
<form action="{{ route('staff.settlement.upload.post', $settlement->id_request) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Quantity</th>
                            <th>UOM</th>
                            <th>Amount Settle</th>
                            <th>Settlement</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($settlement->item as $item)
                        <tr>
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $item->description }}</td>
                            <td class="align-middle">{{ $item->amount }}</td>
                            <td class="align-middle">{{ $item->quantity }}</td>
                            <td class="align-middle">{{ $item->unit_of_measurement }}</td>
                            <td class="align-middle" style="width: 14%">
                                <input type="number" class="form-control" name="settlement-{{ $item->id_item }}" value="{{ $item->amount }}">
                            </td>
                            <td class="align-middle text-center">
                                @if($item->settlement == null)
                                <img src="{{ asset('assets/img/question-mark.png') }}" class="img-thumbnail" id="img-{{ $item->id_item }}" style="width: 100px; height: 100px; object-fit: cover;">
                                @else
                                <img src="{{ storage_path('settlement/' . $item->settlement) }}" style="width: 100px; height: 100px; object-fit: cover;">
                                @endif
                            </td>
                            <td class="align-middle text-center">
                                @if($item->settlement == null)
                                <button type="button" class="btn btn-primary button-upload" data-id="{{ $item->id_item }}">
                                    <i class="fas fa-upload"></i>
                                </button>
                                <input id="btn-{{ $item->id_item }}" type="file" name="img-{{ $item->id_item }}" style="display: none;" accept=".jpg, .png|image/*" />
                                @else
                                No Action Can be done
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <input type="submit" class="btn btn-primary" value="Save Changes">
</form>
@endsection

@push('js')
<script src="{{ asset('assets') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script src="{{ asset('assets') }}/js/demo/datatables-demo.js"></script>

<script>
    document.querySelectorAll('.button-upload').forEach((btn) => {
        btn.addEventListener('click', (e) => {
            let id = e.target.dataset.id;

            let inputFile = document.querySelector(`#btn-${id}`);

            inputFile.click();
            inputFile.addEventListener('change', (e) => {
                let url = URL.createObjectURL(e.target.files[0]);
                document.getElementById(`img-${id}`).src = url;
            });
        });
    });

</script>
@endpush
