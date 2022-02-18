@extends('layouts.master')
@section('title')
Material Requisition | MMS
@endsection
@section('konten')

@section('arrow')
<a href="#">Material Requisition</a>
@endsection

<div class="container">
    <div class="row">
    <h2 class="mb-2 page-title">Material Requisition</h2>
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
                                    <td>: <?php
                                            echo "" . date("d-M-Y") . "<br>";
                                            ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Requested By</td>
                                    <td>: {{auth()->user()->username}}</td>
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
                            <form action="{{route('simpanedit-mr')}}" method="post">
                                @csrf
                                <table class="table table-hover table-bordered" id="myUL">
                                    <thead>
                                        <tr>
                                            <td>Part Code</td>
                                            <td>Description</td>
                                            <td>Qty Requested</td>
                                            <td>Qty Approved</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $material)                
                                        <tr>
                                            <input type="hidden" name="id_mr" id="id_mr" value="{{$mr->id}}">
                                            <input type="hidden" name="user_id[]" id="user_id[]" value="{{$mr->dept_id}}">
                                            <input type="hidden" name="material_id[]" id="material_id[]" value="{{$material->material->id}}">
                                            <input type="hidden" name="material_mr[]" id="material_mr[]" value="{{$material->id}}">
                                            <td>{{$material->material->partcode}}</td>
                                            <td>{{$material->material->description}}</td>
                                            <td>{{$material->qty_req}}</td>
                                            <td colspan="3">
                                            <input class="form-control" type="number" name="qty_approve[]" id="qty_approve[]" value="">
                                            </td>
                                        </tr>
                                        @endforeach
                                        <div class="form-group" style="text-align: right;">
                                            <button type="submit" class="btn btn-info" name="simpan" name="simpan">Save</button>
                                        </div>
                                    </tbody>
                                    <tfoot>
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
<script src='{{ asset('js/select2.min.js')}}'></script>
<script>
    $('.select2').select2({
    });
    $('.sltc').select2({
    });
</script>
<script type="text/javascript">
    $("#sbmit").click(function(e) {

        e.preventDefault(); 
        var no = 1;
        var i_additem = $("#myUL tbody tr").length;
        var desc = $('#valtabel').val();
        var partno = $('#code').val();
        var price = $('#discount').val();
        var qtyreq = $('#qty_req').val();
        var batal = $('#btl').val();
        var user_id = $("input[name=user_id]").val();
        var status_id = $("input[name=status_id]").val();
        var mr = $("input[name=no_mr]").val();
        var barang_id = $("select[name=package]").val();
        var row = '<tr id="dtl1"><input type="hidden" name="mr[]" id="mr" value=""><input type="hidden" name="status[]" id="status' + status_id + '" value="' + status_id + '"><input type="hidden" name="barangid[]" id="barangid' + barang_id + '" value="' + barang_id + '"><input type="hidden" name="nomr[]" id="nomr' + mr + '" value="' + mr + '"><input type="hidden" name="userid[]" id="userid' + user_id + '" value="' + user_id + '"><td><input type="hidden" name="partno[]" id="partno' + partno + '" value="' + partno + '"><span id="partno' + i_additem + '">' + partno + '</span></td><td><input type="hidden" name="description[]" id="description' + desc + '" value="' + desc + '"><span id="unit' + i_additem + '">' + desc + '</span></td><td><input type="hidden" name="harga[]" id="harga' + price + '" value="' + price + '"><span id="stok' + i_additem + '">' + price + '</span></td><td><input type="hidden" name="qtyreq[]" id="qtyreq' + qtyreq + '" value="' + qtyreq + '"><span id="qty' + i_additem + '">' + qtyreq + '</span></td><td><center><button type="button" class="btn btn-danger btn-sm" onclick="deleteRow_item(' + no + ',\'' + desc + '\')">Delete<i class="fa fa-close"></i></button></center></td></tr>';
        console.log(row);
        $('#myUL tbody tr:last').after(row);
        $('#code').val('');
        $('#valtabel').val('');
        $('#discount').val('');
        $("select[name=package]").val('');
        $('#qty_req').val('');

        i_additem++;
        no++;
    });
    //-------script hapus--------//
    function deleteRow_item(data, data2, data3, data4) {
        if (confirm('Are you sure want to cancel this ' + data2 + '?')) {
            $('#dtl' + data).remove();
        };
    }
</script>
<script>
    $('#package').on('change', function() {
        // ambil data dari elemen option yang dipilih
        const discount = $('#package option:selected').data('discount');
        const code = $('#package option:selected').data('code');
        const valtabel = $('#package option:selected').data('valtabel');

        // kalkulasi total harga

        // tampilkan data ke element
        $('[name=discount]').val(discount);
        $('[name=code]').val(code);
        $('[name=valtabel]').val(valtabel);

    });
</script>
@endpush