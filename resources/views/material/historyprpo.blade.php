@extends('layouts.master')
@section('title')
History PR PO | MMS
@endsection
@section('dashboard1')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        </div>
    </div>
</div>
@endsection
@section('dashboard2')
<div class="page-inner mt--5">
    <div class="row mt--2">
        <div class="col-md-6">
            <div class="card full-height">
                <div class="card-body">
                    <div class="card-title">History PR</div>
                    <div class="row py-3">
                        <table class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                <th>No PR</th>
                                <th>Date</th>
                                <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datapr as $pr)
                                <tr>
                                <td><a href="{{route('detail-pr',$pr->purchaserequisition->id)}}">{{$pr->purchaserequisition->no_pr}}</a></td>
                                <td>{{$pr->purchaserequisition->created_at->format('d-M-Y')}}</td>
                                <td>{{$pr->purchaserequisition->status}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card full-height">
                <div class="card-body">
                    <div class="card-title">History PO</div>
                    <div class="row py-3">
                        <table class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                <th>No PO</th>
                                <th>Date</th>
                                <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datapo as $po)
                                <tr>
                                <td><a href="{{route('detail-po',$po->purchaseorder->id)}}">{{$po->purchaseorder->no_po}}</a></td>
                                <td>{{$po->purchaseorder->created_at->format('d-M-Y')}}</td>
                                <td>{{$po->purchaseorder->status}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
@endpush