@extends('layouts.master')
@section('title')
List PR & PO By Material | MMS
@endsection
@section('konten')

@section('arrow')
<a href="#">List PR & PO By Material</a>
@endsection
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">List PR & PO By Material</h4>
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
                            <th>Part Code</th>
                            <th>Description</th>
                            <th>Last PR</th>
                            <th>Status PR</th>
                            <th>Last PO</th>
                            <th>Status PO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0; ?>
                        @foreach($data as $dt)
                        <tr>
                            <td><?= ++$no ?></td>
                            <td><a href="{{route('historyprpo',$dt->material->id)}}">{{$dt->material->partcode}}</td>
                            <td>{{$dt->material->description}}</td>
                            <td>
                            @if($dt->purchaserequisition_id == '')
                            @else($dt->purchaserequisition_id == '')    
                            <a href="{{ route('detail-pr',$dt->purchaserequisition->id)}}">{{$dt->purchaserequisition->no_pr}}
                            @endif
                            </a></td>
                            <td>
                            @if($dt->purchaserequisition_id == '')
                            @else($dt->purchaserequisition_id == '')
                                {{$dt->purchaserequisition->status}}
                                @endif
                            </td>
                            <td>
                                @if($dt->purchaseorder_id == '')
                                @else($dt->purchaseorder_id == '')
                                <a href="{{ route('detail-po',$dt->purchaseorder->id)}}" style="color: #4a6fff;">
                                    {{$dt->purchaseorder->no_po}}
                                    @endif</a></td>
                            <td>
                            @if($dt->purchaseorder_id == '')
                            @else($dt->purchaseorder_id == '')
                                {{$dt->purchaseorder->status}}
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