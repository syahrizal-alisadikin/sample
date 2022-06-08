@extends('layouts.global')
@section('title') Daftar Biaya @endsection

@section('content')
@if(session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif
<div class="row">
    <div class="col-md-3">
        <form action="{{route('costs.index')}}">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Temukan Biaya" name="name">
                <div class="input-group-append">
                    <input type="submit" value="Filter" class="btn btn-light">
                </div>
            </div>

        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12 text-right mb-3">
        <a href="{{route('costs.create')}}" class="btn btn-info">Tambah</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-stripped">
            <thead>
                <tr>
                    <th><b>Nama Biaya</b></th>
                    <th><b>Nominal</b></th>
                    <th><b>Keterangan</b></th>

                    <th><b>Actions</b></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($costs as $cost)
                <tr>
                    <td>{{$cost->name}}</td>
                    <td>{{$cost->nominal}}</td>

                    <td>
                        @if($cost->description)
                        {{$cost->description}}
                        @else
                        Tidak ada Keterangan
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-primary text-white btn-sm" href="{{route('costs.edit', [$cost->id])}}">Ubah</a>

                        <form onsubmit="return confirm('Yakin ingin menghapus Data?')" class="d-inline" action="{{route('costs.destroy', [$cost->id])}}" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" value="Hapus" class="btn btn-danger btn-sm">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colSpan="10">
                        {{$costs->appends(Request::all())->links()}}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection