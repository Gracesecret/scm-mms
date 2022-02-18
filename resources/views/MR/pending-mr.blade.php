@extends('layouts.master')
@section('title')
Material Requisition | MMS
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
                    href="{{route('list-mr')}}">All<span class="bg-white text-muted ml-2">
                    {{$badge->count()}}                        
                        </span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-muted px-2" href="{{route('approved-mr')}}">Released <span class="bg-white border text-muted ml-2">
                            {{$badge->where('status','=','released')->count()}}
                        </span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active bg-transparent pr-2 pl-0 text-primary" href="">Pending<span class="bg-white border text-muted ml-2">
                            {{$badge->where('status','=','pending')->count()}}
                        </span></a>
                </li>
            </ul>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">List MR</h4>
                    <a href="{{route('formadd-mr')}}" class="btn btn-primary btn-round ml-auto">
                        <i class="fa fa-plus"></i>
                        Add MR
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NO MR</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>
                            @foreach($data as $mr)
                            <tr>
                                <td><?= ++$no ?></td>
                                <td>{{$mr->no_mr}}</td>
                                <td>{{$mr->status}}</td>
                                <td>{{$mr->created_at->format('Y-m-d')}}</td>
                                <td>
                                @can('isMain')
                                @if($mr->status == 'pending')
                                <a class="btn btn-info" href="{{route('proses-mr',$mr->id)}}">
                                    Process
                                </a>
                                @endif
                                @endcan
                                <a class="btn btn-success" href="{{route('detail-mr',$mr->id)}}">
                                    Detail
                                </a>                                
                                <button type="button" class="btn btn-danger alert_demo_8" data-id="{{$mr->id}}">
                                    Delete
                                </button>
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