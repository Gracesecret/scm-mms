@extends('layouts.master')
@section('title')
Purchase Requisition | MMS
@endsection
@section('konten')

@section('arrow')
<a href="#">Purchase Requisition</a>
@endsection

<div class="container">
    <div class="row">
    <h2 class="mb-2 page-title">Purchase Requisition</h2>
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
                                    <td>: {{$pr->created_at->format('d-M-Y')}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Purchase Requisition No</td>
                                    <td>: {{$pr->no_pr}}</td>
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
                            <form action="{{route('create-pr')}}" method="post">
                                @csrf
                                <table class="table table-hover table-bordered" id="myUL">
                                    <thead>
                                        <tr>
                                            <td>Part No</td>
                                            <td>Produk</td>
                                            <td>Qty Main</td>
                                            <td>Qty Requested</td>
                                            <td>Qty Approved</td>
                                            <td>Rate</td>
                                            <td>Sub Total PR</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $material)
                                    <tr>
                                            <td>{{$material->material->partcode}}</td>
                                            <td>{{$material->material->description}}</td>
                                            <td>{{$material->material->stok_main}}</td>
                                            <td>{{$material->qty_pr}}</td>
                                            <td>{{$material->qty_po}}</td>
                                            <td>@currency($material->material->harga)</td>
                                            <td>@currency($material->val_pr)</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><strong> Grand Total </strong></td>
                                            <td><strong>@currency($rate)</strong></td>
                                        </tr>
                                    </tfoot>
                                    <tfoot>
                                        <div class="form-group" style="text-align: right;">
                                            <a href="{{route('pr.print',$pr->id)}}" class="btn btn-info" name="simpan" name="simpan">Print</a>
                                            @if ($pr->status == 'pending')
                                            <a class="btn btn-danger alert_demo_8 text-white" data-id="{{$pr->id}}">Delete</a>
                                            @endif
                                        </div>
                                    </tfoot>
                                </table>
                            </form>
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