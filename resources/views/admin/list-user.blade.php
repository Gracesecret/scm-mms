@extends('layouts.master')
@section('title')
List User | MMS
@endsection
@section('konten')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Data User</h4>
                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                    <i class="fa fa-plus"></i>
                    Add User
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Password</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $user)
                        <tr>
                            <td>{{$user->username}}</td>
                            <td>{{$user->role}}</td>
                            <td>{{$user->password}}</td>
                            <td>
                                <button type="button" class="btn btn-link btn-danger alert_demo_8" data-id="{{$user->id}}">
                                    <i class="fa fa-times"></i>
                                </button>
                                <button type="button" data-toggle="modal" data-target="#editRowModal{{$user->id}}" class="btn btn-link btn-primary btn-lg">
                                        <i class="fas fa-sign-out-alt"> Edit</i>
                                    </button>
                            </td>
                        </tr>
                        <!-- MODAL -->
                        <div class="modal fade" id="editRowModal{{$user->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header no-bd">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">
                                                New</span>
                                            <span class="fw-mediumbold">
                                                Dept
                                            </span>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('edit-user',$user->id) }}">
                                            @csrf
                                            @method('put')
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Kode</label>
                                                        <input id="username" type="text" class="form-control" 
                                                        value="{{$user->username}}" required name="username">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <input type="text" required class="form-control" 
                                                        name="password" id="password" value="{{$user->password}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Departement</label>
                                                        <select class="form-control form-control" id="dept" name="dept">
                                                            <option value="{{$user->dept->id}}">{{$user->dept->departement}}</option>
                                                            <option value="MKI2MECH">MKI 2 Mech</option>
                                                            <option value="SPINNING4MECH">Spinning 4 Mech</option>
                                                            <option value="MAINSTORE">MAIN STORE</option>
                                                            <option value="MANAGER">MANAGER</option>
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
<!-- MODAL -->
<div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        New</span>
                    <span class="fw-mediumbold">
                        User
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('regist-user') }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Name</label>
                                <input id="username" type="text" class="form-control" placeholder="fill username" required name="username">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Role</label>
                                <select class="form-control form-control" id="role" name="role">
                                    <option>Select</option>
                                    <option value="admin">Admin</option>
                                    <option value="mainstore">Main Store</option>
                                    <option value="substore">Sub Store</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Departement</label>
                                <select class="form-control form-control" id="dept" name="dept">
                                    @foreach($dept as $d)
                                    <option value="{{$d->id}}">{{$d->departement}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Password</label>
                                <input id="password" name="password" type="text" class="form-control" placeholder="fill password">
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
    //== Class definition
    var SweetAlert2Demo = function() {

        //== Demos
        var initDemos = function() {
            $('.alert_demo_8').click(function(e) {
                var userid = $(this).attr('data-id');
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
                        window.location = "/hapus-user/" + userid + ""
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
@endpush