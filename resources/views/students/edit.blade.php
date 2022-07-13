@extends('layouts.global')
@section('title') Ubah Data Siswa @endsection
@section('content')

<div class="col-md-8">
    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif

    <form class="bg-white shadow-sm p-3" action="{{route('students.update', [$student->id])}}" method="POST">
        @csrf
        <input type="hidden" value="PUT" name="_method">
        <label class="form-label">Nama</label>
        <input type="text" name="name" value="{{ old('name',$student->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Siswa" />
        @error("name")
        <div id="validationServer03Feedback" class="invalid-feedback">
            {{ $message }}
        </div>

        @enderror
        <label class="form-label">Nisn</label>
        <input type="text" name="nisn" value="{{ old('nisn',$student->nisn) }}" class="form-control @error('nisn') is-invalid @enderror" placeholder="Nisn Siswa" />
        @error("nisn")
        <div id="validationServer03Feedback" class="invalid-feedback">
            {{ $message }}
        </div>

        @enderror
        <label class="form-label">Email Address</label>
        <input type="email" name="email" value="{{ old('email', $student->user->email ?? "data tidak ada") }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address" />
        @error("email")
        <div id="validationServer03Feedback" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" value="{{ old('password') }}" />
        @error("password")
        <div id="validationServer03Feedback" class="invalid-feedback">
            {{ $message }}
        </div>

        @enderror
        <label class="form-label">Password Confirmation</label>
        <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirmation" value="{{ old('password',$student->password_confirmation) }}" />
        <label class="form-label">Kelas</label>
        <select name="room_id" class="form-control @error('room_id') is-invalid @enderror" required>
            <option value="">-- Pilih Kelas --</option>
            @foreach ($rooms as $item)
            <option value="{{$item->id}}" {{ $item->id == $student->room_id ? "selected" : "" }}>{{$item->name}}</option>
            @endforeach
        </select>

        <label class="">Jenis Kelamin</label>
        <select name="gender" class="form-control @error('gender') is-invalid @enderror" id="">
            <option value="">Pilih Jenis Kelamin</option>
            <option value="Laki-Laki" {{ $student->gender == "Laki-Laki" ? "selected" : "" }}>Laki-Laki</option>
            <option value="Perempuan" {{ $student->gender == "Perempuan" ? "selected" : "" }}>Perempuan</option>
        </select>
        @error('gender')
        <div class="invalid-feedback" style="display: block">
            {{ $message }}
        </div>
        @enderror
        <label class="form-label">Tahun Ajaran</label>
        <select name="school_year_id" class="form-control @error('school_year_id') is-invalid @enderror" required id="">
            <option value="">Pilih Tahun</option>
            @foreach ($school_years as $item)
            <option value="{{$item->id}}" {{ $item->id == $student->school_year_id ? "selected" : "" }}>{{$item->year}}</option>
            @endforeach
        </select>
        <label class="form-label">Alamat</label>
        <textarea name="address" id="" cols="30" class="form-control @error('address') is-invalid @enderror" placeholder="Masukan Alamat..." rows="5">{{ old('address',$student->address) }}</textarea>
        @error("address")
        <div id="validationServer03Feedback" class="invalid-feedback">
            {{ $message }}
        </div>

        @enderror
        <br>
        <label for="">Status</label>
        <br />
        <input {{$student->user->status == "ACTIVE" ? "checked" : ""}} value="ACTIVE" type="radio" class="form-control" id="active" name="status">
        <label for="active">Active</label>
        <input {{$student->user->status == "INACTIVE" ? "checked" : ""}} value="INACTIVE" type="radio" class="form-control" id="inactive" name="status">
        <label for="inactive">Inactive</label>
        <br><br>
        <input class=" btn btn-success" type="submit" value="Simpan" />
    </form>
</div>
@endsection