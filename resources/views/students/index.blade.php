@extends('layouts.global')
@section('title') Daftar Siswa @endsection

@section('content')
@if(session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif

<div class="row">
    <div class="col-md-12">
        <h6>Filter Siswa</h6>
    </div>
    <div class="col-md-4">
        <Label>Kelas</Label>
        <select name="" id="kelas" class="form-control filter">
            <option value="">-- Filter Kelas --</option>
            @foreach ($rombels as $item)
            <option value="{{$item->id}}">{{$item->level->name}}{{$item->name}}</option>
            @endforeach
        </select>
        <br>
        <!-- <button type="button" class="btn btn-primary" id="search"> Filter</button> -->
    </div>
    <div class="col-md-4">
        <Label>Tahun</Label>
        <select name="tahun" id="tahun" class="form-control filter">
            <option value="">-- Filter Tahun --</option>
            @foreach ($years as $item)
            <option value="{{$item->id}}">{{$item->year}}</option>
            @endforeach
        </select>
        <br>
        <!-- <button type="button" class="btn btn-primary" id="search1"> Filter</button> -->
    </div>

</div>

<div class="row">
    <div class="col-md-12 text-right mb-3">
        <a href="{{route('students.create')}}" class="btn btn-info">Tambah</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered" id="student-table" style="width: 100%">
                        <thead>
                            <tr>

                                <th><b>NISN</b></th>
                                <th><b>Nama Siswa</b></th>
                                <th><b>Alamat</b></th>
                                <th><b>Jenis Kelamin</b></th>
                                <th><b>Kelas</b></th>
                                <th><b>Tahun</b></th>
                                <th><b>Action</b></th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('javascript')
<script>
    var datatable = $('#student-table').DataTable({
        proccesing: true,
        serverSide: true,
        // ordering: true,

        ajax: {
            url: '{!! url()->current() !!}',
            data: function(d) {
                d.kelas = $('#kelas').val()
                d.tahun = $('#tahun').val()

            }
        },
        columns: [{
                data: 'nisn',
                name: 'nisn'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'address',
                name: 'address'
            },
            {
                data: 'gender',
                name: 'gender'
            },
            {
                data: 'kelas',
                name: 'kelas'
            },

            {
                data: 'years.year',
                name: 'years.year'
            },
            {
                data: 'actions',
                name: 'actions'
            },



        ]
    })
    $("#kelas").change(function() {
        $('#student-table').DataTable().draw(true);
    });

    $("#tahun").change(function() {
        $('#student-table').DataTable().draw(true);
    });
    // $("#search").on('click', function(e) {
    //     $('#student-table').DataTable().draw(true);

    // });
    // $("#search1").on('click', function(e) {
    //     $('#student-table').DataTable().draw(true);

    // });
    $(document).ready(function() {
        $('#kelas').select2();
    });
    $(document).ready(function() {
        $('#tahun').select2();
    });
    
</script>
@endpush