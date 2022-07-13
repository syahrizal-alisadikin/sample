@extends('layouts.global')
@section('title') Tambah Data Transaksi Offline @endsection
@section('content')
<div class="col-md-8">
    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif
    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('transaction-offlines.store')}}" method="POST">
        @csrf
        <div class="card-body">
            <label class="form-label">Pilih</label>
            <select name="select" class="form-control" onchange="myTransaction()" required id="select">
                <option value="siswa">Per Siswa</option>
                <option value="kelas" @error('room_id') selected @enderror>Per Kelas</option>
            </select>
        </div>

        <div class="card-body" id="student" @error('room_id') style="display: none" @enderror>
            <label>Nama Siswa</label>
            <select name="student_id" class="form-control">
                <option value="">Pilih Siswa</option>
                @foreach ($student as $s)
                <option value="{{ $s->id }}">{{ $s->name }}</option>
                @endforeach
            </select>
            @error('student_id')
            <div class="invalid-feedback" style="display: block">
                {{ $message }}
            </div>
            @enderror

        </div>

        <div class="card_body" id="kelas" @error('kelas_id') style="display: block !important" @else style="display: none" @enderror>
            <label>KELAS</label>
            <select name="room_id" class="form-control ">
                <option value="">Pilih Kelas</option>
                @foreach ($room as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        @error('room_id')
        <div class="invalid-feedback" style="display: block">
            {{ $message }}
        </div>
        @enderror
        <div class="card-body">
            <label>Nama Pembayaran</label>
            <select name="cost_id" class="form-control cost_id" id="cost_id">
                <option value="">Pilih Pembayaran</option>
                @foreach ($cost as $t)
                <option value="{{ $t->id }}">{{ $t->name }}</option>
                @endforeach
            </select>
            @error('cost_id')
            <div class="invalid-feedback" style="display: block">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="card-body">
            <label>Nominal</label><br>
            <input type="text" class="form-control" name="nominal" value="0" id="nominal" readonly />
        </div>

        <div class="card-body">
            <label for="">Jenis Pembayaran</label> <br>
            <select name="jenis_pembayaran" class="form-control" required id="">
                <option value="">Pilih Pembayaran</option>
                <option value="OFFLINE">OFFLINE</option>
                <option value="ONLINE">ONLINE</option>
            </select> <br>
        </div>
        <div class="card-body"><input class="btn btn-success" type="submit" value="Simpan" />
        </div>

    </form>
</div>

@endsection
@push('javascript')
<script>
    $("#cost_id").change(function() {
        var cost_id = $("#cost_id").val();
        if (cost_id != "") {
            $.ajax({
                url: "{{url('siswa/transaction/get-nominal')}}/" + cost_id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $("#nominal").val(data.nominal);
                }
            });
        } else {
            $("#nominal").val("0");
        }
    });
</script>
@endpush