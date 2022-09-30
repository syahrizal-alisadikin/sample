@extends("layouts.global")
@section("title") Daftar Tagihan @endsection
@section("content")

<div class="col-md-4 mb-3">
    <Label>Nama siswa</Label>
    <select name="" id="student_id" class="form-control filter">
        <option value="">-- Pilih Nama Siswa --</option>
        @foreach ($siswa as $item)
        <option value="{{$item->id}}">{{$item->name}}-{{$item->nisn}}</option>
        @endforeach
    </select>
</div>
@if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
    @endif
<div id="datatables" style="display:none">
    <table class="table table-bordered" id="transaction-table" style="width: 100%; ">
        <thead>
            <tr>
                <th><b>No</b></th>
                <th><b>Nama</b></th>
                <th><b>Kelas</b></th>
                <th><b>Nominal</b></th>
                <th><b>Nama Pembayaran</b></th>
                <th><b>Jenis Pembayaran</b></th>
                <th><b>Status Pembayaran</b></th>
                <th><b>Tanggal Bayar</b></th>
                <th style="width: 20%"><b>Actions</b></th>
                
    
            </tr>
        </thead>
    
    </table>
</div>
@endsection
@push('javascript')
<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('#student_id').select2();

        var datatable = $('#transaction-table').DataTable({
        proccesing: true,
        serverSide: true,
        stateSave: true,
        order: [
            [0, 'desc']
        ],
        ajax: {
            url: '{!! url()->current() !!}',
            type: 'GET',

            data: function(transaction) {
                transaction.student_id = $('#student_id').val();
            }

        },
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'student.name',
                name: 'student.name'
            },
            {
                data: 'student.rombel.name',
                name: 'student.rombel.name'
            },
            {
                data: 'nominal',
                name: 'nominal'
            },
            {
                data: 'fee.name',
                name: 'fee.name'
            },
            {
                data: 'jenis_pembayaran',
                name: 'jenis_pembayaran'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'tanggal_bayar',
                name: 'tanggal_bayar'
            },
            {
                data: 'actions',
                name: 'actions'
            },

        ]
        });
    });

    $('#student_id').change(function() {
        if ($('#student_id').val() != '') {
            $('#datatables').show();

            $('#transaction-table').DataTable().ajax.reload();
        } else {
            $('#datatables').hide();
            // display none transaction table


        }
    });
</script>
@endpush

