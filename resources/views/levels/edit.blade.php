@extends("layouts.global")
@section("title") Ubah Data Tingkat @endsection
@section("content")
<div class="col-md-8">
    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif
    <form class="bg-white shadow-sm p-3" action="{{route('levels.update', [$level->id])}}" method="POST">
        @csrf
        <input type="hidden" value="PUT" name="_method">
        <label for="name">Tingkat</label>
        <input value="{{$level->name}}" class="form-control" placeholder="Name" type="number" name="name" id="name" />
        <br>
        <input class="btn btn-success" type="submit" value="Simpan" />
    </form>
</div>
@endsection

<!-- @push('javascript')
<script>
</script>
@endpush -->