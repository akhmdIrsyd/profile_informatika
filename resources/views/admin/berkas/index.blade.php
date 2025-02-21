@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h1 class="m-0 font-weight-bold text-primary">Berkas</h1>
        </div>
        <div class="card-body">
            <!-- Tambah Button -->
            <a href="/tambah_berkas" class="btn btn-primary btn-icon-split">
                <span class="text">Tambah</span>
            </a>

            <div class="table-responsive">
                <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                    <thead>
                        <tr>

                            <th width="5%">File</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Tipe Informasi</th>
                            <th class="text-right" width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>

                            <th>File</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Tipe Informasi</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



@endsection
@section('extrajs')
<!-- Page level plugins -->
<script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>


<script>
    $(document).ready(function() {
        let table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url("/berkas") }}',
            columns: [{
                    data: 'file_berkas',
                    name: 'file_berkas'
                },
                {
                    data: 'judul',
                    name: 'judul'
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'tipeberkas_nama',
                    name: 'tipeberkas_nama'
                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        // Delete item
        $(document).on('click', '.btn-delete', function() {
            if (confirm('Are you sure you want to delete this item?')) {
                var id = $(this).data('id');

                $.ajax({
                    type: 'DELETE',
                    url: '/berkas/' + id,
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        alert('Informasi deleted successfully');

                        // Remove the row from the table
                        table.row($('tr[data-id="' + id + '"]')).remove().draw();
                    },
                    error: function(response) {
                        alert('Failed to delete the item.');
                    }
                });
            }
        });
    });
</script>

@endsection