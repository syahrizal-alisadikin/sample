@extends("layouts.student")
@section("title") Daftar Transaction @endsection
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
        <a href="{{url('siswa/transaction/create')}}" class="btn btn-info">Tambah</a>
    </div>
</div>

<table class="table table-bordered" id="transaction-table" style="width: 100%">
    <thead>
        <tr>
            <th><b>Nama</b></th>
           
        </tr>
    </thead>

</table>

@endsection

@push('javascript')
<script>
    var datatable = $('#transaction-table').DataTable({
        proccesing:true,
        serverSide:true,
        ordering:true,
        ajax:{
          url: '{!! url()->current() !!}',
        },
        columns:[
          { data:'id', name:'id'},
       
          
         
          
        ]
    })
  </script>
@endpush