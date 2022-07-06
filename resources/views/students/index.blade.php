@extends('layouts.global')
@section('title') Daftar Siswa @endsection

@section('content')
@if(session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif


<div class="row">
    <div class="col-md-12 text-right mb-3">
        <a href="{{route('students.create')}}" class="btn btn-info">Tambah</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table id="example" class="table table-bordered table-stripped">
            <thead>
                <tr>
                    <th><b>NISN</b></th>
                    <th><b>Nama</b></th>
                    <th><b>Alamat</b></th>
                    <th><b>Jenis Kelamin</b></th>
                    <th><b>Kelas</b></th>
                    <th><b>Keterangan</b></th>

                    <th><b>Actions</b></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $row)
                <tr>
                    <td>{{$row->nisn}}</td>
                    <td>{{$row->name}}</td>
                    <td>{{$row->address}}</td>
                    <td>{{$row->gender}}</td>
                    <td>{{$row->room->name}}</td>
                    <td></td>
                    <td>aksi</td>

                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colSpan="10">
                        {{$students->links()}}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection