@extends("layouts.global")
@section("title")Tambah Data Pengguna @endsection
@section("content")
<div class="col-md-8">
    @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('users.store')}}" method="POST">
        @csrf
        <label for="name">Nama</label>
        <input class="form-control" placeholder="Nama Lengkap" type="text" name="name" id="name" />
        <br>
        <label for="username">Username</label>
        <input class="form-control" placeholder="username" type="text" name="username" id="username" />
        <br>

        <label for="">Role</label>
        <br>
        <input type="checkbox" name="roles[]" id="ADMIN" value="ADMIN">
        <label for="ADMIN">Administrator</label>
        <input type="checkbox" name="roles[]" id="STAFF" value="STAFF">
        <label for="STAFF">Staff TU</label>
        <input type="checkbox" name="roles[]" id="SISWA" value="SISWA">
        <label for="SISWA">Siswa</label>
        <br>
        <br>
        <label for="avatar">Avatar image</label>
        <br>
        <input id="avatar" name="avatar" type="file" class="form-control">
        <hr class="my-3">
        <label for="email">Email</label>
        <input class="form-control" placeholder="user@mail.com" type="text" name="email" id="email" />
        <br>
        <label for="password">Password</label>
        <input class="form-control" placeholder="password" type="password" name="password" id="password" />
        <br>
        <!-- <label for="password_confirmation">Password Confirmation</label>
        <input class="form-control" placeholder="password confirmation" type="password" name="password_confirmation" id="password_confirmation" /> -->
        <br>
        <input class="btn btn-success" type="submit" value="Simpan" />
    </form>
</div>
@endsection