@extends("layouts.global")
@section("title") Ubah Data Biaya @endsection
@section("content")
<div class="col-md-8">
    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif
    <form class="bg-white shadow-sm p-3" action="{{route('fees.update', [$fee->id])}}" method="POST">
        @csrf
        <input type="hidden" value="PUT" name="_method">
        <label for="name">Nama Biaya</label>
        <input value="{{$fee->name}}" class="form-control" placeholder="Name" type="text" name="name" id="name" />
        <label for="name">Nominal</label>
        <input value="{{$fee->nominal}}" class="form-control" placeholder="Nominal" type="text" name="nominal" id="nominal" />
        <label class="form-label">Tingkat</label>
        <select name="level_id" class="form-control @error('level_id') is-invalid @enderror" required>
            <option value="">-- Pilih Tingkat --</option>
            @foreach ($levels as $item)
            <option value="{{$item->id}}" {{ $item->id == $fee->level_id ? "selected" : "" }}>{{$item->name}}</option>
            @endforeach
        </select>
        <label class="form-label">Tahun</label>
        <select name="school_year_id" class="form-control @error('school_year_id') is-invalid @enderror" required>
            <option value="">-- Pilih Tahun --</option>
            @foreach ($years as $item)
            <option value="{{$item->id}}" {{ $item->id == $fee->school_year_id ? "selected" : "" }}>{{$item->year}}</option>
            @endforeach
        </select>
        <br>
        <input class="btn btn-success" type="submit" value="Simpan" />
    </form>
</div>
@endsection

<!-- @push('javascript')
<script>
</script>
@endpush -->