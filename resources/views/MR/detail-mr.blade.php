@extends('layouts.master')
@section('title')
Material Requisition | MMS
@endsection
@section('konten')

@section('arrow')
<a href="#">Material Requisition</a>
@endsection

<div class="container">
    <div class="row">
    <h2 class="mb-2 page-title">Material Requisition</h2>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="text-center">
                                <img src="{{ asset('assets/img/logo.svg')}}" alt="" width="150px" height="150px">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td width="30%">Date</td>
                                    <td>: {{$mr->created_at->format('d-M-Y')}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Material Requisition No</td>
                                    <td>: {{$mr->no_mr}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Warehouse</td>
                                    <td>: Main Store</td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-12 mt-3">
                                <table class="table table-hover table-bordered" id="myUL">
                                    <thead>
                                        <tr>
                                            <td>Part Code</td>
                                            <td>Description</td>
                                            <td>Qty MR</td>
                                            <td>Qty Released</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $material)
                                    <tr>
                                            <td>{{$material->material->partcode}}</td>
                                            <td>{{$material->material->description}}</td>
                                            <td>{{$material->qty_req}}</td>
                                            <td>{{$material->qty_approve}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <div class="form-group" style="text-align: right;">
                                            <a href="{{route('mr.print',$mr->id)}}" class="btn btn-info" name="simpan" name="simpan">Print</a>
                                        </div>
                                    </tfoot>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
<script>
    //== Class definition
    var SweetAlert2Demo = function() {

        //== Demos
        var initDemos = function() {
            $('.alert_demo_8').click(function(e) {
                var pr_id = $(this).attr('data-id');
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
                        window.location = "/hapus-pr/" + pr_id + ""
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