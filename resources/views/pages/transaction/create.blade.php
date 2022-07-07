@extends("layouts.student")
@section("title") Tambah Data Transaction  @endsection
@section("content")
<div class="col-md-8">
    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif
    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('costs.store')}}" method="POST">
        @csrf
        <label for="">Transaction</label> <br>
        <select name="cost_id" class="form-control" required id="cost_id">
            <option value="">Pilih Transaction</option>
            @foreach($costs as $cost)
            <option value="{{$cost->id}}">{{$cost->name }} </option>
            @endforeach
        </select> <br>
        <label>Nominal</label><br>
        <input type="text" class="form-control" name="nominal" value="0" id="nominal" readonly />
        <br>
        <label for="">Jenis Pembayaran</label> <br>
        <select name="jenis_pembayaran" class="form-control" required id="">
            <option value="">Pilih Pembayaran</option>
            <option value="OFFLINE">OFFLINE</option>
            <option value="ONLINE">ONLINE</option>
        </select> <br>
        
        <input type="submit" class="btn btn-success" value="Simpan" />
    </form>
</div>

@endsection

@push('javascript')
<script>
   $("#cost_id").change(function(){
    var cost_id = $("#cost_id").val();
    if(cost_id != ""){
        $.ajax({
        url: "{{url('siswa/transaction/get-nominal')}}/"+cost_id,
        type: "GET",
        dataType: "json",
        success: function(data){
            console.log(data);
            $("#nominal").val(data.nominal);
        }
    });
    }else{
        $("#nominal").val("0");
    }

   });
  </script>
@endpush
