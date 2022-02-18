@extends('layouts.master')
@section('title')
Data Material | MMS
@endsection
@section('konten')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <h2 class="h3 mb-4 page-title">{{$data->partno}}</h2>
            <div class="my-4">
                <form>
                    <div class="row mt-5 align-items-center">
                        <div class="col-md-3 text-center mb-5">
                            <div class="avatar avatar-xl">
                                <img src="{{ asset('./data_file/'.$data->foto)}}" alt="..." style="width: 100%; height: auto;">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="firstname">Part Code</label>
                                    <input type="text" readonly id="firstname" class="form-control" value="{{$data->partcode}}" >
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputZip5">Satuan</label>
                                    <input type="text" class="form-control" readonly id="inputZip5"  value="{{$data->satuan}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lastname">Description</label>
                                    <input type="text" readonly id="lastname" class="form-control" value="{{$data->description}}" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Supplier Agen</label>
                                    <input type="email" class="form-control" value="{{$data->suplier->nama_agen}}" readonly id="inputEmail4" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Supplier CV</label>
                                    <input type="email" class="form-control" value="{{$data->suplier->nama_cv}}" readonly id="inputEmail4" >
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputCompany5">Rate</label>
                                    <input type="text" class="form-control" value="@currency($data->harga)" readonly id="inputCompany5" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputState5">Value Main Store</label>
                                    <input class="form-control" type="text" name="" readonly id="" value="@currency($data->harga*$data->stok_main)" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Stok Main Store</label>
                                        <input type="text" class="form-control" readonly id="inputtext5" value="{{$data->stok_main}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputtext5">Stok Sub Store</label>
                                        <input type="text" class="form-control" readonly id="inputtext5" value="{{$data->stok_sub}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div> <!-- /.card-body -->
        </div> <!-- /.col-12 -->
    </div> <!-- .row -->
</div> <!-- .container-fl readonlyuid -->
@endsection
@push('js')
@endpush