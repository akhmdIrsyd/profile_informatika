@extends('Landing.layout')

@section('content')
<section class="hero-section hero-section-full-height">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12 col-12 p-0">
                <div id="hero-slide" class="carousel carousel-fade slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('gambar_website/' . $slider1->file) }}" class="carousel-image img-fluid" alt="...">


                            <div class="carousel-caption d-flex flex-column justify-content-end">
                                <h2>Selamat Datang</h2>

                                <p>{{$namaprodi1->isi}}</p>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('gambar_informasi/' . $slider2->gambar) }}" class="carousel-image img-fluid" alt="...">

                            <div class="carousel-caption d-flex flex-column justify-content-end">
                                <h2>Selamat Datang</h2>

                                <p>{{$namaprodi1->isi}}</p>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('gambar_informasi/' . $slider3->gambar) }}" class="carousel-image img-fluid" alt="...">

                            <div class="carousel-caption d-flex flex-column justify-content-end">
                                <h2>Selamat Datang</h2>

                                <p>{{$namaprodi1->isi}}</p>

                            </div>
                        </div>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#hero-slide" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#hero-slide" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

        </div>
    </div>
</section>


<section class="section-padding">
    <div class="container">
        <div class="row">

            <div class="col-lg-10 col-12 text-center mx-auto">
                <h2 class="mb-5"></h2>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
                <div class="featured-block d-flex justify-content-center align-items-center">
                    <a href="/akademik/SyaratPendaftaran" class="d-block">
                        <img src="{{ asset('Landing/images/icons/group.png') }}" class="featured-block-image img-fluid" alt="">

                        <p class="featured-block-text">Calon <strong>Mahasiswa</strong></p>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 mb-md-4">
                <div class="featured-block d-flex justify-content-center align-items-center">
                    <a href="{{ route('landingpage.alumni') }}" class="d-block">
                        <img src="{{ asset('Landing/images/icons/diploma.png') }}" class="featured-block-image img-fluid" alt="">

                        <p class="featured-block-text"><strong>Alumni</strong> </p>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 mb-md-4">
                <div class="featured-block d-flex justify-content-center align-items-center">
                    <a href="{{ route('landingpage.prestasi') }}" class="d-block">
                        <img src="{{ asset('Landing/images/icons/trophy.png') }}" class="featured-block-image img-fluid" alt="">

                        <p class="featured-block-text"><strong>Prestasi</strong></p>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
                <div class="featured-block d-flex justify-content-center align-items-center">
                    <a href="{{ route('landingpage.beasiswa') }}" class="d-block">
                        <img src="{{ asset('Landing/images/icons/scholarship.png') }}" class="featured-block-image img-fluid" alt="">

                        <p class="featured-block-text"><strong>Beasiswa</strong> </p>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="section-padding section-bg" id="section_2">
    <div class="container">
        <div class="row">

            <div class="col-lg-6 col-12 mb-5 mb-lg-0">
                <iframe class="custom-text-box-image img-fluid" alt="" src="{{$videoProfil->isi}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

            </div>

            <div class="col-lg-6 col-12">
                <div class="custom-text-box">
                    <h2 class="mb-2">Tentang</h2>

                    <h5 class="mb-3">{{$namaprodi1->isi}}</h5>

                    <p class="mb-0"> {{$textwelcome->isi}}</p>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="custom-text-box mb-lg-0">
                            <h5 class="mb-3">Data Informatika</h5>
                            <div class="counter-thumb">
                                <div class="d-flex">
                                    <span class="counter-number" data-from="1" data-to="{{$totalaktif }}" data-speed="1000"></span>

                                </div>

                                <span class="counter-text">Mahasiswa Aktif</span>
                            </div>

                            <div class="counter-thumb mt-4">
                                <div class="d-flex">
                                    <span class="counter-number" data-from="1" data-to="{{$totalLulus }}" data-speed="1000"></span>
                                </div>

                                <span class="counter-text">Lulus</span>
                            </div>
                            <div class="counter-thumb mt-4">
                                <div class="d-flex">
                                    <span class="counter-number" data-from="1" data-to="{{$count_dosens}}" data-speed="1000"></span>

                                </div>

                                <span class="counter-text">Dosen</span>
                            </div>

                            <div class="counter-thumb mt-4">
                                <div class="d-flex">
                                    <span class="counter-number" data-from="1" data-to="{{$professorCount}}" data-speed="1000"></span>

                                </div>

                                <span class="counter-text">Guru Besar</span>
                            </div>


                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="custom-text-box mb-lg-0">
                            <h5 class="mb-3">Ketetatan</h5>
                            <div class="counter-thumb">
                                <div class="d-flex">
                                    <span class="counter-number" data-from="1" data-to="{{ $total_peminat }}" data-speed="1000"></span>

                                </div>

                                <span class="counter-text">Peminat</span>
                            </div>

                            <div class="counter-thumb mt-4">
                                <div class="d-flex">
                                    <span class="counter-number" data-from="1" data-to="{{ number_format($persentase['snmptn'], 2) }}" data-speed="1000"></span>
                                    <span class="counter-number-text">%</span>
                                </div>

                                <span class="counter-text">SNMPTN</span>
                            </div>
                            <div class="counter-thumb mt-4">
                                <div class="d-flex">
                                    <span class="counter-number" data-from="1" data-to="{{ number_format($persentase['sbnptn'], 2) }}" data-speed="1000"></span>
                                    <span class="counter-number-text">%</span>
                                </div>

                                <span class="counter-text">SBMPTN</span>
                            </div>

                            <div class="counter-thumb mt-4">
                                <div class="d-flex">
                                    <span class="counter-number" data-from="1" data-to="{{ number_format($persentase['mandiri'], 2) }}" data-speed="1000"></span>
                                    <span class="counter-number-text">%</span>
                                </div>

                                <span class="counter-text">Mandiri</span>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<section class="about-section section-padding">
    <div class="container">
        <div class="col-lg-12 col-12 text-center mb-4">
            <h2>Bidang Minat</h2>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true">Jaringan Komputer</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                    role="tab" aria-controls="profile" aria-selected="false">Kecerdasan Buatan</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="rpl-tab" data-bs-toggle="tab" data-bs-target="#rpl" type="button"
                    role="tab" aria-controls="rpl" aria-selected="false">Rekayasa Perangkat Lunak</button>
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

            <div class="tab-pane fade" id="rpl" role="tabpanel" aria-labelledby="rpl-tab">
                <div class="row">
                    <h2 class="mb-3"></h2>
                    <div class="col-lg-6 col-md-5 col-12">
                        <img src="{{ asset('Landing/images/rpl.png') }}"
                            class="about-image ms-lg-auto bg-light shadow-lg img-fluid" alt="">
                    </div>

                    <div class="col-lg-5 col-md-7 col-12">
                        <div class="custom-text-block">
                            <h2 class="mb-0">Rekayasa Perangkat Lunak</h2>


                            <p>bidang minat yang mempelajari tentang strategi membangun teknologi informasi sehingga teknologi yang dihasilkan mudah diperbaruhi di kemudian hari.</p>


                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
</section>

<section class="cta-section section-padding section-bg">
    <div class="container">
        <div class="row justify-content-center align-items-center">

            <div class="col-lg-5 col-12 ms-auto">
                <h2 class="mb-0">Jurnal <br>Informatika</h2>
            </div>

            <div class="col-lg-5 col-12">
                <a href="#" class="me-4"></a>

                <a href="penelitian-dan-pengabdian/jurnal" class="custom-btn btn smoothscroll">Lihat Daftar Jurnal</a>
            </div>

        </div>
    </div>
</section>


<section class="section-padding" id="section_3">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12 text-center mb-4">
                <h2><a href="{{ route('landingpage.dosen') }}" class="news-block-title-link">Dosen</a></h2>
            </div>

            @foreach ($dosens as $dosen)
            <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
                <div class="custom-block-wrap">
                    <img src="{{ asset('foto_dosen/'. $dosen->foto ) }}" style="width: 520px; height: 320px;" class="custom-block-image img-fluid" alt="">


                    <div class="custom-block">
                        <div class="custom-block-body">
                            <h5 class="mb-3">{{ $dosen->nama }}</h5>


                        </div>

                        <a href="{{route('landingpage.detaildosen', $dosen->id)}}" class="custom-btn btn">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach


        </div>
    </div>
</section>

<section class="volunteer-section section-padding" id="section_4">

</section>

<section class="news-section section-padding" id="section_5">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12 mb-5">
                <h2>Berita</h2>
            </div>

            <div class="col-lg-7 col-12">
                @foreach ($informasi as $item)
                <div class="news-block ">
                    <div class="news-block-top custom-block-wrap">
                        <a href="{{route('landingpage.detailinformasi', $item->id)}}">
                            <img src=" {{ asset('gambar_informasi/' . $item->gambar) }}" style="height: 464px; width:  100%; " class="news-image img-fluid" alt="">
                        </a>

                        <div class="news-category-block">

                        </div>
                    </div>

                    <div class="news-block-info">
                        <div class="d-flex mt-2">
                            <div class="news-block-date">
                                <p>
                                    <i class="bi-calendar4 custom-icon me-1"></i>
                                    {{ $item->created_at }}
                                </p>
                            </div>

                        </div>

                        <div class="news-block-title mb-2">
                            <h4><a href="{{route('landingpage.detailinformasi', $item->id)}}" class="news-block-title-link">{{ $item->judul }}</a></h4>
                        </div>


                    </div>
                </div>
                @endforeach

            </div>

            <div class="col-lg-4 col-12 mx-auto">


                <h2 class="mt-5 mb-3">Kegitan</h2>
                @if($kegiatan->isEmpty())
                <p>Tidak ada kegiatan bulan ini</p>
                @else
                @foreach ($kegiatan as $item)
                <div class="news-block news-block-two-col d-flex mt-4">


                    <div class="news-block-two-col-info">
                        <div class="news-block-title mb-2">
                            <h6><a href="{{route('landingpage.detailkegiatan', $item->id)}}" class="news-block-title-link">
                                    {{ $item->judul }}
                                </a>
                            </h6>
                        </div>

                        <div class="news-block-date">
                            <p>
                                <i class="bi-calendar4 custom-icon me-1"></i>
                                {{ $item->tanggal }} / {{ $item->waktu }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif


                <div class="category-block d-flex flex-column">
                    <h2 class="mb-3">Pengumuman</h2>
                    @foreach ($pengumuman as $item)
                    <h5><a href="{{route('landingpage.detailinformasi', $item->id)}}" class="category-block-link">
                            {{ $item->judul }}

                        </a>
                    </h5>

                    @endforeach
                </div>




            </div>

        </div>
    </div>
</section>


<section class="testimonial-section section-padding section-bg">
    <div class="container">
        <div class="row">

            <div class="col-lg-8 col-12 mx-auto">
                <h2 class="mb-lg-3">Apa kata mereka ?</h2>

                <div id="testimonial-carousel" class="carousel carousel-fade slide" data-bs-ride="carousel">

                    <div class="carousel-inner">

                        @foreach ($alumni as $item)
                        @if ( $loop->index ==1)
                        <div class="carousel-item active">
                            <div class="carousel-caption">
                                <h4 class="carousel-title">{{ $item->testimoni }}</h4>

                                <small class="carousel-name"><span class="carousel-name-title">{{ $item->nama }}</span></small>
                            </div>
                        </div>
                        @else
                        <div class="carousel-item">
                            <div class="carousel-caption">
                                <h4 class="carousel-title">{{ $item->testimoni }}</h4>

                                <small class="carousel-name"><span class="carousel-name-title">{{ $item->nama }}</span></small>
                            </div>
                        </div>
                        @endif
                        @endforeach


                        <ol class="carousel-indicators">

                            @foreach ($alumni as $item)
                            @if ( $loop->index ==1)
                            <li data-bs-target="#testimonial-carousel" data-bs-slide-to="{{ $loop->index }}" class="active">
                                <img src="{{ asset('foto_alumni/' . $item->foto) }}" class="img-fluid rounded-circle avatar-image" alt="avatar">
                            </li>
                            @else
                            <li data-bs-target="#testimonial-carousel" data-bs-slide-to="{{ $loop->index }}" class="">
                                <img src="{{ asset('foto_alumni/' . $item->foto) }}" class="img-fluid rounded-circle avatar-image" alt="avatar">
                            </li>
                            @endif
                            @endforeach

                        </ol>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<section class="contact-section section-padding" id="section_6">
    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-12 ms-auto mb-5 mb-lg-0">
                <div class="contact-info-wrap">
                    <h2>Kontak</h2>



                    <div class="contact-info">


                        <p class="d-flex mb-2">
                            <i class="bi-geo-alt me-2"></i>
                            {{$alamat->isi}}
                        </p>

                        <p class="d-flex mb-2">
                            <i class="bi-telephone me-2"></i>

                            {{$telpon->isi}}

                        </p>

                        <p class="d-flex">
                            <i class="bi-envelope me-2"></i>

                            {{$email->isi}}

                        </p>


                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-12 mx-auto">
                <!-- Start Map -->
                <div class="mapouter">
                    <div class="gmap_canvas"><iframe class="gmap_iframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=informatika unmul&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe></div>
                    <style>
                        .mapouter {
                            position: relative;
                            text-align: right;
                            width: 100%;
                            height: 300px;
                        }

                        .gmap_canvas {
                            overflow: hidden;
                            background: none !important;
                            width: 100%;
                            height: 300px;
                        }

                        .gmap_iframe {
                            width: 100% !important;

                            height: 300px !important;
                        }
                    </style>
                </div>
                <!-- End Map -->
            </div>

        </div>
    </div>
</section>
@endsection
@section('extrajs')

@endsection