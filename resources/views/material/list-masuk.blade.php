@extends('layouts.master')
@section('title')
List Material Masuk | MMS
@endsection
@section('konten')

@section('arrow')
<a href="#">List Material Keluar</a>
@endsection
<div class="col-md-12">
    <div class="card">
    <form action="/list-materialmasuk" method="post">
        @csrf
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">List Material Masuk</h4>
                <input type="date" name="from" class="form-control col-md-2 ml-auto" value="{{date('Y-m-d')}}">&nbsp;
                <input type="date" name="to" class="form-control col-md-2" value="{{date('Y-m-d')}}">&nbsp;
                <input type="submit" class="btn btn-info" value="Search">
            </div>
        </div>
        </form>

        <div class="card-body">
            <div class="table-responsive">
                <table id="datatables" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>PartCode</th>
                            <th>Description</th>
                            <th>QTY</th>
                            <th>Tanggal Masuk</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0; ?>
                        @foreach($data as $material)
                        <tr>
                            <td><?= ++$no ?></td>
                            <td>{{$material->material->partcode}}</td>
                            <td>{{$material->material->description}}</td>
                            <td>{{$material->qty}}</td>
                            <td>{{$material->created_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
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