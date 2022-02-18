@extends('layouts.master')
@section('title')
Goods Receipt | MMS
@endsection
@section('konten')

@section('arrow')
<a href="#">Goods Receipt</a>
@endsection

<div class="container">
    <div class="row">
    <h2 class="mb-2 page-title">Goods Receipt</h2>
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
                                    <td>: {{$gr->created_at->format('d-M-Y')}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Goods Receipt No</td>
                                    <td>: {{$gr->no_gr}}</td>
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
                            <form action="{{route('simpaneditgr')}}" method="post">
                                @csrf
                                <input type="hidden" name="gr_id" id="gr_id" value="{{$gr->id}}">
                                <table class="table table-hover table-bordered" id="myUL">
                                    <thead>
                                        <tr>
                                            <td>Part No</td>
                                            <td>Produk</td>
                                            <td>Qty PO</td>
                                            <td>Qty PO Diterima</td>
                                            <td>Qty Bad Cond</td>
                                            <td>Qty Good Cond</td>
                                            <td>Date</td>
                                            <td>Status</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $material)
                                    <tr>
                                            <td>
                                            <input hidden name="grid[]" id="grid[]" value="{{$gr->id}}">
                                                <input hidden name="material_id[]" id="material_id[]"
                                                value="{{$material->materialprpo->id}}">
                                                {{$material->materialprpo->material->partcode}}
                                            </td>
                                            <td>{{$material->materialprpo->material->description}}</td>
                                            <td>{{$material->materialprpo->qty_po}}</td>
                                            <td>{{$material->materialprpo->qty_received}}</td>
                                            <td>{{$material->qty_retur}}</td>
                                            <td>
                                                {{$material->qty_masuk}}
                                            </td>
                                            <td>{{$material->created_at->format('d M Y')}}</td>
                                            <td>
                                                {{$material->materialprpo->status}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <div class="form-group" style="text-align: right;">
                                            <a class="btn btn-info" href="{{route('print-gr',$gr->id)}}">Print</a>
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
@endpush