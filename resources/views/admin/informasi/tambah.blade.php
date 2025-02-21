@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h1 class="m-0 font-weight-bold text-primary">Informasi</h1>
        </div>
        <div class="card-body">
            <!-- Form -->
            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <form action="{{ isset($informasi) ? route('informasi.update', $informasi->id) : route('informasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="user_id" class="form-label">Author</label>
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="tipeinfo_id" class="form-label">Tipe Informasi</label>
                    <select class="form-control select2 @error('tipeinfo_id') is-invalid @enderror" id="tipeinfo_id" name="tipeinfo_id" required>
                        <option value="">Pilih Tipe Informasi</option>
                        @foreach ($tipeinfos as $tipe)
                        <option value="{{ $tipe->id }}" {{ old('tipeinfo_id', $informasi->tipeinfo_id ?? '') == $tipe->id ? 'selected' : '' }}>
                            {{ $tipe->nama }}
                        </option>
                        @endforeach
                    </select>
                    @error('tipeinfo_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $informasi->judul ?? '') }}" required>
                    @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar">
                    @error('gambar')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if(isset($informasi) && $informasi->gambar)
                    <img src="{{ asset('gambar_informasi/'.$informasi->gambar) }}" class="mt-2 img-thumbnail" width="100">
                    @endif
                </div>

                <div class="mb-3">
                    <label for="isi" class="form-label">Isi Informasi</label>
                    <textarea class="form-control @error('isi') is-invalid @enderror" id="isi" name="isi" rows="5" required>{{ old('isi', $informasi->isi ?? '') }}</textarea>
                    @error('isi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>






                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">{{ isset($informasi) ? 'Update' : 'Simpan' }}</button>
                    <a href="{{ route('informasi.index') }}" class="btn btn-secondary">Batal</a>
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
<!-- tinymce Script -->

<!-- Page level custom scripts -->
<script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Pilih Tipe Informasi",
            allowClear: true
        });
    });
</script>
<!-- summernote Script -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#isi').summernote();
    });
</script>
<!-- CKEditor Script -->

@endsection