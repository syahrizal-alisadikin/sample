@extends("layouts.global")
@section("title") Daftar Tahun @endsection
@section("content")

@if(session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif


<div class="row">
    <div class="col-md-12 text-right mb-3">
        <a href="{{route('school-years.create')}}" class="btn btn-info">Tambah</a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="year-table" style="width: 100%">
                        <thead>
                            <tr>
                                <th><b>Tahun</b></th>
                                <th><b>Keterangan</b></th>
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
    var datatable = $('#year-table').DataTable({
        proccesing: true,
        serverSide: true,
        ordering: true,
        ajax: {
            url: '{!! url()->current() !!}',
        },
        columns: [{
                data: 'year',
                name: 'year'
            },
            {
                data: 'description',
                name: 'description'
            },
            {
                data: 'actions',
                name: 'actions'
            },


        ]
    })
</script>
@endpush