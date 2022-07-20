@extends("layouts.student")
@section("title") Daftar Friend @endsection
@section("content")

@if(session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif
{{-- <div class="row">
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
</div> --}}

<div class="row">
    <div class="col-md-12 text-right mb-3">
        <a href="{{route('users.create')}}" class="btn btn-info">Tambah</a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="friend-table" style="width: 100%">
                        <thead>
                            <tr>
                                <th><b>Nama</b></th>
                                <th><b>Alamat</b></th>
                                <th><b>Email</b></th>
                                <th><b>Jenis Kelamin</b></th>
                                
                            </tr>
                        </thead>
                    
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('javascript')
<script>
    var datatable = $('#friend-table').DataTable({
        proccesing:true,
        serverSide:true,
        ordering:true,
        ajax:{
          url: '{!! url()->current() !!}',
        },
        columns:[
          { data:'name', name:'name'},
          { data:'alamat', name:'alamat'},
          { data:'user.email', name:'user.email'},
          { data:'gender', name:'gender'},
       
          
         
          
        ]
    })
  </script>
@endpush