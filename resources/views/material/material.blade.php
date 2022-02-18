@extends('layouts.master')
@section('title')
List Material | MMS
@endsection
@section('konten')

@section('arrow')
<a href="#">List Material</a>
@endsection
@can('isSub')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Data Material</h4>
                <a href="{{route('add-material')}}" class="btn btn-primary btn-round ml-auto">
                    <i class="fa fa-plus"></i>
                    Add Material
                </a>
            </div>
        </div>
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>PartCode</th>
                            <th>Description</th>
                            <th>Satuan</th>
                            <th>Stok Main</th>
                            <th>Stok Sub</th>
                            <th>Min Stok</th>
                            <th>Rate</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0; ?>
                        @foreach($data as $material)
                        <tr>
                            <td><?= ++$no ?></td>
                            <td><a href="{{ route('detail-material',$material->id)}}">{{$material->partcode}}</a></td>
                            <td>{{$material->description}}</td>
                            <td>{{$material->satuan}}</td>
                            <td>{{$material->stok_main}}</td>
                            <td>{{$material->stok_sub}}</td>
                            <td>{{$material->minimal_stok}}</td>
                            <td>@currency($material->harga)</td>
                            <td>
                                <div class="form-button-action">
                                    @can('isMain')
                                    <button type="button" data-toggle="modal" data-target="#editRowModal{{$material->id}}" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Supplier">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    @endcan
                                    <button type="button" class="btn btn-link btn-danger alert_demo_8" data-id="{{$material->id}}">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <a class="btn btn-link btn-danger" href="{{route('view-material-keluar',$material->id)}}">
                                        <i class="fas fa-sign-out-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <!-- Modal Edit -->
                        <div class="modal fade" id="editRowModal{{$material->id}}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                        <form method="POST" action="{{ url('/update-material/'.$material->id) }}">
                                            @csrf
                                            @method('put')
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>PartCode</label>
                                                        <input id="partcode" type="text" class="form-control" value="{{$material->partcode}}" required name="partcode">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Description</label>
                                                        <input id="description" type="text" class="form-control" value="{{$material->description}}" required name="description">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Supplier</label>
                                                        <select class="form-control" id="suplier_id" name="suplier_id">
                                                            <option value="{{$material->suplier->id}}">{{$material->suplier->nama_cv}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Minimal Stok</label>
                                                        <input id="minimal_stok" type="text" class="form-control" value="{{$material->minimal_stok}}" required name="minimal_stok">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Rate</label>
                                                        <input id="harga" type="text" class="form-control" value="{{$material->harga}}" required name="harga">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Satuan</label>
                                                        <select class="form-control" name="satuan" id="suplier">
                                                            <option value="{{$material->satuan}}">{{$material->satuan}}</option>
                                                            <option value="UOM">UOM</option>
                                                            <option value="NOS">NOS</option>
                                                            <option value="LTR">LTR</option>
                                                        </select>
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
@endcan
@can('isMain')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Data Material</h4>
                <a href="{{route('add-material')}}" class="btn btn-primary btn-round ml-auto">
                    <i class="fa fa-plus"></i>
                    Add Material
                </a>
            </div>
        </div>
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables2" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>PartCode</th>
                            <th>Description</th>
                            <th>Satuan</th>
                            <th>Stok Main</th>
                            <th>Stok Sub</th>
                            <th>Rate</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0; ?>
                        @foreach($main as $material)
                        <tr>
                            <td><?= ++$no ?></td>
                            <td><a href="{{ route('detail-material',$material->id)}}">{{$material->partcode}}</a></td>
                            <td>{{$material->description}}</td>
                            <td>{{$material->satuan}}</td>
                            <td>{{$material->stok_main}}</td>
                            <td>{{$material->stok_sub}}</td>
                            <td>@currency($material->harga)</td>
                            <td>
                                <div class="form-button-action">
                                    <button type="button" data-toggle="modal" data-target="#editRowModal{{$material->id}}" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Supplier">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-link btn-danger alert_demo_8" data-id="{{$material->id}}">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    @can('isSub')
                                    <a class="btn btn-link btn-danger" href="{{route('view-material-keluar',$material->id)}}">
                                        <i class="fas fa-sign-out-alt"></i>
                                    </a>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        <!-- Modal Edit -->
                        <div class="modal fade" id="editRowModal{{$material->id}}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                        <form method="POST" action="{{ url('/update-material/'.$material->id) }}">
                                            @csrf
                                            @method('put')
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>PartCode</label>
                                                        <input id="partcode" type="text" class="form-control" value="{{$material->partcode}}" required name="partcode">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Description</label>
                                                        <input id="description" type="text" class="form-control" value="{{$material->description}}" required name="description">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Supplier</label>
                                                        <select class="form-control" id="suplier_id" name="suplier_id">
                                                            <option value="{{$material->suplier->id}}">{{$material->suplier->nama_cv}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Minimal Stok</label>
                                                        <input id="minimal_stok" type="text" class="form-control" value="{{$material->minimal_stok}}" required name="minimal_stok">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Rate</label>
                                                        <input id="harga" type="text" class="form-control" value="{{$material->harga}}" required name="harga">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Satuan</label>
                                                        <select class="form-control" name="satuan" id="suplier">
                                                            <option value="{{$material->satuan}}">{{$material->satuan}}</option>
                                                            <option value="UOM">UOM</option>
                                                            <option value="NOS">NOS</option>
                                                            <option value="LTR">LTR</option>
                                                        </select>
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
@endcan
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
        $('#basic-datatables2').DataTable({});

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
                        window.location = "/hapus-material/" + materialid + ""
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