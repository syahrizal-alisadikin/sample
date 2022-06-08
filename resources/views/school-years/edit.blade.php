@extends('layouts.global')
@section('title') Ubah Data Tahun @endsection
@section('content')

<div class="col-md-8">
    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif

    <form class="bg-white shadow-sm p-3" action="{{route('school-years.update', [$year->id])}}" method="POST">
        @csrf
        <input type="hidden" value="PUT" name="_method">
        <label for="name">Tahun</label>
        <input value="{{$year->year}}" class="form-control" placeholder="Tahun" type="text" name="year" id="year" />
        <br>
        <label for="keterangan">Keterangan</label>
        <input value="{{$year->description}}" class="form-control" type="text" name="description" id="description" />
        <br>

        <input class="btn btn-success" type="submit" value="Simpan" />
    </form>
</div>
@endsection