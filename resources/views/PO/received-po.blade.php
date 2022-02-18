@extends('layouts.master')
@section('title')
Purchase Order | MMS
@endsection
@section('konten')

@section('arrow')
<a href="#">Purchase Order</a>
@endsection
<div class="col-md-12">
    <div class="col-md mb-3">
        <ul class="nav nav-pills justify-content-start">
            <li class="nav-item">
                <a class="nav-link text-muted" href="{{route('list-po')}}">All<span class="bg-white text-muted ml-2">
                        {{$badge->count()}}
                    </span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-muted" href="{{route('pending-po')}}">Pending<span class="bg-white border text-muted ml-2">
                        {{$badge->where('status','=','pending')->count()}}
                    </span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link active bg-transparent text-primary" href="">Completed<span class="bg-white border text-muted ml-2">
                        {{$badge->where('status','=','Completed')->count()}}
                    </span></a>
            </li>
        </ul>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">List Purchase Order</h4>
                <button type="button" class="btn btn-round btn-primary ml-auto" data-toggle="modal" data-target="#modal-po" data-whatever="@mdo">
                <i class="fa fa-plus"></i> Add PO</button>
                <button type="button" class="btn btn-round btn-primary ml-3" data-toggle="modal" data-target="#modal-full" data-whatever="@mdo">
                <i class="fa fa-plus"></i> Add PO By PR</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NO PO</th>
                            <th>Supplier</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0; ?>
                        @foreach($data as $po)
                        <tr>
                            <td><?= ++$no ?></td>
                            <td>{{$po->no_po}}</td>
                            <td>{{$po->suplier->nama_cv}}</td>
                            <td>{{$po->status}}</td>
                            <td>{{$po->created_at}}</td>
                            <td>
                            @if($po->status == 'received')
                                <a class="btn btn-info" href="{{route('proses-po',$po->id)}}">
                                    Process
                                </a>
                                @else
                                    <a class="btn btn-success" href="{{route('detail-po',$po->id)}}">
                                        Detail
                                    </a>
                                @endif
                                @if($po->status == 'pending')
                                <a class="btn btn-danger alert_demo_8 text-white" data-id="{{$po->id}}">
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
<!-- Fullscreen modal -->
<div class="modal fade modal-full" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true" id="modal-po">
    <button aria-label="" type="button" class="close px-2" data-dismiss="modal" aria-hidden="true">
    </button>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <h3 style="text-align: center;"> Please Select Suplier First </h3>
            <div class="modal-body text-center">
                <table class="table datatables" id="dataTable-2">
                    <thead>
                        <tr role="row">
                            <th>Suplier Name</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suplier as $q)
                        <tr>
                            <td>{{$q->nama_cv}}</td>
                            <td>{{$q->alamat}}</td>
                            <td><a href=""><button class="btn btn-info">Select</button></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Fullscreen modal -->
<div class="modal fade modal-full" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true" id="modal-full">
    <button aria-label="" type="button" class="close px-2" data-dismiss="modal" aria-hidden="true">
    </button>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <h3 style="text-align: center;"> Please Select Supplier First </h3>
            <div class="modal-body text-center">
                <table class="table datatables" id="dataTable-3">
                    <thead>
                        <tr role="row">
                            <th>Suplier Name</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suplier as $q)
                        <tr>
                            <td>{{$q->nama_cv}}</td>
                            <td>{{$q->alamat}}</td>
                            <td><a href=""><button class="btn btn-info">Select</button></a></td>
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
      $('#dataTable-2').DataTable(
      {
        autoWidth: true,
        "lengthMenu": [
          [16, 32, 64, -1],
          [16, 32, 64, "All"]
        ]
      });
    </script>    
    <script>
      $('#dataTable-3').DataTable(
      {
        autoWidth: true,
        "lengthMenu": [
          [16, 32, 64, -1],
          [16, 32, 64, "All"]
        ]
      });
</script>
<script>
    $(document).ready(function() {
        $('.mySelect2').select2();
    });
</script>
<!--  -->
@endpush