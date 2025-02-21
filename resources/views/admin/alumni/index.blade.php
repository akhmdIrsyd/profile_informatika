@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h1 class="m-0 font-weight-bold text-primary">Alumni</h1>
        </div>
        <div class="card-body">
            <button class="btn btn-primary" id="addNewItem">Tambah</button>
            <div class="table-responsive">
                <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>tahun</th>
                            <th>Peminat</th>
                            <th>Masuk</th>
                            <th>Lulus</th>
                            <th width="15%" class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>tahun</th>
                            <th>Peminat</th>
                            <th>Masuk</th>
                            <th>Lulus</th>
                            <th width="15%" class="text-right">Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@extends('admin.alumni.add')

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
            ajax: '{{ url("/alumni") }}',
            columns: [{
                    data: 'tahun',
                    name: 'tahun'
                },
                {
                    data: 'jml_peminat',
                    name: 'jml_peminat'
                },
                {
                    data: 'juml_masuk',
                    name: 'juml_masuk'
                },
                {
                    data: 'juml_lulus',
                    name: 'juml_lulus'
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
            var tahun = $(this).closest('tr').find('td:eq(0)').text(); // Mendapatkan nilai kolom pertama 
            var jml_peminat = $(this).closest('tr').find('td:eq(1)').text();
            var juml_masuk = $(this).closest('tr').find('td:eq(2)').text();
            var juml_lulus = $(this).closest('tr').find('td:eq(3)').text();
            console.log(tahun)
            $('#itemId').val(itemId);
            $('#tahun').val(tahun);
            $('#jml_peminat').val(jml_peminat);
            $('#juml_masuk').val(juml_masuk);
            $('#juml_lulus').val(juml_lulus);


        });

        // Menyimpan item (Tambah/Edit)
        $('#saveItem').click(function() {
            var formData = new FormData($('#itemForm')[0]); // Membuat objek FormData untuk mengirim data formulir, termasuk file
            $.ajax({

                type: 'POST',
                url: '/alumni',
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
                    url: '/alumni/' + $(this).data('id'),
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