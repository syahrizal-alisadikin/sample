@extends("layouts.global")
@section("title") Tambah Data Biaya @endsection
@section("content")
<div class="col-md-8">
    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif
    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('fees.store')}}" method="POST">
        @csrf
        <label>Nama Biaya</label><br>
        <input type="text" class="form-control" name="name" required /> <br>
        <label>Nominal</label><br>
        <input type="number" class="form-control" name="nominal" required /> <br>
        <label class="form-label">Tingkat</label>
        <select name="level_id" class="form-control @error('level_id') is-invalid @enderror">
            <option value="">-- Pilih Tingkat --</option>
            @foreach ($levels as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
        <br>
        <label class="form-label">Tahun</label>
        <select name="school_year_id" class="form-control @error('school_year_id') is-invalid @enderror" required>
            <option value="">-- Pilih Tahun --</option>
            @foreach ($years as $item)
            <option value="{{$item->id}}">{{$item->year}}</option>
            @endforeach
        </select>
        <br>
        <input type="submit" class="btn btn-success" value="Tambah" />
    </form>
</div>
@endsection

<!-- @push('javascript')
<script>
</script>
@endpush -->