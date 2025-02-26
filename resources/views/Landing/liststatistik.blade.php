@extends('Landing.layout')

@section('content')
<section class="news-detail-header-section text-center">
    <div class="section-overlay"></div>

    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12">
                <h1 class="text-white">Data Informatika</h1>
            </div>

        </div>
    </div>
</section>

<section class="news-section section-padding">
    <div class="container">
        <div class="row">

            <div class="col-lg-7 col-12">

                <div class="d-flex align-items-start">

                    <!-- Panel 1 -->
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="container">

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                                        role="tab" aria-controls="home" aria-selected="true">Mahasiswa Aktif</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                                        role="tab" aria-controls="profile" aria-selected="false">SNMPTN</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button"
                                        role="tab" aria-controls="contact" aria-selected="false">SBMPTN</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="mandiri-tab" data-bs-toggle="tab" data-bs-target="#mandiri" type="button"
                                        role="tab" aria-controls="contact" aria-selected="false">Mandiri</button>
                                </li>
                            </ul>

                            <div class="tab-content " id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <h2 class="mb-3"></h2>
                                    <div class="row">
                                        <h2 class="mb-3">Data Informatika</h2>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>

                                                        <th>Tahun</th>
                                                        <th>Mahasiswa Aktif</th>
                                                        <th>Mahasiswa Lulus</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($datas_alumni as $alumni)
                                                    <tr>

                                                        <td>{{ $alumni->tahun }}</td>
                                                        <td>{{ $alumni->juml_masuk }}</td>
                                                        <td>{{ $alumni->juml_lulus }}</td>

                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>

                                                        <th>Tahun</th>
                                                        <th>Mahasiswa Aktif</th>
                                                        <th>Mahasiswa Lulus</th>
                                                    </tr>
                                                </tfoot>

                                            </table>
                                        </div>

                                    </div>


                                </div>


                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="row">
                                        <h2 class="mb-3"></h2>

                                        <div class="row">
                                            <h2 class="mb-3">Keketatan SNMPTN</h2>
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>Tahun</th>
                                                            <th>Peminat</th>
                                                            <th>Kuota</th>
                                                            <th>Persentase</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($datas as $alumni)
                                                        <tr>
                                                            <td>{{ $alumni->tahun }}</td>
                                                            <td>{{ $alumni->jml_snmptn }}</td>
                                                            <td>{{ $alumni->kuota_snmptn }}</td>
                                                            <td>{{ number_format($alumni->persentase_snmptn, 2) }}%</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Tahun</th>
                                                            <th>Peminat</th>
                                                            <th>Kuota</th>
                                                            <th>Persentase</th>
                                                        </tr>
                                                    </tfoot>

                                                </table>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <div class="row">
                                        <h2 class="mb-3"></h2>
                                        <div class="row">
                                            <h2 class="mb-3">Keketatan SBMPTN</h2>
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>

                                                            <th>Tahun</th>
                                                            <th>Peminat</th>
                                                            <th>Kuota</th>
                                                            <th>Persentase</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($datas as $alumni)
                                                        <tr>
                                                            <td>{{ $alumni->tahun }}</td>
                                                            <td>{{ $alumni->jml_sbnptn }}</td>
                                                            <td>{{ $alumni->kuota_sbnptn }}</td>
                                                            <td>{{ number_format($alumni->persentase_sbnptn, 2) }}%</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Tahun</th>
                                                            <th>Peminat</th>
                                                            <th>Kuota</th>
                                                            <th>Persentase</th>
                                                        </tr>
                                                    </tfoot>

                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="mandiri" role="tabpanel" aria-labelledby="mandiri-tab">

                                    <div class="row">
                                        <h2 class="mb-3"></h2>
                                        <div class="row">
                                            <h2 class="mb-3">Keketatan Mandiri</h2>
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>

                                                            <th>Tahun</th>
                                                            <th>Peminat</th>
                                                            <th>Kuota</th>
                                                            <th>Persentase</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($datas as $alumni)
                                                        <tr>
                                                            <td>{{ $alumni->tahun }}</td>
                                                            <td>{{ $alumni->jml_mandiri }}</td>
                                                            <td>{{ $alumni->kuota_mandiri }}</td>
                                                            <td>{{ number_format($alumni->persentase_mandiri, 2) }}%</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Tahun</th>
                                                            <th>Peminat</th>
                                                            <th>Kuota</th>
                                                            <th>Persentase</th>
                                                        </tr>
                                                    </tfoot>

                                                </table>
                                            </div>

                                        </div>
                                    </div>


                                </div>

                            </div>


                        </div>
                        <!-- Panel 1 -->

                    </div>

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

@endsection