@extends('layouts.master')
@section('title')
Material Under Minimal Stok | MMS
@endsection
@section('konten')

@section('arrow')
<a href="#">Material Under Minimal Stok</a>
@endsection
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Material Under Minimal Stok</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>PartCode</th>
                            <th>Description</th>
                            <th>Stok Main</th>
                            <th>Stok Sub</th>
                            <th>Minimal Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0; ?>
                        @foreach($data as $material)
                        <tr>
                            <td><?= ++$no ?></td>
                            <td>{{$material->partcode}}</td>
                            <td>{{$material->description}}</td>
                            <td>{{$material->stok_main}}</td>
                            <td>{{$material->stok_sub}}</td>
                            <td>{{$material->minimal_stok}}</td>
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