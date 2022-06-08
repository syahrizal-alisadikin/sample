@extends('layouts.global')
@section('title') Ubah Data Pengguna @endsection
@section('content')

<div class="col-md-8">
    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif

    <form class="bg-white shadow-sm p-3" action="{{route('users.update', [$user->id])}}" method="POST">
        @csrf
        <input type="hidden" value="PUT" name="_method">
        <label for="name">Nama</label>
        <input value="{{$user->name}}" class="form-control" placeholder="Full Name" type="text" name="name" id="name" />
        <br>

        <label for="username">Username</label>
        <input value="{{$user->username}}" disabled class="form-control" placeholder="username" type="text" name="username" id="username" />
        <br>
        <label for="">Status</label>
        <br />
        <input {{$user->status == "ACTIVE" ? "checked" : ""}} value="ACTIVE" type="radio" class="form-control" id="active" name="status">
        <label for="active">Active</label>
        <input {{$user->status == "INACTIVE" ? "checked" : ""}} value="INACTIVE" type="radio" class="form-control" id="inactive" name="status">
        <label for="inactive">Inactive</label>
        <br><br>

        <label for="">Role</label>
        <br>
        <input type="checkbox" {{in_array("ADMIN", json_decode($user->roles)) ? "checked" : ""}} name="roles[]" id="ADMIN" value="ADMIN">
        <label for="ADMIN">Administrator</label>
        <input type="checkbox" {{in_array("STAFF", json_decode($user->roles)) ? "checked" : ""}} name="roles[]" id="STAFF" value="STAFF">
        <label for="STAFF">Staff</label>
        <input type="checkbox" {{in_array("SISWA", json_decode($user->roles)) ? "checked" : ""}} name="roles[]" id="SISWA" value="SISWA">
        <label for="SISWA">Siswa</label>
        <br>
        <br>
        <label for="avatar">Avatar image</label>
        <br>
        Current avatar: <br>
        @if($user->avatar)
        <img src="{{asset('storage/'.$user->avatar)}}" width="120px" />
        <br>
        @else
        No avatar
        @endif
        <br>
        <input id="avatar" name="avatar" type="file" class="form-control">
        <small class="text-muted">Kosongkan jika tidak ingin mengubah
            avatar</small>

        <hr class="my-3">

        <label for="email">Email</label>
        <input value="{{$user->email}}" disabled class="form-control" placeholder="user@mail.com" type="text" name="email" id="email" />
        <br>

        <input class="btn btn-success" type="submit" value="Simpan" />
    </form>
</div>
@endsection