@extends('layouts.app')

@section('content')
<div class="container-fluid my-5">
    <div class="row justify-content-center">
      <div class="col-md-4">
        
        <div class="card border-0 shadow rounded">
          <div class="card-body">
            <h5 class="text-center my-3">REGISTER SISWA</h5>
            <form action="{{ route('register-student') }}" method="POST">
                @csrf
              <div class="mb-3">
                <label class="form-label">Nama</label>
                <input
                  type="text"
                  name="name"
                  value="{{ old('name') }}"
                  class="form-control @error('name') is-invalid @enderror"
                  placeholder="Nama Siswa"
                />
                @error("name")
            <div id="validationServer03Feedback" class="invalid-feedback">
              {{ $message }}
            </div>

            @enderror
              </div>
              <div class="mb-3">
                <label class="form-label">Nisn</label>
                <input
                  type="text"
                  name="nisn"
                    value="{{ old('nisn') }}"
                  class="form-control @error('nisn') is-invalid @enderror"
                  placeholder="Nisn Siswa"
                />
                @error("nisn")
            <div id="validationServer03Feedback" class="invalid-feedback">
              {{ $message }}
            </div>

            @enderror
              </div>
             
             
              <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input
                  type="email"
                    name="email"
                    value="{{ old('email') }}"
                  class="form-control @error('email') is-invalid @enderror"
                  placeholder="Email Address"
                />
                @error("email")
            <div id="validationServer03Feedback" class="invalid-feedback">
              {{ $message }}
            </div>

            @enderror
              </div>
             
              <div class="mb-3">
                <label class="form-label">Password</label>
                <input
                  type="password"
                    name="password"
                  class="form-control @error('password') is-invalid @enderror"
                  placeholder="Password"
                />
                @error("password")
            <div id="validationServer03Feedback" class="invalid-feedback">
              {{ $message }}
            </div>

            @enderror
              </div>
              
              <div class="mb-3">
                <label class="form-label">Password Confirmation</label>
                <input
                  type="password"
                  name="password_confirmation"
                  class="form-control"
                  placeholder="Password Confirmation"
                />
              </div>
              <div class="mb-3">
                <label class="form-label">Kelas</label>
                <select name="room_id" class="form-control @error('room_id') is-invalid @enderror" required>
                  <option value="">-- Pilih Kelas --</option>
                  @foreach ($rooms as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                  @endforeach
                </select>
              </div>
      
              <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="gender" class="form-control @error('gender') is-invalid @enderror" required id="">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                
              </div>

              <div class="mb-3">
                <label class="form-label">Tahun Ajaran</label>
                <select name="school_year_id" class="form-control @error('school_year_id') is-invalid @enderror" required id="">
                    <option value="">Pilih Tahun</option>
                    @foreach ($school_years as $item)
                      <option value="{{$item->id}}">{{$item->year}}</option>
                    @endforeach
                </select>
                
              </div>
              
              <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea
                name="address"
                  id=""
                  cols="30"
                  class="form-control @error('address') is-invalid @enderror"
                  placeholder="Masukan Alamat..."
                  rows="5"
                >{{ old('address') }}</textarea>
                @error("address")
            <div id="validationServer03Feedback" class="invalid-feedback">
              {{ $message }}
            </div>

            @enderror
              </div>
             
              <div class="form-group form-check">
                <input
                  type="checkbox"
                  class="form-check-input"
                  id="exampleCheck1"
                />
                <label class="form-check-label mb-1" for="exampleCheck1"
                  >Ingatkan Saya</label
                >
              </div>
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-block">
                  REGISTER
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="register mt-3 text-center">
          <p>
            Sudah punya akun ?
            <a href="/login" class="btn btn-secondary">Login</a>
          </p>
        </div>
      </div>
    </div>
  </div>
@endsection
