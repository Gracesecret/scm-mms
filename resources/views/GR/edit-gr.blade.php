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
                                            <td>Qty Retur</td>
                                            <td>Qty Received</td>
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
                                                <input hidden name="materialid[]" id="materialid[]"
                                                value="{{$material->materialprpo->material->id}}">
                                                {{$material->materialprpo->material->partcode}}
                                            </td>
                                            <td>{{$material->materialprpo->material->description}}</td>
                                            <td><input hidden name="qty_retur[]" id="qty_retur[]" value="{{$material->qty_retur}}">
                                                {{$material->qty_retur}}</td>
                                            <td>
                                                <input type="number"  class="form-control" name="qty_received[]" id="qty_received[]" value="">
                                            </td>
                                            <td>{{$material->created_at->format('d M Y')}}</td>
                                            <td>
                                                <select required class="form-control bg-danger text-white" name="status[]">
                                                    <option value="{{$material->materialprpo->status}}">{{$material->materialprpo->status}}</option>
                                                    <option value="Sudah Proses GR">Sudah Proses GR</option>
                                                    <option value="Rejected">Rejected</option>
                                                </select>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <div class="form-group" style="text-align: right;">
                                            <button type="submit" class="btn btn-info" name="simpan" name="simpan">Save</button>
                                        </div>
                                        <div class="form-group mb-3">
                                        <select required class="form-control bg-danger text-white" name="statusgr" id="statusgr">
                                        <option>PLease Fill Status PR</option>
                                        <option value="Complete">Complete</option>
                                        <option value="Returned">Returned</option>
                                        </select>
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