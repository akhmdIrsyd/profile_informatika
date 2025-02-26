@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h1 class="m-0 font-weight-bold text-primary">ketetatan Informatika</h1>
        </div>
        <div class="card-body">
            <button class="btn btn-primary" id="addNewItem">Tambah</button>
            <div class="table-responsive">
                <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tahun</th>
                            <th>Peminat SNMPTN</th>
                            <th>Kuota SNMPTN</th>
                            <th>Peminat SBMPTN</th>
                            <th>Kuota SBMPTN</th>
                            <th>Peminat Mandiri</th>
                            <th>Kuota Mandiri</th>
                            <th width="15%" class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tahun</th>
                            <th>Peminat SNMPTN</th>
                            <th>Kuota SNMPTN</th>
                            <th>Peminat SBMPTN</th>
                            <th>Kuota SBMPTN</th>
                            <th>Peminat Mandiri</th>
                            <th>Kuota Mandiri</th>
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

@extends('admin.ketetatan.add')

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
            ajax: '{{ url("/ketetatan") }}',
            columns: [{
                    data: 'tahun',
                    name: 'tahun'
                },
                {
                    data: 'jml_snmptn',
                    name: 'jml_snmptn'
                },
                {
                    data: 'kuota_snmptn',
                    name: 'kuota_snmptn'
                },
                {
                    data: 'jml_sbnptn',
                    name: 'jml_sbnptn'
                },
                {
                    data: 'kuota_sbnptn',
                    name: 'kuota_sbnptn'
                },
                {
                    data: 'jml_mandiri',
                    name: 'jml_mandiri'
                },
                {
                    data: 'kuota_mandiri',
                    name: 'kuota_mandiri'
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
            var jml_snmptn = $(this).closest('tr').find('td:eq(1)').text();
            var kuota_snmptn = $(this).closest('tr').find('td:eq(2)').text();
            var jml_sbnptn = $(this).closest('tr').find('td:eq(3)').text();
            var kuota_sbnptn = $(this).closest('tr').find('td:eq(4)').text();
            var jml_mandiri = $(this).closest('tr').find('td:eq(5)').text();
            var kuota_mandiri = $(this).closest('tr').find('td:eq(6)').text();
            console.log(tahun)
            $('#itemId').val(itemId);
            $('#tahun').val(tahun);
            $('#jml_snmptn').val(jml_snmptn);
            $('#kuota_snmptn').val(kuota_snmptn);
            $('#jml_sbnptn').val(jml_sbnptn);
            $('#kuota_sbnptn').val(kuota_sbnptn);
            $('#jml_mandiri').val(jml_mandiri);
            $('#kuota_mandiri').val(kuota_mandiri);


        });

        // Menyimpan item (Tambah/Edit)
        $('#saveItem').click(function() {
            var formData = new FormData($('#itemForm')[0]); // Membuat objek FormData untuk mengirim data formulir, termasuk file
            $.ajax({

                type: 'POST',
                url: '/ketetatan',
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
                    url: '/ketetatan/' + $(this).data('id'),
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