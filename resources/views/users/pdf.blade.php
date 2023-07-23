

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th><b>Nama</b></th>
                <th><b>Username</b></th>
                <th><b>Email</b></th>
                <th><b>Status</b></th>
                <th><b>Avatar</b></th>
                <th><b>Role</b></th>
                <th><b>Actions</b></th>
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
        
    </table>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <script>
        $(document).ready(function(){
        window.print();
        window.onafterprint = function(){
          window.close();
          }
     })
    </script>
  </body>
</html>