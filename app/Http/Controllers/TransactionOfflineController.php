<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\Room;
use App\Models\Student;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Exports\TransactionExport;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Yajra\DataTables\Facades\DataTables;

use Exception;
use Midtrans\Snap;
use Midtrans\Config;

use PDF;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Pdf as WriterPdf;

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
            $transactions->with('cost', 'student.room')->latest()->get();
            return DataTables::of($transactions)
                ->addIndexColumn()

                ->editColumn('tanggal_bayar', function ($transaction) {
                    return $transaction->tanggal_bayar ?? "-";
                })
                ->rawColumns(['tanggal_bayar'])

                ->make(true);
        }
        return view('transaction-offlines.index');
    }

    public function nominal1($id)
    {
        $cost = Cost::find($id);

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
        $cost = Cost::all();
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
        //
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
        //
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
        //
    }

    public function downloadPDF1(Request $request)
    {
        $transactions = Transaction::query()
            ->whereBetween('tanggal_bayar', [$request->start, $request->end])
            ->with('cost')->latest()->get();

        $pdf = PDF::loadView('pages.transaction.pdf', compact('transactions'));
        return $pdf->download('transaction.pdf');
    }

    public function downloadEXCEL1(Request $request)
    {
        $transactions = Transaction::query()
            ->whereBetween('tanggal_bayar', [$request->start, $request->end])
            ->with('cost')->latest()->get();

        return Excel::download(new TransactionExport($transactions), 'transaction.xlsx');
    }
}
