@extends('layouts.master')
@section('title')
Purchase Requisition | MMS
@endsection
@section('konten')

@section('arrow')
<a href="#">Material Requisition</a>
@endsection
<div class="col-md-12">
        <div class="col-md mb-3">
            <ul class="nav nav-pills justify-content-start">
                <li class="nav-item">
                    <a class="nav-link text-muted px-2" 
                    href="{{route('list-pr')}}">All<span class="bg-white text-muted ml-2">
                    {{$badge->count()}}                        
                        </span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active bg-transparent text-primary px-2" href="{{route('approved-pr')}}">Approved <span class="bg-white border text-muted ml-2">
                            {{$badge->where('status','=','approved')->count()}}
                        </span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-muted px-2" href="{{route('pending-pr')}}">Pending<span class="bg-white border text-muted ml-2">
                            {{$badge->where('status','=','pending')->count()}}
                        </span></a>
                </li>
            </ul>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">List Purchase Requisition</h4>
                    <a href="{{route('formadd-pr')}}" class="btn btn-primary btn-round ml-auto">
                        <i class="fa fa-plus"></i>
                        Add PR
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NO PR</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>
                            @foreach($data as $pr)
                            <tr>
                                <td><?= ++$no ?></td>
                                <td>{{$pr->no_pr}}</td>
                                <td>{{$pr->status}}</td>
                                <td>{{$pr->created_at->format('Y-m-d')}}</td>
                                <td>
                                <a class="btn btn-success" href="{{route('detail-pr',$pr->id)}}">
                                    Detail
                                </a>
                                @if($pr->status == 'pending')
                                @can('isMain')
                                <a class="btn btn-info" href="{{route('proses-pr',$pr->id)}}">
                                    Process
                                </a>
                                @endcan
                                <a class="btn btn-danger alert_demo_8 text-white" data-id="{{$pr->id}}">
                                    Delete
                                </a>
                                @endif
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