@extends('layouts.master')
@section('title')
Goods Receipt | MMS
@endsection
@section('konten')

@section('arrow')
<a href="#">Goods Receipt</a>
@endsection
<div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">List Goods Receipt</h4>
                    <a href="{{route('formadd-gr')}}" class="btn btn-primary btn-round ml-auto">
                        <i class="fa fa-plus"></i>
                        Add GR
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NO GR</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>
                            @foreach($data as $gr)
                            <tr>
                                <td><?= ++$no ?></td>
                                <td>{{$gr->no_gr}}</td>
                                <td>{{$gr->status}}</td>
                                <td>{{$gr->created_at}}</td>
                                <td>
                                    @if($gr->status == 'Returned')
                                    <a class="btn btn-info" href="{{route('edit-gr',$gr->id)}}">
                                        Edit
                                    </a>
                                    @endif
                                    <a class="btn btn-success" href="{{route('detail-gr',$gr->id)}}">
                                        Detail
                                    </a>
                                </td>
                            </tr>
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
    <script>
        $(document).ready(function() {
            $('.mySelect2').select2();
        });
    </script>
    <!--  -->
    @endpush