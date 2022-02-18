@extends('layouts.master')
@section('title')
List Material Keluar | MMS
@endsection
@section('konten')

@section('arrow')
<a href="#">History Material Keluar</a>
@endsection
<div class="col-md-7 mb-2">
    <strong>{{$data->partcode}} - </strong>
    <strong>{{$data->description}}</strong>
</div>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">History Material Keluar</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pengambil</th>
                            <th>QTY</th>
                            <th>Tanggal Keluar</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Grand Total</td>
                        <td>@currency($sumtotal)</td>
                    </tfoot>
                    <tbody>
                        <?php $no = 0; ?>
                        @foreach($data2 as $material)
                        <tr>
                            <td><?= ++$no ?></td>
                            <td>{{$material->nama}}</td>
                            <td>{{$material->qty}}</td>
                            <td>{{$material->tanggal}}</td>
                            <td>@currency($material->sub_total)</td>
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
<script>
    $(document).ready(function() {
        $('#basic-datatables').DataTable({});

        $('#multi-filter-select').DataTable({
            "pageLength": 5,
            initComplete: function() {
                this.api().columns().every(function() {
                    var column = this;
                    var select = $('<select class="form-control"><option value=""></option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });

                    column.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            }
        });

    });
</script>
<script>
    $(document).ready(function() {
        $('.mySelect2').select2();
    });
</script>
<!--  -->
@endpush