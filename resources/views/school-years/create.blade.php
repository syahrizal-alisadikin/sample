@extends('layouts.global')
@section('title') Tambah Data Tahun @endsection
@section('content')
<div class="col-md-8">
    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif
    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('school-years.store')}}" method="POST">
        @csrf
        <label>Tahun</label><br>
        <input type="text" class="form-control" name="year" />
        <br>
        <label>Keterangan</label><br>
        <input type="text" class="form-control" name="description" placeholder="Isi jika perlu" />
        <br>
        <input type="submit" class="btn btn-success" value="Simpan" />
    </form>
</div>
@endsection