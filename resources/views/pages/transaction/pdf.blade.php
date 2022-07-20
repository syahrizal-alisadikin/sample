<!DOCTYPE html>
<html>
<head>
	<title>Orders </title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
{{-- <style type="text/css">
    table tr td,
    table tr th{
        font-size: 9pt;
    }
</style> --}}
<body>
<div class="row">
  <div class="container-fluid">
      <div class="card p-2">
          <h4 class="text-center">Data Pembayaran {{ Auth::user()->name }} </h4>
          <div class="card-body table-responsive">
            <table class="table align-items-center mb-0"  style="width:100%; !important">
                <thead>
                    <tr>
                        <th><b>Nominal</b></th>
                        <th><b> Pembayaran</b></th>
                        <th><b>Jenis </b></th>
                        <th><b>Status </b></th>
                        <th><b>Tanggal </b></th>
                       
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $item)
                        <tr>
                            <td>Rp{{ number_format($item->nominal,0,",",".") }}</td>
                            <td>{{ $item->cost->name }}</td>
                            <td>{{ $item->jenis_pembayaran }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->tanggal_bayar }}</td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="10">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
              </table>
          </div>
      </div>
  </div>
</div>
	


</body>
</html>