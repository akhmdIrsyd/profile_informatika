@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h1 class="m-0 font-weight-bold text-primary">Gambar Website</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Gambar</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama</th>
                            <th>Gambar</th>
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

@extends('admin.webgambar.add')

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
            ajax: '{{ url("/webgambar") }}',
            columns: [{
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'file',
                    name: 'file',
                    orderable: false,
                    searchable: false
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


            $('#itemId').val(itemId);
            $('#nama').val(nama);
            // Menampilkan tautan file jika ada
            var gambar1 = $(this).closest('tr').find('td:eq(1) img').attr('src');
            var gambar = gambar1.substring(gambar1.lastIndexOf('/') + 1);
            console.log(gambar)
        });

        // Menyimpan item (Tambah/Edit)
        $('#saveItem').click(function() {
            var formData = new FormData($('#itemForm')[0]); // Membuat objek FormData untuk mengirim data formulir, termasuk file
            $.ajax({

                type: 'POST',
                url: '/webgambar',
                data: formData, // Menggunakan objek FormData untuk mengirim data formulir
                contentType: false, // Tidak mengatur tipe konten secara otomatis
                processData: false, // Tidak memproses data secara otomatis
                success: function(response) {
                    $('#itemModal').modal('hide');
                    table.ajax.reload();
                }
            });
        });


    });
</script>
@endsection