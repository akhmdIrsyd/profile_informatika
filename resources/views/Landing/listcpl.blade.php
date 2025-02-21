@extends('Landing.layout')

@section('content')
<section class="news-detail-header-section text-center">
    <div class="section-overlay"></div>

    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12">
                <h1 class="text-white">Dosen</h1>
            </div>

        </div>
    </div>
</section>

<section class="news-section section-padding">
    <div class="container">
        <div class="row">

            <div class="col-lg-7 col-12">

                <div class="d-flex align-items-start">
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</button>
                        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</button>
                        <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</button>
                        <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</button>
                    </div>
                    <div class="tab-content" id="v-pills-tabContent">
                        <!-- Panel 1 -->
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <div class="container">

                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                                            role="tab" aria-controls="home" aria-selected="true">Deskripsi Lulusan</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                                            role="tab" aria-controls="profile" aria-selected="false">CPL</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button"
                                            role="tab" aria-controls="contact" aria-selected="false">Peluang Karir</button>
                                    </li>
                                </ul>

                                <div class="tab-content " id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                        <div class="row">
                                            <h2 class="mb-3"></h2>
                                            <div class="col-lg-6 col-md-5 col-12">
                                                <img src="{{ asset('Landing/images/comp_engineering.png') }}"
                                                    class="about-image ms-lg-auto bg-light shadow-lg img-fluid" alt="">
                                            </div>

                                            <div class="col-lg-5 col-md-7 col-12">
                                                <div class="custom-text-block">
                                                    <h2 class="mb-0">Jaringan Komputer</h2>


                                                    <p>bidang minat yang mempelajari tentang aritmatika dan logika untuk membangun protokol komunikasi antar komputer sehingga informasi apa pun dapat disebarkan dengan cepat dan aman</p>


                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="row">
                                            <h2 class="mb-3"></h2>
                                            <div class="col-lg-6 col-md-5 col-12">
                                                <img src="{{ asset('Landing/images/com_science.png') }}"
                                                    class="about-image ms-lg-auto bg-light shadow-lg img-fluid" alt="">
                                            </div>

                                            <div class="col-lg-5 col-md-7 col-12">
                                                <div class="custom-text-block">
                                                    <h2 class="mb-0">Kecerdasan Buatan</h2>


                                                    <p>bidang minat yang mempelajari tentang aritmatika dan logika untuk membentuk algoritma pemecahan masalah.</p>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                        <div class="row">
                                            <h2 class="mb-3"></h2>
                                            <div class="col-lg-6 col-md-5 col-12">
                                                <img src="{{ asset('Landing/images/rpl.png') }}"
                                                    class="about-image ms-lg-auto bg-light shadow-lg img-fluid" alt="">
                                            </div>

                                            <div class="col-lg-5 col-md-7 col-12">
                                                <div class="custom-text-block">
                                                    <h2 class="mb-0">Rekayasa Perangkat Lunak</h2>


                                                    <p>
                                                        bidang minat yang mempelajari tentang strategi membangun teknologi informasi sehingga teknologi yang dihasilkan mudah
                                                        diperbaruhi di kemudian hari
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <!-- Panel 1 -->
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
                    </div>
                </div>

                <!-- Panel 1 -->
                @if($dataPerSemester->isEmpty())
                <p>Tidak ada data matakuliah.</p>
                @else
                @foreach($dataPerSemester as $semester => $matakuliah)
                <p>
                    <a class="btn btn-primary w-100" data-bs-toggle="collapse" href="#panel1" role="button" aria-expanded="false" aria-controls="panel1">
                        Semester {{ $semester }}
                    </a>
                </p>
                <div class="container-fluid mb-3">
                    <div class="collapse" id="panel1">
                        <div class="card card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama Matakuliah</th>
                                            <th>SKS</th>
                                            <th>RPS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($matakuliah as $m)
                                        <tr>
                                            <td>{{ $m->nama }}</td>
                                            <td>{{ $m->sks }}</td>
                                            <td><a href="https://example.com/rps1" target="_blank">View RPS</a></td>
                                        </tr>
                                        @endforeach
                                        
                                        <!-- Add more rows as needed -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
                <!-- Panel 2 (if needed, you can add similar or different content) -->
                





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