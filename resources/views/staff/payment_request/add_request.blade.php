@extends('layout.app')

@section('back')
    <a class="btn" href="{{ route('staff.request.myrequest') }}"><i class="fa fa-arrow-left"></i></a>
@endsection

@section('button')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
        <i class="fas fa-cart-plus"></i> Add Item
    </button>
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
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <button id="request_submit" class="btn btn-primary">Submit Request</button>
@endsection

@section('modal')
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <input type="text" class="form-control" id="add_description"
                               aria-describedby="emailHelp" placeholder="ex. Banner 3x4">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">References</label>
                        <input type="text" class="form-control" id="add_references"
                               aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Budget Available</label>
                        <input type="number" class="form-control" id="add_budget"
                               aria-describedby="emailHelp" placeholder="ex. 50000">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Amount</label>
                        <input type="number" class="form-control" id="add_amount"
                               aria-describedby="emailHelp" placeholder="ex. 100000">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Quantity</label>
                        <input type="number" class="form-control" id="add_quantity"
                               aria-describedby="emailHelp" placeholder="ex. 5">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Unit of Measurement</label>
                        <input type="text" class="form-control" id="add_uom"
                               aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Estimated Unit Price</label>
                        <input type="text" class="form-control" id="add_estimated"
                               aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Project</label>
                        <input type="text" class="form-control" id="add_project"
                               aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Account Code</label>
                        <input type="text" class="form-control" id="add_accountcode"
                               aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="add_btn">Add</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_item" hidden>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <input type="text" class="form-control" id="edit_description"
                               aria-describedby="emailHelp" placeholder="ex. Banner 3x4">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">References</label>
                        <input type="text" class="form-control" id="edit_references"
                               aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Budget Available</label>
                        <input type="number" class="form-control" id="edit_budget"
                               aria-describedby="emailHelp" placeholder="ex. 50000">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Amount</label>
                        <input type="number" class="form-control" id="edit_amount"
                               aria-describedby="emailHelp" placeholder="ex. 100000">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Quantity</label>
                        <input type="number" class="form-control" id="edit_quantity"
                               aria-describedby="emailHelp" placeholder="ex. 5">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Unit of Measurement</label>
                        <input type="text" class="form-control" id="edit_uom"
                               aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Estimated Unit Price</label>
                        <input type="text" class="form-control" id="edit_estimated"
                               aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Project</label>
                        <input type="text" class="form-control" id="edit_project"
                               aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Account Code</label>
                        <input type="text" class="form-control" id="edit_accountcode"
                               aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="edit_btn">Edit</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            let table = $('#dataTable').DataTable();

            // Add item form
            let description = $('#add_description');
            let references = $('#add_references');
            let budget = $('#add_budget');
            let amount = $('#add_amount');
            let quantity = $('#add_quantity');
            let uom = $('#add_uom');
            let estimated = $('#add_estimated');
            let project = $('#add_project');
            let accountCode = $('#add_accountcode');

            // Edit item form
            let idItemEdit = $('#id_item');
            let descriptionEdit = $('#edit_description');
            let referencesEdit = $('#edit_references');
            let budgetEdit = $('#edit_budget');
            let amountEdit = $('#edit_amount');
            let quantityEdit = $('#edit_quantity');
            let uomEdit = $('#edit_uom');
            let estimatedEdit = $('#edit_estimated');
            let projectEdit = $('#edit_project');
            let accountCodeEdit = $('#edit_accountcode');

            let id = 1;

            // button submit request
            $('#request_submit').click(function () {
                let data = [];

                table.rows().every(function () {
                    data.push(this.data());
                })

                if (data.length > 0) {
                    $.ajax({
                        method: 'POST',
                        url: '{{ route('staff.request.add_request.post') }}',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        data: {data},
                        success: function (data) {
                            alert(data.message);
                            window.location.href = '{{ route('staff.request.myrequest') }}';
                        },
                        error: function (msg) {
                            console.log(msg.responseJSON.message);
                        }
                    });
                } else {
                    alert('Add item first !');
                }

            });

            // row delete onclick
            table.on('click', '.remove-btn', function () {
                if (confirm('Are you sure to delete this item ?')) {
                    table.row($(this).parents('tr')).remove().draw();
                    id--;
                }
            });

            table.on('click', '.edit-btn', function () {
                let dataItem = table.row($(this).parents('tr')).data();

                setFormEditValue(dataItem);
            });

            // button modal edit item
            $('#edit_btn').click(function () {
                editValue();
                clearValueEdit();

                $('#editBackdrop').modal('toggle');
            });

            // button modal add item
            $('#add_btn').click(function () {
                addValue();
                clearValue();

                $('#staticBackdrop').modal('toggle');
            });

            function addValue() {
                let rowAdd = table.row.add([
                    id,
                    description.val(),
                    references.val(),
                    budget.val(),
                    amount.val(),
                    quantity.val(),
                    uom.val(),
                    estimated.val(),
                    project.val(),
                    accountCode.val(),
                    `<button data-toggle="modal" data-target="#editBackdrop" class="btn btn-primary edit-btn"><i class="fas fa-pencil-alt"></i></button> ` +
                    `<button class="btn btn-danger remove-btn"><i class="fas fa-trash"></i></button>`
                ]).draw().node();

                $(rowAdd).find('td').eq(0).addClass('text-center');
                $(rowAdd).find('td').eq(7).addClass('text-center');
                $(rowAdd).find('td').addClass('align-middle');

                id++;
            }

            function editValue() {
                table.rows().every(function () {
                    let data = this.data();

                    if (data[0] == idItemEdit.val()) {
                        data[1] = descriptionEdit.val()
                        data[2] = referencesEdit.val()
                        data[3] = budgetEdit.val()
                        data[4] = amountEdit.val()
                        data[5] = quantityEdit.val()
                        data[6] = uomEdit.val()
                        data[7] = estimatedEdit.val()
                        data[8] = projectEdit.val()
                        data[9] = accountCodeEdit.val()
                        this.data(data).draw(false)
                    }
                });
            }

            function setFormEditValue(dataItem) {
                idItemEdit.val(dataItem[0]);
                descriptionEdit.val(dataItem[1]);
                referencesEdit.val(dataItem[2]);
                budgetEdit.val(dataItem[3]);
                amountEdit.val(dataItem[4]);
                quantityEdit.val(dataItem[5]);
                uomEdit.val(dataItem[6]);
                estimatedEdit.val(dataItem[7]);
                projectEdit.val(dataItem[8]);
                accountCodeEdit.val(dataItem[9]);
            }

            function clearValue() {
                description.val("");
                references.val("");
                budget.val("");
                amount.val("");
                quantity.val("");
                uom.val("");
                estimated.val("");
                project.val("");
                accountCode.val("");
            }

            function clearValueEdit() {
                descriptionEdit.val("");
                referencesEdit.val("");
                budgetEdit.val("");
                amountEdit.val("");
                quantityEdit.val("");
                uomEdit.val("");
                estimatedEdit.val("");
                projectEdit.val("");
                accountCodeEdit.val("");
            }

        });

    </script>
@endpush
