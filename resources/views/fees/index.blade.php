@extends("layouts.global")
@section("title") Daftar Biaya @endsection
@section("content")

@if(session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif


<div class="row">
    <div class="col-md-12 text-right mb-3">
        <a href="{{route('fees.create')}}" class="btn btn-info">Tambah</a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="fee-table" style="width: 100%">
                        <thead>
                            <tr>
                                <th><b>Nama</b></th>
                                <th><b>Nominal</b></th>
                                <th><b>Tingkat</b></th>
                                <th><b>Tahun</b></th>
                                <th><b>Actions</b></th>
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
    var datatable = $('#fee-table').DataTable({
        proccesing: true,
        serverSide: true,
        ordering: true,
        ajax: {
            url: '{!! url()->current() !!}',
        },
        columns: [{
                data: 'name',
                name: 'name'
            },
            {
                data: 'nominal',
                name: 'nominal'
            },
            {
                data: 'level.name',
                name: 'level.name'
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
</script>
@endpush