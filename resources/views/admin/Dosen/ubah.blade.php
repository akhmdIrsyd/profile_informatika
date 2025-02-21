@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h1 class="m-0 font-weight-bold text-primary">Dosen</h1>
        </div>
        <div class="card-body">
            <!-- Form -->
            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <form action="{{ route('dosen.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Row 1 -->
                <h4>Informasi Dosen</h4>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $profile->nama) }}" placeholder="Masukkan Nama">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" value="{{ old('nip', $profile->nip) }}" placeholder="Masukkan NIP">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <select class="form-control" id="jabatan" name="jabatan">
                                <option value="">-- Pilih Jabatan --</option>
                                <option value="tenaga pendidik" @selected(old('jabatan', $profile->jabatan ?? '') == 'tenaga pendidik')>Tenaga Pendidik</option>
                                <option value="asisten ahli" @selected(old('jabatan', $profile->jabatan ?? '') == 'asisten ahli')>Asisten Ahli</option>
                                <option value="lektor" @selected(old('jabatan', $profile->jabatan ?? '') == 'lektor')>Lektor</option>
                                <option value="lektor kepala" @selected(old('jabatan', $profile->jabatan ?? '') == 'lektor kepala')>Lektor Kepala</option>
                                <option value="professor" @selected(old('jabatan', $profile->jabatan ?? '') == 'professor')>Professor</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Row 2 -->
                <h4>Kontak</h4>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $profile->email) }}" placeholder="Masukkan Email">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="telpon">Telepon</label>
                            <input type="text" class="form-control" id="telpon" name="telpon" value="{{ old('telpon', $profile->telpon) }}" placeholder="Masukkan Telepon">
                        </div>
                    </div>
                </div>

                <h3>Index</h3>
                <!-- Row 3 -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="scopus">Scopus</label>
                            <input type="text" class="form-control" id="scopus" name="scopus" value="{{ old('scopus', $profile->scopus) }}" placeholder="Masukkan URL Scopus">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="sinta">Sinta</label>
                            <input type="text" class="form-control" id="sinta" name="sinta" value="{{ old('sinta', $profile->sinta) }}" placeholder="Masukkan URL Sinta">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gscholar">Google Scholar</label>
                            <input type="text" class="form-control" id="gscholar" name="gscholar" value="{{ old('gscholar', $profile->gscholar) }}" placeholder="Masukkan URL Google Scholar">
                        </div>
                    </div>
                </div>

                <h4>Alumni</h4>
                <!-- Row 4 -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="s1">S1</label>
                            <input type="text" class="form-control" id="s1" name="s1" value="{{ old('s1', $profile->s1) }}" placeholder="Masukkan Informasi S1">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="s2">S2</label>
                            <input type="text" class="form-control" id="s2" name="s2" value="{{ old('s2', $profile->s2) }}" placeholder="Masukkan Informasi S2">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="s3">S3</label>
                            <input type="text" class="form-control" id="s3" name="s3" value="{{ old('s3', $profile->s3) }}" placeholder="Masukkan Informasi S3">
                        </div>
                    </div>
                </div>

                <!-- Row 4 -->
                <h4>Foto & Minat</h4>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto" accept="image/*" placeholder="Upload foto">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="minat">Minat</label>
                            <input type="text" class="form-control" id="minat" name="minat" value="{{ old('minat', $profile->minat) }}" placeholder="Masukkan Informasi minat">
                        </div>
                    </div>
                </div>

                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('dosen.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>

            <!-- form -->
        </div>
    </div>
</div>



@endsection
@section('extrajs')
<!-- Page level plugins -->
<script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>


@endsection