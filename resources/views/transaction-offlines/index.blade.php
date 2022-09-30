@extends('layouts.global')
@section('title') Daftar Pembayaran @endsection

@section('content')
@if(session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif
<div class="row">
    <div class="col-md-4">
        <form action="#" method="GET" id="form-download">
            @csrf
            <div class="form-group">
                <label>Tanggal Mulai</label>
                <input type="date" value="{{ request()->start }}" class="form-control" name="start" id="start">
            </div>
            <div class="form-group">
                <label>Tanggal Akhir</label>
                <input type="date" value="{{ request()->end }}" class="form-control" name="end" id="end">
            </div>


            <button type="buttom" class="btn btn-success" id="downloadPDF1"> Download PDF</button>
            <button type="button" class="btn btn-warning btn block" id="downloadEXCEL1">
                Download EXCEL
            </button>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12 text-right mb-3">
        <a href="{{route('transaction-offlines.create')}}" class="btn btn-info">Tambah</a>
    </div>
</div>

<table class="table table-bordered" id="transaction-table" style="width: 100%">
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
            <th><b>Actions</b></th>
            

        </tr>
    </thead>

</table>

@endsection

@push('javascript')
<script>
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
                transaction.start = $('#start').val();
                transaction.end = $('#end').val();
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
    })


    // Download PDF
    $("#downloadPDF1").on('click', function(e) {
        $('#form-download').attr('action', '{{route('transactionofflines.downloadPDF1')}}');
        document.getElementById('form-download').submit();
    });
    $("#downloadEXCEL1").on('click', function(e) {
        $('#form-download').attr('action', '{{route('transactionofflines.downloadEXCEL1')}}');
        document.getElementById('form-download').submit();
    });
</script>
@endpush
