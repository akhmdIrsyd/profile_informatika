@if (Request::is('informasi*'))
<h5 class="mt-5 mb-3">INFORMASI </h5>
<div class="news-block news-block-two-col custom-form subscribe-form">

    <div class="news-block-two-col-info">
        <ul>
            <h6><a href="{{ url('informasi/list_berita') }}" class="news-block-title-link">Berita</a></h6>
        </ul>
        <ul>
            <h6><a href="{{ url('informasi/list_pengumuman') }}" class="news-block-title-link">Pengumuman</a></h6>
        </ul>
        <ul>
            <h6><a href="{{ url('informasi/list_beasiswa') }}" class="news-block-title-link">Beasiswa</a></h6>
        </ul>
        <ul>
            <h6><a href="{{ url('informasi/list_kegiatan') }}" class="news-block-title-link">Kegiatan</a></h6>
        </ul>

    </div>
</div>

@endif

@if (Request::is('profil*'))
<h5 class="mt-5 mb-3">Profil </h5>
<div class="news-block news-block-two-col custom-form subscribe-form">
    <div class="news-block-two-col-info">
        @foreach ($menus['profil'] as $menu)
        @if ($menu->konten->count() > 0)
        @foreach ($menu->konten as $subMenu)



        <ul>
            <h6><a href="{{  url('/'.$menu->url . '/' . $subMenu->url) }}" class="news-block-title-link"> {{ $subMenu->judul }}</a></h6>
        </ul>




        @endforeach
        @endif
        @endforeach
        <ul>
            <h6><a href="{{ url('profil/list_dosen') }}" class="news-block-title-link">Dosen</a></h6>
        </ul>
        <ul>
            <h6><a href="{{ url('profil/list_tendik') }}" class="news-block-title-link">Tendik</a></h6>
        </ul>
    </div>
</div>
@endif

@if (Request::is('akademik*'))
<h5 class="mt-5 mb-3">Akademik </h5>
<div class="news-block news-block-two-col custom-form subscribe-form">
    <div class="news-block-two-col-info">
        @foreach ($menus['akademik'] as $menu)
        @if ($menu->konten->count() > 0)
        @foreach ($menu->konten as $subMenu)
        <ul>
            <h6><a href="{{  url(''.$menu->url . '/' . $subMenu->url) }}" class="news-block-title-link"> {{ $subMenu->judul }}</a></h6>
        </ul>
        @endforeach
        @endif
        @endforeach
    </div>
</div>
@endif

@if (Request::is('kemahasiswaan*'))
<h5 class="mt-5 mb-3">Kemahasiswaan </h5>
<div class="news-block news-block-two-col custom-form subscribe-form">
    <div class="news-block-two-col-info">
        @foreach ($menus['kemahasiswaan'] as $menu)
        @if ($menu->konten->count() > 0)
        @foreach ($menu->konten as $subMenu)
        <ul>
            <h6><a href="{{  url('/'.$menu->url . '/' . $subMenu->url) }}" class="news-block-title-link"> {{ $subMenu->judul }}</a></h6>
        </ul>
        @endforeach
        @endif
        @endforeach
        <ul>
            <h6><a href="{{ url('kemahasiswaan/list_prestasi') }}" class="news-block-title-link">Prestasi</a></h6>
        </ul>

    </div>
</div>
@endif

@if (Request::is('penelitian-dan-pengabdian*'))
<h5 class="mt-5 mb-3">Penelitian dan Pengabdian </h5>
<div class="news-block news-block-two-col custom-form subscribe-form">
    <div class="news-block-two-col-info">
        @foreach ($menus['penelitian-dan-pengabdian'] as $menu)
        @if ($menu->konten->count() > 0)
        @foreach ($menu->konten as $subMenu)
        <ul>
            <h6><a href="{{  url('/'.$menu->url . '/' . $subMenu->url) }}" class="news-block-title-link"> {{ $subMenu->judul }}</a></h6>
        </ul>
        @endforeach
        @endif
        @endforeach
        <ul>
            <h6><a href="{{ url('penelitian-dan-pengabdian/buku') }}" class="news-block-title-link">Buku</a></h6>
        </ul>
        <ul>
            <h6><a href="{{ url('penelitian-dan-pengabdian/penelitian') }}" class="news-block-title-link">Penelitian</a></h6>
        </ul>
        <ul>
            <h6><a href="{{ url('penelitian-dan-pengabdian/pengmas') }}" class="news-block-title-link">Pengabdian Masyarakat</a></h6>
        </ul>
        <ul>
            <h6><a href="{{ url('penelitian-dan-pengabdian/publikasi') }}" class="news-block-title-link">Publikasi</a></h6>
        </ul>
    </div>
</div>
@endif