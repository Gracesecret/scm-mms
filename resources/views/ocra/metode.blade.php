@extends('layouts.master')
@section('title')
Ocra Index | MMS
@endsection
@section('konten')

@section('arrow')
<a href="#">Normalisasi</a>
@endsection
<div class="col-md-12">
    <div class="card">
        <form action="/list-materialkeluar" method="post">
        @csrf
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Metode Ocra</h4>
                <!-- <input type="date" name="from" class="form-control col-md-2 ml-auto" value="{{date('Y-m-d')}}">&nbsp;
                <input type="date" name="to" class="form-control col-md-2" value="{{date('Y-m-d')}}">&nbsp;
                <input type="submit" class="btn btn-info" value="Search"> -->
            </div>
        </div>
        </form>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatables" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>K1</th>
                            <th>K2</th>
                            <th>K3</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Pengiriman</td>
                            <td>Stok Sekarang</td>
                            <td>Harga</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <form action="/list-materialkeluar" method="post">
        @csrf
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Matrix Keputusan</h4>
                <!-- <input type="date" name="from" class="form-control col-md-2 ml-auto" value="{{date('Y-m-d')}}">&nbsp;
                <input type="date" name="to" class="form-control col-md-2" value="{{date('Y-m-d')}}">&nbsp;
                <input type="submit" class="btn btn-info" value="Search"> -->
            </div>
        </div>
        </form>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatables" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Barang</th>
                            <th>K1</th>
                            <th>K2</th>
                            <th>K3</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0; ?>
                        @foreach($data as $material)
                        <tr>
                            <td>{{$material->description}}</td>
                            <td>{{$material->pengiriman}}</td>
                            <td>{{$material->stok_sub}}</td>
                            <td>{{$material->harga}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <form action="/list-materialkeluar" method="post">
        @csrf
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Nilai Maks</h4>
                <!-- <input type="date" name="from" class="form-control col-md-2 ml-auto" value="{{date('Y-m-d')}}">&nbsp;
                <input type="date" name="to" class="form-control col-md-2" value="{{date('Y-m-d')}}">&nbsp;
                <input type="submit" class="btn btn-info" value="Search"> -->
            </div>
        </div>
        </form>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatables" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>K1</th>
                            <th>K2</th>
                            <th>K3</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0; ?>
                        @foreach($max as $maks)
                        <tr>
                            <td>{{$maks->pengiriman}}</td>
                            <td>{{$maks->stok_sub}}</td>
                            <td>{{$maks->harga}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Nilai Min</h4>
                <!-- <input type="date" name="from" class="form-control col-md-2 ml-auto" value="{{date('Y-m-d')}}">&nbsp;
                <input type="date" name="to" class="form-control col-md-2" value="{{date('Y-m-d')}}">&nbsp;
                <input type="submit" class="btn btn-info" value="Search"> -->
            </div>
        </div>
        </form>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatables" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>K1</th>
                            <th>K2</th>
                            <th>K3</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0; ?>
                        @foreach($min as $mins)
                        <tr>
                            <td>{{$mins->pengiriman}}</td>
                            <td>{{$mins->stok_sub}}</td>
                            <td>{{$mins->harga}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <form action="/list-materialkeluar" method="post">
        @csrf
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Nilai Preferensi</h4>
                <!-- <input type="date" name="from" class="form-control col-md-2 ml-auto" value="{{date('Y-m-d')}}">&nbsp;
                <input type="date" name="to" class="form-control col-md-2" value="{{date('Y-m-d')}}">&nbsp;
                <input type="submit" class="btn btn-info" value="Search"> -->
            </div>
        </div>
        </form>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatables" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Barang</th>
                            <th>K1</th>
                            <th>K2</th>
                            <th>K3</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datafinal as $data)
                        <tr>
                            <td>{{$data['desc']}}</td>
                            <td>{{$data['pengiriman']}}</td>
                            <td>{{$data['stok_sub']}}</td>
                            <td>{{$data['harga']}}</td>
                            <td>{{$data['total']}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Nilai Minimum</th>
                        <th>{!!json_encode ($minpref) !!}</th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<link href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css" rel="stylesheet"/>

<script>
$(document).ready(function() {
    $('#datatables').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excel',
        ]
    } );
} );
</script>
<script>
    $(document).ready(function() {
        $('.mySelect2').select2();
    });
</script>
<!--  -->
@endpush