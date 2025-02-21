@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h1 class="m-0 font-weight-bold text-primary">{{ old('judul', $konten->judul ?? '') }}</h1>
        </div>
        <div class="card-body">
            <!-- Form -->
            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <form action="{{ isset($konten) ? route('konten.update_detail', $konten->id) : route('konten.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="menu_id" name="menu_id" value="{{ $menu->id }}" required>

                <input type="hidden" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $konten->judul ?? '') }}" required>

                <input type="hidden" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ old('url', $konten->url ?? '') }}" required>
                <div class="mb-3">
                    <textarea class="form-control @error('isi') is-invalid @enderror" id="isi" name="isi" rows="5"  required>{{ old('isi', $konten->isi ?? '') }}</textarea>
                    @error('isi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>






                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">{{ isset($konten) ? 'Update' : 'Simpan' }}</button>
                    <a href="{{ route('konten.index') }}" class="btn btn-secondary">Batal</a>
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
            placeholder: "Pilih Menu",
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