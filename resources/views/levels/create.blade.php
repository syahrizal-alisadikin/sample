@extends("layouts.global")
@section("title") Tambah Data Tingkat @endsection
@section("content")
<div class="col-md-8">
    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif
    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('levels.store')}}" method="POST">
        @csrf
        <label>Tingkat</label><br>
        <input type="number" class="form-control" name="name" required /> <br>
        <input type="submit" class="btn btn-success" value="Tambah" />
    </form>
</div>
@endsection

<!-- @push('javascript')
<script>
</script>
@endpush -->