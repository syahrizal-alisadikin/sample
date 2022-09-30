@extends('layouts.global')
@section('title')  Pembayaran Siswa @endsection
@section('content')

<div class="col-md-8">
    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif

    <form class="bg-white shadow-sm p-3" action="{{route('bills.update', [$transaction->id])}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="form-label">Nama Siswa</label>
            <select name="student_id" class="form-control @error('student_id') is-invalid @enderror" required>
                <option value="{{ $transaction->student_id }}">{{ $transaction->student->name }}</option>
                
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Nama Pembayaran</label>
        <select name="cost_id" class="form-control @error('cost_id') is-invalid @enderror" required>
            <option value="{{ $transaction->cost_id }}">{{ $transaction->fee->name }}</option>
        </select>
        </div>

        <div class="form-group">
            <label>Nominal</label><br>
            <input type="text" class="form-control" name="nominal" value="{{ $transaction->nominal }}" id="nominal1" readonly /> 
        </div>
            <input class=" btn btn-success" type="submit" value="Bayar" />
    </form>
</div>
@endsection