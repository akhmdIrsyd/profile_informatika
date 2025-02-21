@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <button class="btn btn-primary" id="addNewItem">Tambah</button>
            <div class="table-responsive">
                <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama</th>
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

@extends('admin.tipe_berkas.add')

@endsection
@section('extrajs')
<!-- Page level plugins -->
<script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>

<script>
    // Script untuk menangani modal
    $(document).ready(function() {
        let table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url("/tipe_berkas") }}',
            columns: [{
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        // Menampilkan modal untuk menambah item baru
        $('#addNewItem').click(function() {
            $('#itemModal').modal('show');
            $('#itemForm')[0].reset();
        });

        // Menampilkan modal untuk mengedit item
        $(document).on('click', '.btn-edit', function() {
            $('#itemModal').modal('show');
            // Mengisi nilai input dengan data dari tombol yang diklik
            var itemId = $(this).data('id');
            var nama = $(this).closest('tr').find('td:eq(0)').text(); // Mendapatkan nilai kolom pertama 

            console.log(nama)
            $('#itemId').val(itemId);
            $('#nama').val(nama);


        });

        // Menyimpan item (Tambah/Edit)
        $('#saveItem').click(function() {
            var formData = new FormData($('#itemForm')[0]); // Membuat objek FormData untuk mengirim data formulir, termasuk file
            $.ajax({

                type: 'POST',
                url: '/tipe_berkas',
                data: formData, // Menggunakan objek FormData untuk mengirim data formulir
                contentType: false, // Tidak mengatur tipe konten secara otomatis
                processData: false, // Tidak memproses data secara otomatis
                success: function(response) {
                    $('#itemModal').modal('hide');
                    table.ajax.reload();
                }
            });
        });

        // Menghapus item
        $(document).on('click', '.btn-delete', function() {
            if (confirm('Are you sure you want to delete this item?')) {
                $.ajax({
                    type: 'DELETE',
                    url: '/tipe_berkas/' + $(this).data('id'),
                    data: $('#itemForm').serialize(),
                    success: function(response) {
                        $('#itemModal').modal('hide');
                        table.ajax.reload();
                    }
                });
            }
        });
    });
</script>
@endsection