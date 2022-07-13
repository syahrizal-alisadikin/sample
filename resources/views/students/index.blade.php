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
                    <th><b>Tahun</b></th>
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
                    <td>{{$row->room->name ?? "Data tidak ada"}}</td>
                    <td>{{$row->years->year ?? "Data tidak ada"}}</td>
                    <td> <a class="btn btn-primary text-white btn-sm" href="{{route('students.edit', [$row->id])}}">Ubah</a>

                        <form onsubmit="return confirm('Yakin ingin menghapus Data?')" class="d-inline" action="{{route('students.destroy', [$row->id])}}" method="POST">
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
                        {{$students->links()}}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

@endsection