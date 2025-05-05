<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="Website Informatika Universitas Mulawarman">
    <meta name="author" content="Informatika">

    <title>Informatika</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('Landing/images.ico') }}">
    <!-- CSS FILES -->
    <link href="{{ asset('Landing/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('Landing/css/bootstrap-icons.css') }}" rel="stylesheet">

    <link href="{{ asset('Landing/css/templatemo-kind-heart-charity.css') }}" rel="stylesheet">
    <style>
        .news-detail-header-section {
            background-image: url("{{ asset('Landing/images/news/gedung.png') }}");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            position: relative;
            padding-top: 150px;
            padding-bottom: 150px;
        }
    </style>

    <!--

TemplateMo 581 Kind Heart Charity

https://templatemo.com/tm-581-kind-heart-charity

-->

</head>

<body id="section_1">

    <header class="site-header">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-12 d-flex flex-wrap">
                    <p class="d-flex me-4 mb-0">
                        <i class="bi-geo-alt me-2"></i>
                        {{$alamat->isi}}
                    </p>

                    <p class="d-flex mb-0">
                        <i class="bi-envelope me-2"></i>

                        <a href="mailto:info@company.com">
                            {{$email->isi}}
                        </a>
                    </p>
                </div>

                <div class="col-lg-3 col-12 ms-auto d-lg-block d-none">
                    <ul class="social-icon">


                        <li class="social-icon-item">
                            <a href="https://instagram.com/{{$instagram->isi}}" class="social-icon-link bi-instagram"></a>
                        </li>

                        <li class="social-icon-item">
                            <a href="https://youtube.com/{{$youtube->isi}}" class="social-icon-link bi-youtube"></a>
                        </li>


                    </ul>
                </div>

            </div>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg bg-light shadow-lg">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img style="min-height: 50px; min-width: 200px; max-height: 50px; max-width: 200px;" src=" {{ asset('gambar_website/' . $logoprodi->file)}}" class="logo img-fluid" alt="Kind Heart Charity">
                <!--<span>
                    Kind Heart Charity
                    <small>Non-profit Organization</small>
                </span>-->
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle" id="navbarLightDropdownMenuLink1" role="button" data-bs-toggle="dropdown" aria-expanded="false">Informasi</a>

                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink1">
                            @foreach ($menus['informasi'] as $menu)
                            @if ($menu->konten->count() > 0)

                            @foreach ($menu->konten as $subMenu)

                            <li>
                                <a class="dropdown-item" href="{{  url($menu->url . '/' . $subMenu->url) }}">
                                    {{ $subMenu->judul }}
                                </a>
                            </li>

                            @endforeach

                            @endif
                            @endforeach
                            <li><a class="dropdown-item" href="{{ route('landingpage.berita') }}">Berita</a></li>
                            <li><a class="dropdown-item" href="{{ route('landingpage.pengumuman') }}">Pengumuman</a></li>
                            <li><a class="dropdown-item" href="{{ route('landingpage.beasiswa') }}">Beasiswa</a></li>
                            <li><a class="dropdown-item" href="{{ route('landingpage.kegiatan') }}">Kegiatan</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle" id="navbarLightDropdownMenuLink2" role="button" data-bs-toggle="dropdown" aria-expanded="false">Profil</a>

                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink2">
                            @foreach ($menus['profil'] as $menu)
                            @if ($menu->konten->count() > 0)

                            @foreach ($menu->konten as $subMenu)

                            <li>
                                <a class="dropdown-item" href="{{  url($menu->url . '/' . $subMenu->url) }}">
                                    {{ $subMenu->judul }}
                                </a>
                            </li>

                            @endforeach

                            @endif
                            @endforeach
                            <li><a class="dropdown-item" href="{{ route('landingpage.dosen') }}">Dosen</a></li>

                            <li><a class="dropdown-item" href="{{ route('landingpage.tendik') }}">Tendik</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle" id="navbarLightDropdownMenuLink3" role="button" data-bs-toggle="dropdown" aria-expanded="false">Akademik</a>

                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink3">
                            @foreach ($menus['akademik'] as $menu)
                            @if ($menu->konten->count() > 0)

                            @foreach ($menu->konten as $subMenu)

                            <li>
                                <a class="dropdown-item" href="{{  url($menu->url . '/' . $subMenu->url) }}">
                                    {{ $subMenu->judul }}
                                </a>
                            </li>

                            @endforeach

                            @endif
                            @endforeach

                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle" id="navbarLightDropdownMenuLink4" role="button" data-bs-toggle="dropdown" aria-expanded="false">Mahasiswa</a>

                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink4">
                            @foreach ($menus['kemahasiswaan'] as $menu)
                            @if ($menu->konten->count() > 0)

                            @foreach ($menu->konten as $subMenu)

                            <li>
                                <a class="dropdown-item " href="{{  url($menu->url . '/' . $subMenu->url) }}">
                                    {{ $subMenu->judul }}
                                </a>
                            </li>

                            @endforeach

                            @endif
                            @endforeach
                            <li><a class="dropdown-item" href="{{ route('landingpage.alumni') }}">Alumni</a></li>

                            <li><a class="dropdown-item" href="{{ route('landingpage.prestasi') }}">Prestasi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle" id="navbarLightDropdownMenuLink5" role="button" data-bs-toggle="dropdown" aria-expanded="false">Pengabdian dan Penelitian</a>

                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink5">
                            @foreach ($menus['penelitian-dan-pengabdian'] as $menu)
                            @if ($menu->konten->count() > 0)

                            @foreach ($menu->konten as $subMenu)

                            <li>
                                <a class="dropdown-item" href="{{  url($menu->url . '/' . $subMenu->url) }}">
                                    {{ $subMenu->judul }}
                                </a>
                            </li>

                            @endforeach

                            @endif
                            @endforeach

                            <li><a class="dropdown-item" href="{{ route('landingpage.buku') }}">Buku</a></li>
                            <li><a class="dropdown-item" href="{{ route('landingpage.penelitian') }}">Penelitian</a></li>
                            <li><a class="dropdown-item" href="{{ route('landingpage.pengmas') }}">Pengabdian</a></li>
                            <li><a class="dropdown-item" href="{{ route('landingpage.publikasi') }}">Publikasi</a></li>

                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12 mb-4">
                    <a href="https://unmul.ac.id/" class="">
                        <img src=" {{ asset('gambar_website/' . $logouniv->file)}}" class="logo img-fluid" alt="">
                    </a>

                </div>

                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <h5 class="site-footer-title mb-3">Quick Links</h5>

                    <ul class="footer-menu">
                        <li class="footer-menu-item"><a href="https://unmul.ac.id/" class="footer-menu-link">Universitas Mulawarnan</a></li>

                        <li class="footer-menu-item"><a href="https://ft.unmul.ac.id/" class="footer-menu-link">Fakultas Teknik</a></li>

                        <li class="footer-menu-item"><a href="https://geologi.ft.unmul.ac.id/" class="footer-menu-link">Geologi</a></li>

                        <li class="footer-menu-item"><a href="https://che.ft.unmul.ac.id/" class="footer-menu-link">Teknik Kimia</a></li>
                        <li class="footer-menu-item"><a href="https://s1tambang.ft.unmul.ac.id/" class="footer-menu-link">Pertambangan</a></li>

                        <li class="footer-menu-item"><a href="https://ts.ft.unmul.ac.id/" class="footer-menu-link">Sipil</a></li>

                        <li class="footer-menu-item"><a href="https://ars.ft.unmul.ac.id/" class="footer-menu-link">Arsitektur</a></li>

                        <li class="footer-menu-item"><a href="https://tekling.ft.unmul.ac.id/" class="footer-menu-link">Teknik Lingkungan</a></li>

                        <li class="footer-menu-item"><a href="https://ppi.ft.unmul.ac.id/" class="footer-menu-link">Insinyur</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 col-12 mx-auto">
                    <h5 class="site-footer-title mb-3">Kontak</h5>

                    <p class="text-white d-flex mb-2">
                        <i class="bi-telephone me-2"></i>

                        {{$telpon->isi}}

                    </p>

                    <p class="text-white d-flex">
                        <i class="bi-envelope me-2"></i>

                        {{$email->isi}}

                    </p>

                    <p class="text-white d-flex mt-3">
                        <i class="bi-geo-alt me-2"></i>
                        {{$alamat->isi}}
                    </p>


                </div>
            </div>
        </div>

        <div class="site-footer-bottom">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-md-7 col-12">
                        <p class="copyright-text mb-0">Copyright © 2025 Informatika
                        </p>
                    </div>

                    <div class="col-lg-6 col-md-5 col-12 d-flex justify-content-center align-items-center mx-auto">
                        <ul class="social-icon">


                            <li class="social-icon-item">
                                <a href="https://instagram.com/{{$instagram->isi}}" class="social-icon-link bi-instagram"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="https://youtube.com/{{$youtube->isi}}" class="social-icon-link bi-youtube"></a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </footer>

    <!-- JAVASCRIPT FILES -->
    <script src="{{ asset('Landing/js/jquery.min.js') }}"></script>
    <script src="{{ asset('Landing/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('Landing/js/jquery.sticky.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!--<script src="{{ asset('Landing/js/click-scroll.js') }}"></script>-->
    <script src="{{ asset('Landing/js/counter.js') }}"></script>
    <script src="{{ asset('Landing/js/custom.js') }}"></script>
    @yield('extrajs')
</body>

</html>