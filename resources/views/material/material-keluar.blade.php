@extends('layouts.master')
@section('title')
Material Keluar | MMS
@endsection
@section('konten')
@section('arrow')
<a href="{{route('list-material')}}">List Material</a>
@endsection
<div class="col">
    <div class="card shadow mb-4">
        <div class="card-header bg-info">
            <strong class="text-white">{{$data->partcode}}</strong>
            <strong class="text-white">{{$data->description}}</strong>
        </div>
        <div class="card-body bg-primary">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="container-fluid">
                            <div class="row justify-content-center">
                                <div class="col-12 col-xl-10">
                                    <div class="row align-items-center my-4">
                                        <div class="col">
                                            <h2 class="h3 mb-0 page-title"></h2>
                                        </div>
                                    </div>
                                    <form id="formD" name="formD" action="{{ route('material-keluar') }}" class="btn-submit" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="material_id" value="{{$data->id}}">
                                        <input type="hidden" name="harga" value="{{$data->harga}}">
                                        <div class="form-row">
                                            <div class="form-group col-md-9">
                                                <h3 class="text-white">Material Keluar</h3>
                                            </div>
                                        </div>

                                        <div class="form-row mb-3">
                                            <div class="form-group col-md-9">
                                                <label class="text-white">Nama Pengambil</label>
                                                <input type="text" name="nama" class="form-control @error('partcode') is-invalid @enderror" id="nama" value="">
                                                @error('partcode')
                                                <div class="alert alert-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="text-white">Tanggal keluar</label>
                                                <input class="form-control @error('description') is-invalid @enderror" name="tanggal" id="tanggal" type="date" value="{{date('Y-m-d')}}">
                                                @error('description')
                                                <div class="alert alert-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-white">Stok</label>
                                            <input class="form-control" type="text" readonly name="stok" onkeyup="OnChange(this.value)" 
                                            onKeyPress="return isNumberKey(event)" value="{{ $data->stok_sub }}"><br>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-white">Jumlah Keluar</label>
                                            <input class="form-control" type="text" name="jumlah" onkeyup="OnChange(this.value)" onKeyPress="return isNumberKey(event)">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-white">Sisa</label>
                                            <input class="form-control" type="text" name="txtDisplay" value="" readonly="readonly">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="validationTextarea1" class="text-white">Note</label>
                                            <textarea class="form-control" name="note" id="note" name="note" placeholder="Take a note here" rows="3"></textarea>
                                            <div class="invalid-feedback"> Please enter a message in the textarea. </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-success" name="sbmit" id="sbmit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
<script type="text/javascript" language="Javascript">
   qty = document.formD.stok.value;
   document.formD.txtDisplay.value = qty;
   jml = document.formD.jumlah.value;
   document.formD.txtDisplay.value = jml;
   function OnChange(value){
     qty = document.formD.stok.value;
     jml = document.formD.jumlah.value;
     total = qty - jml;
     document.formD.txtDisplay.value = total;
   }
 </script>
@include('sweetalert::alert')
@endpush