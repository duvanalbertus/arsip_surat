@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tambah Arsip Surat</h1>
</div>



<div class="col-lg-8">
    <form method="POST" action="/dashboard" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="no_surat" class="form-label">Nomor Surat</label>
            <input type="text" class="form-control @error('no_surat') is-invalid @enderror" id="no_surat" name="no_surat" required autofocus value="{{old('no_surat')}}">
            @error('no_surat')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Kategori</label>
            <select class="form-select" name="category_id">
                @foreach($categories as $category)
                @if(old('category_id') == $category->id)
                <option value="{{ $category->id }}" selected>{{$category->name}}</option>
                @else
                <option value="{{ $category->id }}">{{$category->name}}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control @error('no_surat') is-invalid @enderror" id="judul" name="judul" required autofocus value="{{old('judul')}}">
            @error('judul')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="pdf" class="form-label">File Surat (PDF)</label>
            <input class="form-control @error('pdf') is-invalid @enderror" type="file" id="pdf" name="pdf">
            @error('pdf')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <a href="/dashboard" class="btn btn-warning"> Kembali </a>
        <button type="submit" class="btn btn-primary">Simpan</button>

    </form>

</div>



@endsection