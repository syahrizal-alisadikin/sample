@extends("layouts.global")
@section("title") Daftar Tagihan @endsection
@section("content")

<div class="col-md-4">
    <Label>Nama siswa</Label>
    <select name="" id="siswa" class="form-control filter">
        <option value="">-- Pilih Nama Siswa --</option>
        @foreach ($siswa as $item)
        <option value="{{$item->id}}">{{$item->name}}-{{$item->nisn}}</option>
        @endforeach
    </select>
</div>
@endsection
@push('javascript')
<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('#siswa').select2();
    });
</script>
@endpush