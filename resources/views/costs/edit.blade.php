@extends('layouts.global')
@section('title') Ubah Data Biaya @endsection
@section('content')

<div class="col-md-8">
    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif

    <form class="bg-white shadow-sm p-3" action="{{route('costs.update', [$cost->id])}}" method="POST">
        @csrf
        <input type="hidden" value="PUT" name="_method">
        <label for="name">Nama Biaya</label>
        <input value="{{$cost->name}}" class="form-control" type="text" name="name" id="name" />
        <br>
        <input value="{{$cost->nominal}}" class="form-control" type="number" name="nominal" id="nominal" />
        <br>
        <label for="keterangan">Keterangan</label>
        <input value="{{$cost->description}}" class="form-control" type="text" name="description" id="description" />
        <br>

        <input class="btn btn-success" type="submit" value="Simpan" />
    </form>
</div>
@endsection