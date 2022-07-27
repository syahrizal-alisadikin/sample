@extends("layouts.student")
@section("title") Daftar Pembayaran @endsection
@section("content")

@if(session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif
<div class="row">
    <div class="col-md-4">
        <form action="{{ route('siswa.transaction.index') }}" method="GET" id="form-download">
            @csrf
            <div class="form-group">
              <label>Tanggal Mulai</label>
              <input type="date" value="{{ request()->start }}" class="form-control"  name="start" id="start">
            </div>
            <div class="form-group">
                <label>Tanggal Akhir</label>
                <input type="date" value="{{ request()->end }}" class="form-control"  name="end" id="end">
            </div>
         
           
            <button type="submit" class="btn btn-primary" id="search"> Filter</button>
            <button type="button" class="btn btn-success" id="downloadPDF"> Download PDF</button>
            <button type="button" class="btn btn-warning btn block" id="downloadEXCEL">
                Download EXCEL
              </button>
          </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12 text-right mb-3">
        <a href="{{url('siswa/transaction/create')}}" class="btn btn-info">Tambah</a>
    </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card card-outline card-info">
      <div class="card-body">
        <div class="table-responsive">

          <table class="table table-bordered" id="transaction-table" style="width: 100%">
              <thead>
                  <tr>
                      <th><b>No</b></th>
                      <th><b>Nominal</b></th>
                      <th><b>Nama Pembayaran</b></th>
                      <th><b>Jenis Pembayaran</b></th>
                      <th><b>Status Pembayaran</b></th>
                      <th><b>Tanggal Bayar</b></th>
                     
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
    var datatable = $('#transaction-table').DataTable({
        proccesing:true,
        // serverSide:true,
        // stateSave: true,
        // order:[[0,'desc']],
        ajax:{
          url: '{!! url()->current() !!}',
          type: 'GET',
          
          data: function(transaction){
            transaction.start = $('#start').val();
            transaction.end = $('#end').val();
          }
         
        },
        columns:[
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data:'nominal', name:'nominal'},
          { data:'cost.name', name:'cost.name'},
          { data:'jenis_pembayaran', name:'jenis_pembayaran'},
          { data:'status', name:'status'},
          { data:'tanggal_bayar', name:'tanggal_bayar'},
          
        ]
    })

    $("#search").on('click',function (e) {
            $('#transaction-table').DataTable().draw(true);
        });

            // Download PDF
    $("#downloadPDF").on('click',function (e) {
      $('#form-download').attr('action', '{{route('transaction.downloadPDF')}}');
      document.getElementById('form-download').submit();
    });
    // Download EXCEL
    $("#downloadEXCEL").on('click',function (e) {
      $('#form-download').attr('action', '{{route('transaction.downloadEXCEL')}}');
      document.getElementById('form-download').submit();
    });
  </script>
@endpush