@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Merubah File Arsip {{$surat->judul}}</h1>
</div>

@if(session()->has('berhasil'))
<div class="alert alert-success" role="alert">
    {{ session('berhasil')}}
</div>
@endif

<div class="col-lg-8">
    <form method="POST" action="/dashboard/{{ $surat->id }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="pdf" class="form-label">Upload File Surat Baru anda (PDF)</label>
            <input type="hidden" name="oldPdf" value="{{$surat->pdf}}">
            <input class="form-control @error('pdf') is-invalid @enderror" type="file" id="pdf" name="pdf">
            @error('pdf')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <a class="btn btn-warning" href="{{ route('dashboard.show',$surat->id) }}"><span data-feather="chevrons-left"></span>Kembali</a>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>

</div>



@endsection