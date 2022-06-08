@extends('layouts.global')
@section('title') Ubah Data Kelas @endsection
@section('content')

<div class="col-md-8">
    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif

    <form class="bg-white shadow-sm p-3" action="{{route('rooms.update', [$room->id])}}" method="POST">
        @csrf
        <input type="hidden" value="PUT" name="_method">
        <label for="name">Nama Kelas</label>
        <input value="{{$room->name}}" class="form-control" placeholder="Name" type="text" name="name" id="name" />
        <br>
        <label for="keterangan">Keterangan</label>
        <input value="{{$room->description}}" class="form-control" type="text" name="description" id="description" />
        <br>

        <input class="btn btn-success" type="submit" value="Simpan" />
    </form>
</div>
@endsection