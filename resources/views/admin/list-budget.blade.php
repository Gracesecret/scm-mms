@extends('layouts.master')
@section('title')
List Budget | MMS
@endsection
@section('konten')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Data Budget</h4>
                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                    <i class="fa fa-plus"></i>
                    Add Budget
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Budget</th>
                            <th>Request</th>
                            <th>Departement</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $budg)
                        <tr>
                            <td>@currency($budg->budget)</td>
                            <td>@currency($budg->request)</td>
                            <td>{{$budg->dept->departement}}</td>
                            <td>
                                <div class="form-button-action">
                                    @can('isMain')
                                    <button type="button" data-toggle="modal" data-target="#editRowModal{{$budg->id}}" title="" class="btn btn-link btn-primary btn-lg">
                                        <i class="fa fa-edit">Process</i>
                                    </button>
                                    @endcan
                                    @can('isSub')
                                    <button type="button" data-toggle="modal" data-target="#requestmodal{{$budg->id}}" class="btn btn-link btn-primary btn-lg">
                                        <i class="fas fa-sign-out-alt"> Request</i>
                                    </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        <!-- modal edit -->
                        <div class="modal fade" id="editRowModal{{$budg->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header no-bd">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">
                                                New</span>
                                            <span class="fw-mediumbold">
                                                Supplier
                                            </span>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <!-- Modal Edit -->
                                    <div class="modal-body">
                                        <form method="POST" action="{{ url('/update-budget/'.$budg->id) }}">
                                            @csrf
                                            @method('put')
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Input</label>
                                                        <input id="budget" type="number" class="form-control" value="{{$budg->budget}}" required name="budget">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer no-bd">
                                                <button type="submit" class="btn btn-primary">Add</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="requestmodal{{$budg->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header no-bd">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">
                                                New</span>
                                            <span class="fw-mediumbold">
                                                Supplier
                                            </span>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <!-- Modal Edit -->
                                    <div class="modal-body">
                                        <form method="POST" action="{{ url('/request-budget/'.$budg->id) }}">
                                            @csrf
                                            @method('put')
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Input</label>
                                                        <input id="req" type="number" class="form-control" value="{{$budg->request}}" required name="req">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer no-bd">
                                                <button type="submit" class="btn btn-primary">Add</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $(document).ready(function() {
        $('#basic-datatables').DataTable({});

        $('#multi-filter-select').DataTable({
            "pageLength": 5,
            initComplete: function() {
                this.api().columns().every(function() {
                    var column = this;
                    var select = $('<select class="form-control"><option value=""></option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });

                    column.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            }
        });

    });
</script>
@include('sweetalert::alert')
@endpush