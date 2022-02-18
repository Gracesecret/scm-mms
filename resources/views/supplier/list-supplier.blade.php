@extends('layouts.master')
@section('title')
List Supplier | MMS
@endsection
@section('konten')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Data Supplier</h4>
                <a href="{{route('add-supplier')}}" 
                class="btn btn-primary btn-round ml-auto">
                    <i class="fa fa-plus"></i>
                    Add Supplier
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
                            <th>Nama CV</th>
                            <th>Nama Agen</th>
                            <th>Alamat</th>
                            <th>E-mail</th>
                            <th>Telp CV</th>
                            <th>Telp Agen</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=0; ?>
                        @foreach($data as $supplier)
                        <tr>
                            <td><?= ++$no ?></td>
                            <td>{{$supplier->nama_cv}}</td>
                            <td>{{$supplier->nama_agen}}</td>
                            <td>{{$supplier->alamat}}</td>
                            <td>{{$supplier->email}}</td>
                            <td>{{$supplier->telp}}</td>
                            <td>{{$supplier->telp_agen}}</td>
                            <td>
                                <div class="form-button-action">
                                    <button type="button" data-toggle="modal" data-target="#editRowModal{{$supplier->id}}" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Supplier">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-link btn-danger alert_demo_8" data-id="{{$supplier->id}}">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- Modal Edit -->
                        <div class="modal fade" id="editRowModal{{$supplier->id}}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                        <form method="POST" action="{{ url('/update-supplier/'.$supplier->id) }}">
                                            @csrf
                                            @method('put')
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Nama CV</label>
                                                        <input id="nama_cv" type="text" class="form-control" value="{{$supplier->nama_cv}}" required name="nama_cv">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Nama Agen</label>
                                                        <input id="nama_agen" type="text" class="form-control" value="{{$supplier->nama_agen}}" required name="nama_agen">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Alamat</label>
                                                        <input id="alamat" type="text" class="form-control" value="{{$supplier->alamat}}" required name="alamat">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Telp Agen</label>
                                                        <input id="telp_agen" type="text" class="form-control" value="{{$supplier->telp_agen}}" required name="telp_agen">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Telp CV</label>
                                                        <input id="telp" type="text" class="form-control" value="{{$supplier->telp}}" required name="telp">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>E-mail CV</label>
                                                        <input id="email" type="e-mail" class="form-control" value="{{$supplier->email}}" required name="email">
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
<script>
		//== Class definition
		var SweetAlert2Demo = function() {

			//== Demos
			var initDemos = function() {
				$('.alert_demo_8').click(function(e) {
                var suplierid = $(this).attr('data-id');
					swal({
						title: 'Are you sure want?',
						text: "Anda yakin ingin menghapus data ini?",
						type: 'warning',
						buttons:{
							cancel: {
								visible: true,
								text : 'No, cancel!',
								className: 'btn btn-success'
							},        			
							confirm: {
								text : 'Yes, delete it!',
								className : 'btn btn-danger'
							}
						}
					}).then((willDelete) => {
						if (willDelete) {
                            window.location = "/hapus-supplier/"+suplierid+""
							swal("Data Berhasil dihapus!", {
								icon: "success",
								buttons : {
									confirm : {
										className: 'btn btn-success'
									}
								}
							});
						} else {
							swal("Data Tidak Dihapus!", {
								buttons : {
									confirm : {
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