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
                                    <td>: {{$po->created_at->format('d-M-Y')}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Purchase Order No</td>
                                    <td>: {{$po->no_po}}</td>
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
                            <form action="{{route('simpanprosespo')}}" method="post">
                                @csrf
                                <input type="hidden" name="po_id" id="po_id" value="{{$po->id}}">
                                <table class="table table-hover table-bordered" id="myUL">
                                    <thead>
                                        <tr>
                                            <td>Part Code</td>
                                            <td>Description</td>
                                            <td>Qty Requested</td>
                                            <td>Last Received</td>
                                            <td>Qty Pending</td>
                                            <td>Qty Received</td>
                                            <td>Status</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $material)
                                    <tr>
                                            <td>
                                                <input hidden name="material_id[]" id="material_id[]"
                                                value="{{$material->id}}">
                                                <input hidden name="materialid[]" id="materialid[]"
                                                value="{{$material->material->id}}">
                                                {{$material->material->partcode}}
                                            </td>
                                            <td>{{$material->material->description}}</td>
                                            <td><input hidden name="qtypo[]" id="qtypo[]"
                                                value="{{$material->qty_po}}">
                                                {{$material->qty_po}}</td>
                                            <td>
                                                {{$material->qty_received}}</td>
                                            <td>
                                                {{$material->qty_po - $material->qty_received}}</td>
                                            <td>
                                            <input hidden name="qtysementara[]" id="qtysementara[]"
                                                value="{{$material->qty_received}}">
                                                <input type="number"  class="form-control" name="qty_rec[]" id="qty_rec[]" value="">
                                            </td>
                                            <td>
                                                <select required class="form-control bg-danger text-white" name="status[]">
                                                    <option value="{{$material->status}}">{{$material->status}}</option>
                                                    <option value="Received">Received</option>
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
                                        <select required class="form-control bg-danger text-white" name="statuspr" id="statuspr">
                                        <option value="{{$po->status}}">{{$po->status}}</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Some item returned">Some item returned</option>
                                        <option value="Rejected">Rejected</option>
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