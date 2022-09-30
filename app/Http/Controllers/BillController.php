<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Yajra\DataTables\Facades\DataTables;

class BillController extends Controller
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

            $transactions->when($request->student_id, function ($query) use ($request) {
                $query->where('student_id', $request->student_id);
            });
            $transactions->with('fee', 'student.rombel')->latest();
            return DataTables::of($transactions)
                ->addIndexColumn()
                // ->addColumn('actions', function ($transactions) {
                //     $button = " <a class='btn btn-primary text-white btn-sm' id='".$transactions->id."'>Ubah</a>";
                //     $button .= " <a class='btn btn-danger text-white btn-sm' id='".$transactions->id."'>Hapus</a>";
                //     return $button;
                // })
                ->addColumn('actions', function ($item) {

                    //    button delete 
                    $button = '
                    <form  action="' . route('bills.destroy', $item->id) . '" method="POST">' . method_field('delete') . csrf_field() . '<button type="submit" class="btn btn-danger text-white btn-sm mr-2">Hapus</button>';

                    if ($item->status == 'PENDING') {
                        $button .= '<a class="btn btn-primary text-white btn-sm" type="hidden" href="' . route('bills.edit', $item->id) . '">Bayar</a>';
                    }
                    //    button edit

                    return $button;
                })


                ->editColumn('tanggal_bayar', function ($transaction) {
                    return $transaction->tanggal_bayar ?? "-";
                })
                ->rawColumns(['actions'])

                ->make(true);
        }
        $siswa = Student::all();
        return view('bills.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $transaction = Transaction::with('student')->find($id);
        return view('bills.edit', compact('transaction'));
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
        $transaction = Transaction::with('student')->find($id);
        $transaction->update([
            'status' => 'SUCCESS',
            'tanggal_bayar' => date('Y-m-d'),
        ]);
        return redirect()->route('bills.index')->with('success', 'Pembayaran ' . $transaction->student->name . ' Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete transaction
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
        return redirect()->route('bills.index')->with('success', 'Data berhasil dihapus');
    }
}
