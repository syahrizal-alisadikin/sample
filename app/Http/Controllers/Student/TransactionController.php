<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Cost;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Auth;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $transactions = Transaction::where('student_id', Auth::user()->student->id);

            return DataTables::of($transactions)
                ->make();
        }
        return view('pages.transaction.index');
    }

    public function create()
    {
        $costs = Cost::all();
        return view('pages.transaction.create', compact('costs'));
    }

    public function nominal($id)
    {
        $cost = Cost::find($id);

        return response()->json([
            'nominal' => $cost->nominal,
        ]);
    }
}
