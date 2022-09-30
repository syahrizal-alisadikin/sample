<?php

namespace App\Http\Controllers;

use PDF;
use Exception;
use Midtrans\Snap;
use App\Models\Cost;
use App\Models\Room;
use Midtrans\Config;

use App\Models\Student;
use App\Models\Transaction;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\PDF as DomPDFPDF;

use Yajra\DataTables\Facades\DataTables;
use App\Exports\TransactionOfflineExport;
use App\Models\Fee;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use PhpOffice\PhpSpreadsheet\Writer\Pdf as WriterPdf;

use Carbon\Carbon;

class TransactionOfflineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)

    {
        if (request()->ajax()) {

            $transactions = Transaction::query();

            if (!empty($request->start) && !empty($request->end)) {
                $transactions->whereBetween('tanggal_bayar', [$request->start, $request->end]);
            }
            $transactions->with('fee', 'student.rombel')->latest()->get();
            return DataTables::of($transactions)
                ->addIndexColumn()
                // ->addColumn('actions', function ($transactions) {
                //     $button = " <a class='btn btn-primary text-white btn-sm' id='".$transactions->id."'>Ubah</a>";
                //     $button .= " <a class='btn btn-danger text-white btn-sm' id='".$transactions->id."'>Hapus</a>";
                //     return $button;
                // })
                ->addColumn('actions', function ($item) {
                    return '
                       
                                <form action="' . route('transaction-offlines.destroy', $item->id) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button type="submit" class="btn btn-danger dropdown-item text-white">
                                    Hapus
                                    </button>
                            
                        
                        ';
                })


                ->editColumn('tanggal_bayar', function ($transaction) {
                    return $transaction->tanggal_bayar ?? "-";
                })
                ->rawColumns(['actions'])

                ->make(true);
        }
        return view('transaction-offlines.index');
    }

    public function nominal1($id)
    {
        $cost = Fee::find($id);

        return response()->json([
            'nominal1' => $cost->nominal,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cost = Fee::all();
        $student = Student::all();
        $room = Room::all();
        return view('transaction-offlines.create', [
            'cost' => $cost,
            'student' => $student,
            'room' => $room
        ]);
        return \view('transaction-offlines.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $transaction = Transaction::create([
            'student_id' => $request->student_id,
            'cost_id' => $request->cost_id,
            'nominal' => $request->nominal,
            'jenis_pembayaran' => 'OFFLINE',
            'status' => 'SUCCESS',
            'tanggal_bayar' => date('Y-m-d')


        ]);
        return redirect()->route('transaction-offlines.create')->with(
            'status',
            'Data Pembayaran Siswa berhasil ditambah'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $cost = Cost::all();
        // $student = Room::all();
        // $transaction = \App\Models\Transaction::findOrFail($id);
        // return \view('transaction-offlines.edit', compact('cost', 'transaction', 'student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = \App\Models\Transaction::findOrFail($id);

        $transaction->delete();
        return redirect()->route('transaction-offlines.index')->with('status', 'Data Pembayaran berhasil Dihapus');
    }

    public function downloadPDF1(Request $request)
    {
        $transactions = Transaction::query()
            ->whereBetween('tanggal_bayar', [$request->start, $request->end])
            ->with('cost', 'student.room')->latest()->get();

        $pdf = PDF::loadView('transaction-offlines.pdf', compact('transactions'));

        return $pdf->download('transaction.pdf');
    }

    public function downloadEXCEL1(Request $request)
    {
        $transactions = Transaction::query()
            ->whereBetween('tanggal_bayar', [$request->start, $request->end])
            ->with('cost', 'student.room')->latest()->get();

        return Excel::download(new TransactionOfflineExport($transactions), 'transaction.xlsx');
    }
}
