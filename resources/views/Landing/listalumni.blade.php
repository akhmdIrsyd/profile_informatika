@extends('Landing.layout')

@section('content')
<section class="news-detail-header-section text-center">
    <div class="section-overlay"></div>

    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12">
                <h1 class="text-white">Alumni</h1>
            </div>

        </div>
    </div>
</section>

<section class="news-section section-padding">
    <div class="container">

        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <a href="{{ route('landingpage.statistik') }}">
                <div class="col-lg-7 col-12 ">
                    <div class="card border-left-primary shadow h-100 py-2 custom-btn">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class=" font-weight-bold  text-uppercase mb-1">
                                        <center>Data Informatika</center>
                                    </div>

                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>



            <div class="col-lg-7 col-12">

                <div class="table-responsive">
                    <table style="width: 100%; border-collapse: collapse;" cellspacing="0" id="datatable" width="100%" cellspacing="0">
                        <thead>

                        </thead>
                        <tfoot>

                        </tfoot>
                        <tbody>

                        </tbody>
                    </table>
                </div>

            </div>



            <div class="col-lg-4 col-12 mx-auto mt-4 mt-lg-0 ">


                <div class="category-block d-flex flex-column">

                    @include('Landing.sidebar')

                </div>




            </div>

        </div>
    </div>
</section>
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
            ajax: '{{ url("/kemahasiswaan/list_alumni") }}',
            columns: [{
                    data: 'nama',
                    name: 'nama',
                    visible: false
                },
                {
                    data: 'nim',
                    name: 'nim',
                    visible: false
                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                }
            ]
        });


    });
</script>
@endsection