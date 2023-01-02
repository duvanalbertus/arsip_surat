@extends('dashboard.layouts.main')

@section('container')


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-1 border-bottom">
    <h1 class="h2">Detail Info Surat {{$surat->judul}}</h1>
</div>

<div class="container">
    <div class="row mb-5">
        <div class="col-md-8">
            <div class="x_content">
                <br />
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item" style="font-size:17px ;"><b>Nomor: </b>{{$surat->no_surat}}</li>
                        <li class="list-group-item" style="font-size:17px ;"><b>Kategori: </b>{{$surat->category->name}}</li>
                        <li class="list-group-item" style="font-size:17px ;"><b>Judul: </b>{{$surat->judul}}</li>
                        <li class="list-group-item" style="font-size:17px ;"><b>Waktu Unggah: </b>{{$surat->created_at}}</li>
                    </ul>
                    <br>

                    <object data="{{asset('storage/'. $surat->pdf)}}" type="application/pdf" width="150%" height="500px">
                        <embed src="{{asset('storage/'. $surat->pdf)}}" type="application/pdf"></embed>
                    </object>
                    <a class="btn btn-warning mt-3" href="{{ route('dashboard.index') }}"><span data-feather="chevrons-left"></span>Kembali</a>
                    <a class="btn btn-info mt-3" href=" /storage/{{$surat->pdf}}" download="{{$surat->pdf}}"><span data-feather="download"></span>Unduh</a>
                    <a class="btn btn-danger mt-3" href="/dashboard/{{ $surat->id }}/edit"><span data-feather="edit"></span>Ganti File PDF</a>

                </div>
            </div>
        </div>
    </div>





    @endsection