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
                <a class="nav-link active bg-transparent pr-2 pl-0 text-primary" href="">All<span class="bg-white text-muted ml-2">
                        {{$badge->count()}}
                    </span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-muted px-2" href="{{route('approved-mr')}}">Released <span class="bg-white border text-muted ml-2">
                        {{$badge->where('status','=','released')->count()}}
                    </span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-muted px-2" href="{{route('pending-mr')}}">Pending<span class="bg-white border text-muted ml-2">
                        {{$badge->where('status','=','pending')->count()}}
                    </span></a>
            </li>
        </ul>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">List MR</h4>
                @can('isSub')
                <a href="{{route('formadd-mr')}}" class="btn btn-primary btn-round ml-auto">
                    <i class="fa fa-plus"></i>
                    Add MR
                </a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables2" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NO MR</th>
                            <th>Status</th>
                            <th>Requested by</th>
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
                            <td>{{$mr->dept->departement}}</td>
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
    });
</script>
<script>
    $(document).ready(function() {
        $('#basic-datatables2').DataTable({});
    });
</script>
<script>
    //== Class definition
    var SweetAlert2Demo = function() {

        //== Demos
        var initDemos = function() {
            $('.alert_demo_8').click(function(e) {
                var materialid = $(this).attr('data-id');
                swal({
                    title: 'Are you sure want?',
                    text: "Anda yakin ingin menghapus data ini?",
                    type: 'warning',
                    buttons: {
                        cancel: {
                            visible: true,
                            text: 'No, cancel!',
                            className: 'btn btn-success'
                        },
                        confirm: {
                            text: 'Yes, delete it!',
                            className: 'btn btn-danger'
                        }
                    }
                }).then((willDelete) => {
                    if (willDelete) {
                        window.location = "/hapus-mr/" + materialid + ""
                        swal("Data Berhasil dihapus!", {
                            icon: "success",
                            buttons: {
                                confirm: {
                                    className: 'btn btn-success'
                                }
                            }
                        });
                    } else {
                        swal("Data Tidak Dihapus!", {
                            buttons: {
                                confirm: {
                                    className: 'btn btn-success'
                                }
                            }
                        });
                    }
                });
            })

        };

        return {
            //== Init
            init: function() {
                initDemos();
            },
        };
    }();

    //== Class Initialization
    jQuery(document).ready(function() {
        SweetAlert2Demo.init();
    });
</script>

<script>
    $(document).ready(function() {
        $('.mySelect2').select2();
    });
</script>
<!--  -->
@endpush