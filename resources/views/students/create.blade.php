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
        <label class="form-label">Nama</label>
        <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Siswa" />
        @error("name")
        <div id="validationServer03Feedback" class="invalid-feedback">
            {{ $message }}
        </div>

        @enderror
        <label class="form-label">Nisn</label>
        <input type="text" name="nisn" value="{{ old('nisn') }}" class="form-control @error('nisn') is-invalid @enderror" placeholder="Nisn Siswa" />
        @error("nisn")
        <div id="validationServer03Feedback" class="invalid-feedback">
            {{ $message }}
        </div>

        @enderror
        <label class="form-label">Email Address</label>
        <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address" />
        @error("email")
        <div id="validationServer03Feedback" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" />
        @error("password")
        <div id="validationServer03Feedback" class="invalid-feedback">
            {{ $message }}
        </div>

        @enderror
        <label class="form-label">Password Confirmation</label>
        <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirmation" />
        <label class="form-label">Kelas</label>
        <select name="rombel_id" class="form-control @error('rombel_id') is-invalid @enderror" required>
            <option value="">-- Pilih Kelas --</option>
            @foreach ($rombels as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>

        <label class="form-label">Jenis Kelamin</label>
        <select name="gender" class="form-control @error('gender') is-invalid @enderror" required id="">
            <option value="">Pilih Jenis Kelamin</option>
            <option value="Laki-Laki">Laki-Laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>
        <label class="form-label">Tahun Ajaran</label>
        <select name="school_year_id" class="form-control @error('school_year_id') is-invalid @enderror" required id="">
            <option value="">Pilih Tahun</option>
            @foreach ($school_years as $item)
            <option value="{{$item->id}}">{{$item->year}}</option>
            @endforeach
        </select>
        <label class="form-label">Alamat</label>
        <textarea name="address" id="" cols="30" class="form-control @error('address') is-invalid @enderror" placeholder="Masukan Alamat..." rows="5">{{ old('address') }}</textarea>
        @error("address")
        <div id="validationServer03Feedback" class="invalid-feedback">
            {{ $message }}
        </div>

        @enderror

        <!-- <label for="password_confirmation">Password Confirmation</label>
        <input class="form-control" placeholder="password confirmation" type="password" name="password_confirmation" id="password_confirmation" /> -->
        <br>
        <input class="btn btn-success" type="submit" value="Simpan" />
    </form>
</div>
@endsection