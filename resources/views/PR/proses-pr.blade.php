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
                            <form action="{{route('simpanprosespr')}}" method="post">
                                @csrf
                                <input type="hidden" name="pr_id" id="pr_id" value="{{$pr->id}}">
                                <table class="table table-hover table-bordered" id="myUL">
                                    <thead>
                                        <tr>
                                            <td>Part No</td>
                                            <td>Produk</td>
                                            <td>Qty Main</td>
                                            <td>Qty Requested</td>
                                            <td>Qty Approved</td>
                                            <td>Rate</td>
                                            <td>Status</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $material)
                                    <tr>
                                            <td>
                                                <input hidden name="material_id[]" id="material_id[]"
                                                value="{{$material->id}}">
                                                {{$material->material->partcode}}
                                            </td>
                                            <td>{{$material->material->description}}</td>
                                            <td>{{$material->material->stok_main}}</td>
                                            <td>{{$material->qty_pr}}</td>
                                            <td>
                                                <input type="number"  class="form-control" name="qty_po[]" id="qty_po[]" value="">
                                            </td>
                                            <td>{{$material->material->harga}}</td>
                                            <td>
                                                <select required class="form-control bg-danger text-white" name="status[]">
                                                    <option>Fill Status Material</option>
                                                    <option value="Approved">Approved</option>
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
                                        <option>PLease Fill Status PR</option>
                                        <option value="Approved For PO">Approved</option>
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
@include('sweetalert::alert')
@endpush