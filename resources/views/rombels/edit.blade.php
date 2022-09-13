@extends("layouts.global")
@section("title") Ubah Data Kelas @endsection
@section("content")
<div class="col-md-8">
    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif
    <form class="bg-white shadow-sm p-3" action="{{route('rombels.update', [$rombel->id])}}" method="POST">
        @csrf
        <input type="hidden" value="PUT" name="_method">
        <label for="name">Rombel</label>
        <input value="{{$rombel->name}}" class="form-control" placeholder="Name" type="text" name="name" id="name" />
        <label class="form-label">Tingkat</label>
        <select name="level_id" class="form-control @error('level_id') is-invalid @enderror" required>
            <option value="">-- Pilih Tingkat --</option>
            @foreach ($levels as $item)
            <option value="{{$item->id}}" {{ $item->id == $rombel->level_id ? "selected" : "" }}>{{$item->name}}</option>
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