@extends('layouts.global')
@section('title') Tambah Data Kelas @endsection
@section('content')
<div class="col-md-8">
    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif
    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('rooms.store')}}" method="POST">
        @csrf
        <label>Nama Kelas</label><br>
        <input type="text" class="form-control" name="name" />
        <br>
        <label>Keterangan</label><br>
        <input type="text" class="form-control" name="description" placeholder="Isi jika perlu" />
        <br>
        <input type="submit" class="btn btn-success" value="Simpan" />
    </form>
</div>
@endsection