@extends('layouts.global')
@section('title') Ubah Data Pembayaran Siswa @endsection
@section('content')

<div class="col-md-8">
    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif

    <form class="bg-white shadow-sm p-3" action="{{route('transaction-offlines.update', [$transaction->id])}}" method="POST">
        @csrf
        <label class="form-label">Nama Siswa</label>
        <select name="student_id" class="form-control @error('student_id') is-invalid @enderror" required>
            <option value="">-- Pilih Siswa --</option>
            @foreach ($student as $item)
            <option value="{{$item->id}}" {{ $item->id == $transaction->student_id ? "selected" : "" }}>{{$item->name}}</option>
            @endforeach
        </select>
        <label class="form-label">Nama Pembayaran</label>
        <select name="cost_id" class="form-control @error('cost_id') is-invalid @enderror" required>
            <option value="">-- Pilih Pembayaran --</option>
            @foreach ($cost as $item)
            <option value="{{$item->id}}" {{ $item->id == $transaction->cost_id ? "selected" : "" }}>{{$item->name}}</option>
            @endforeach
        </select>

        <br>
        <input class=" btn btn-success" type="submit" value="Simpan" />
    </form>
</div>
@endsection