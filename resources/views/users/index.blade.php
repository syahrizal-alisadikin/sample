@extends("layouts.global")
@section("title") Daftar Pengguna @endsection
@section("content")

@if(session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif
<div class="row">
    <div class="col-md-6">
        <form action="{{route('users.index')}}">
            <div class="input-group mb-3">
                <input value="{{Request::get('keyword')}}" name="keyword" class="form-control col-md-8" type="text" placeholder="Temukan Pengguna berdasarkan e-mail" />
                <div class="input-group-append">
                    <input type="submit" value="Filter" class="btn btn-light ">
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12 text-right mb-3">
        <a href="{{route('users.create')}}" class="btn btn-info">Tambah</a>
    </div>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th><b>Nama</b></th>
            <th><b>Username</b></th>
            <th><b>Email</b></th>
            <th><b>Status</b></th>
            <th><b>Avatar</b></th>
            <th><b>Role</b></th>
            <th><b>Action</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->username}}</td>
            <td>{{$user->email}}</td>
            <td>
                @if($user->status == "ACTIVE")
                <span class="badge badge-warning">
                    {{$user->status}}
                </span>
                @else
                <span class="badge badge-dark">
                    {{$user->status}}
                </span>
                @endif
            </td>
            <td>
                @if($user->avatar)
                <img src="{{asset('storage/'.$user->avatar)}}" width="70px" />
                @else
                N/A
                @endif
            </td>
            <td>
                {{ $user->roles }}
                {{-- @foreach (json_decode($user->roles) as $role)
                &middot; {{$role}} <br>
                @endforeach --}}
            </td>
            <td>
                <a class="btn btn-primary text-white btn-sm" href="{{route('users.edit', [$user->id])}}">Ubah</a>

                <form onsubmit="return confirm('Yakin ingin menghapus Data?')" class="d-inline" action="{{route('users.destroy', [$user->id])}}" method="POST">
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
            <td colspan=10>
                {{$users->appends(Request::all())->links()}}
            </td>
        </tr>
    </tfoot>
</table>

@endsection