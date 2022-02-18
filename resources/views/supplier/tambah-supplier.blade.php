@extends('layouts.master')
@section('title')
Tambah Supplier | MMS
@endsection
@section('konten')
<div class="col-md-12">
    <div class="card">
        <form method="POST" action="{{ route('create-supplier') }}">
            @csrf
            <div class="card-header">
                <div class="card-title">Tambah Supplier</div>
            </div>
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="card-body">
                <div class="col-sm-12">
                    <div class="form-group form-group-default">
                        <label>Nama Agen</label>
                        <input id="nama_agen" type="text" class="form-control" required name="nama_agen">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group form-group-default">
                        <label>Nama CV</label>
                        <input id="nama_cv" type="text" class="form-control" required name="nama_cv">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group form-group-default">
                        <label>Alamat</label>
                        <input id="alamat" type="text" class="form-control" required name="alamat">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group form-group-default">
                        <label>Telp Agen</label>
                        <input id="telp_agen" type="text" class="form-control" required name="telp_agen">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group form-group-default">
                        <label>Telp CV</label>
                        <input id="telp" type="text" class="form-control" required name="telp">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group form-group-default">
                        <label>E-mail CV</label>
                        <input id="email" type="e-mail" class="form-control" required name="email">
                    </div>
                </div>
            </div>
            <div class="card-action">
                <button class="btn btn-success" type="submit">Submit</button>
                <button class="btn btn-danger">Cancel</button>
            </div>
        </form>
    </div>
</div>
@endsection
@push('js')
@include('sweetalert::alert')
@endpush