@extends('dashboard.layouts.main')

@section('container')


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-5 border-bottom">
    <h1 class="h2">Selamat Datang di Sistem Pengarsipan Surat Kelurahan Karangduren</h1>
</div>
@if(session()->has('success'))
<div class="alert alert-success" role="alert">
    {{ session('success')}}
</div>
@endif

<div class="row justify-content-center mb-3">
    <div class="col-md-8">
        <form action="/dashboard" method="GET">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari Judul Surat" name="cari" value="{{$request->cari}}">
                <button class="btn btn-primary" type="submit">Cari Surat</button>
            </div>
        </form>
    </div>
</div>



<div class="table-responsive ">
    <table class="table table-bordered ">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">No Surat</th>
                <th scope="col">Kategori</th>
                <th scope="col">Judul</th>
                <th scope="col">Waktu Pengarsipan</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($surat as $data )
            <tr>
                <td>{{ $loop->iteration}}</td>
                <td>{{ $data->no_surat}}</td>
                <td>{{ $data->category->name}}</td>
                <td>{{ $data->judul}}</td>
                <td>{{ $data->created_at}}</td>
                <td>
                    <a href="/storage/{{$data->pdf}}" download="{{$data->pdf}}" class="btn btn-warning text-decoration-none"> <span data-feather="download"></span>Unduh</a>
                    <a href="{{ route('dashboard.show',$data->id) }}" class="btn btn-info text-decoration-none"> <span data-feather="eye"></span>Lihat</a>
                    <form action="{{url('/dashboard/'.$data->id )}}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger text-decoration-none border-0" onclick="return confirm('Anda yakin ingin mengahapus arsip ini?')"><span data-feather="x-circle"></span>Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<a href="/dashboard/create" class="btn btn-primary"> Arsipkan Surat</a>



@endsection