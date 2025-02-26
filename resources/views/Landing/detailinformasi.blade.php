@extends('Landing.layout')

@section('content')
<section class="news-detail-header-section text-center">
    <div class="section-overlay"></div>

    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12">
                @if ( $datas->TipeInfo->nama == 'Berita' )
                <h1 class="text-white">Berita</h1>
                @endif
                @if ( $datas->TipeInfo->nama == 'Pengumuman' )
                <h1 class="text-white">Pengumuman</h1>
                @endif
                @if ( $datas->TipeInfo->nama == 'Beasiswa' )
                <h1 class="text-white">Beasiswa</h1>
                @endif
                @if ( $datas->TipeInfo->nama == 'Prestasi' )
                <h1 class="text-white">Prestasi</h1>
                @endif
            </div>

        </div>
    </div>
</section>

<section class="news-section section-padding">
    <div class="container">
        <div class="row">

            <div class="col-lg-7 col-12">
                <div class="news-block">
                    <div class="news-block-top">
                        <a href="#">
                            <img src="{{ asset('gambar_informasi/' . $datas->gambar) }}" class="news-image img-fluid" alt="">
                        </a>

                    </div>

                    <div class="news-block-info">
                        <div class="d-flex mt-2">
                            <div class="news-block-date">
                                <p>
                                    <i class="bi-calendar4 custom-icon me-1"></i>
                                    {{ $datas->created_at }}
                                </p>
                            </div>



                        </div>

                        <div class="news-block-title mb-2">
                            <h4><a href="#" class="news-block-title-link"> {{ $datas->judul }}</a></h4>
                        </div>

                        <div class="news-block-body">
                            {!! $datas->isi !!}
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