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
                <div class="row ">
                    <h2 class="mb-3"></h2>
                    <div class="col-lg-6 col-md-5 col-12">
                        <img src="{{ asset('foto_dosen/' . $datas->foto) }}" style="width: 520px; height: 320px;"
                            class=" ms-lg-auto bg-light shadow-lg img-fluid" alt="">
                    </div>

                    <div class="col-lg-5 col-md-7 col-12">
                        <div class="custom-text-block">
                            <h6 class="mb-0">{{ $datas->nama }}</h6>
                            <p>
                                Email: {{ $datas->email }}
                            </p>
                            <hr style="border: 2px solid black;">
                            <h6 class="mb-0">Pendidikan</h6>
                            <p class="card-text"><strong>S1:</strong> {{ $datas->s1 }}</p>
                            <p class="card-text"><strong>S2:</strong> {{ $datas->s2 }}</p>
                            <p class="card-text"><strong>S3:</strong> {{ $datas->s3 }}</p>
                            <p>
                                <strong>Bidang Minat:</strong> {{ $datas->minat }}
                            </p>
                            <ul class="social-icon mt-4">
                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-twitter"></a>
                                </li>

                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-facebook"></a>
                                </li>

                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-instagram"></a>
                                </li>
                            </ul>
                        </div>
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