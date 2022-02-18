@extends('layouts.master')
@section('title')
Tambah Material | MMS
@endsection
@section('konten')
@section('arrow')
<a href="{{route('list-material')}}">List Material</a>
@endsection
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
                            <form action="{{ route('create-material') }}" class="btn-submit" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-9">
                                        <h3>Add Material Form</h3>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group  col-md-3">
                                        <label>Part Code</label>
                                        <input type="text" name="partcode" class="form-control @error('partcode') is-invalid @enderror" id="partcode" value="">
                                        @error('partcode')
                                        <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-9">
                                        <label>Description</label>
                                        <input class="form-control @error('description') is-invalid @enderror" name="description" id="description" type="text" value="">
                                        @error('description')
                                        <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Supplier</label>
                                    <select class="form-control select2" name="suplier_id" id="suplier">
                                        <option>- - Select - -</option>
                                        @foreach($suplier as $sup)
                                        <option value="{{$sup->id}}">{{$sup->nama_cv}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                    <label>Satuan</label>
                                    <select class="form-control" name="satuan" id="suplier">
                                        <option>- - Select - -</option>
                                        <option value="UOM">UOM</option>
                                        <option value="NOS">NOS</option>
                                        <option value="LTR">LTR</option>
                                    </select>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label for="custom-zip">Harga</label>
                                        <input class="form-control input" type="number" id="harga" name="harga" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="custom-zip">Stok</label>
                                        <input class="form-control input" type="number" id="stok_main" name="stok_main" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="custom-zip">Minimal Stok</label>
                                        <input class="form-control input" type="number" id="minimal_stok" name="minimal_stok" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                    <label for="customFile">Insert Picture</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="file" id="file"  value="upload">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    </div>
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

@endsection
@push('js')
    <script src='{{ asset('js/select2.min.js')}}'>
    </script>
            <script>
                $('.select2').select2({
                    theme: 'bootstrap4',
                });
                $('.sltc').select2({
                    multiple: true,
                    theme: 'bootstrap4',
                });
            </script>
@include('sweetalert::alert')
@endpush