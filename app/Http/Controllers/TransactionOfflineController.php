<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\Room;
use App\Models\Student;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Exports\TransactionExport;
use Yajra\DataTables\Facades\DataTables;

use Exception;
use Midtrans\Snap;
use Midtrans\Config;

use PDF;
use Maatwebsite\Excel\Facades\Excel;

class TransactionOfflineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        if (request()->ajax()) {
            $transactions = Transaction::where('student_id', Auth::user()->student->id);

            if (!empty($request->start) && !empty($request->end)) {
                $transactions->whereBetween('tanggal_bayar', [$request->start, $request->end]);
            }
            $transactions->with('cost')->latest()->get();
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
}
