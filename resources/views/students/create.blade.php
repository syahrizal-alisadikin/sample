@extends("layouts.global")
@section("title")Tambah Data Siswa @endsection
@section("content")
<div class="col-md-8">
    @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('students.store')}}" method="POST">
        @csrf
        <label for="nisn">NISN</label>
        <input class="form-control" placeholder="NISN" type="text" name="nisn" id="nisn" />
        <br>
        <label for="room_id">Kelas</label>

        <select name="room_id" class="form-control">
            <option value="">Pilih Kelas</option>
            @foreach($kelas as $row)
            <option value='{{ $row->id}}'>{{$row->name}}</option>
            @endforeach
        </select>
        <br>
        <label for="school_year_id">Tahun</label>

        <select name="school_year_id" class="form-control">
            <option value="">Pilih Tahun</option>
            @foreach($tahun as $row)
            <option value='{{ $row->id}}'>{{$row->name}}</option>
            @endforeach
        </select>
        <br>
        <label for="name">Nama</label>
        <input class="form-control" placeholder="Nama Lengkap" type="text" name="name" id="name" />
        <br>
        <label for="address">Alamat</label>
        <input class="form-control" placeholder="alamat" type="text" name="address" id="address" />
        <br>

        <label for="gender">Jenis Kelamin</label>
        <input class="form-control" placeholder="jenis kelamin" type="text" name="gender" id="gender" />


        <!-- <label for="password_confirmation">Password Confirmation</label>
        <input class="form-control" placeholder="password confirmation" type="password" name="password_confirmation" id="password_confirmation" /> -->
        <br>
        <input class="btn btn-success" type="submit" value="Simpan" />
    </form>
</div>
@endsection