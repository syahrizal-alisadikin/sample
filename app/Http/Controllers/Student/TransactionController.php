<?php

namespace App\Http\Controllers\Student;

use App\Exports\TransactionExport;
use App\Http\Controllers\Controller;
use App\Models\Cost;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Auth;
use Yajra\DataTables\Facades\DataTables;

use Exception;
use Midtrans\Snap;
use Midtrans\Config;

use PDF;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $transactions = Transaction::query();

            if (!empty($request->start) && !empty($request->end)) {
                $transactions->whereBetween('tanggal_bayar', [$request->start, $request->end]);
            }
            $transactions->where('student_id', Auth::user()->student->id)->with('cost')->latest();
            return DataTables::of($transactions)
                ->addIndexColumn()

                ->editColumn('tanggal_bayar', function ($transaction) {
                    return $transaction->tanggal_bayar ?? "-";
                })
                ->rawColumns(['tanggal_bayar'])

                ->make(true);
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

    public function store(Request $request)
    {
        // Create Transaction 
        $transaction = Transaction::create([
            'student_id' => Auth::user()->student->id,
            'cost_id' => $request->cost_id,
            'nominal' => $request->nominal,
            'jenis_pembayaran' => $request->jenis_pembayaran,
            'transaction_status' => 'PENDING',
        ]);
        // Config Midtrans

        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Buat Aray untuk dikirim ke midtrans
        $midtrans = [
            "transaction_details" => [
                "order_id" => $transaction->id,
                "gross_amount" => (int) $transaction->nominal,
            ],
            "customer_details" => [
                "first_name" => Auth::user()->name,
                "email" => Auth::user()->email,
            ],
            "enabled_payments" => [
                "gopay", "bank_transfer"
            ],
            "vtweb" => []
        ];
        try {
            if ($request->jenis_pembayaran == 'ONLINE') {
                $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
                $transaction->midtran_id = $paymentUrl;
                $transaction->save();
                return redirect($paymentUrl);
            }

            // Get Snap Payment Page URL

            // Redirect to Snap Payment Page
            return redirect()->route('siswa.transaction.index')->with('status', 'Pembayaran Berhasil Dibuat');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function downloadPDF(Request $request)
    {
        $transactions = Transaction::where('student_id', Auth::user()->student->id)
            ->whereBetween('tanggal_bayar', [$request->start, $request->end])
            ->with('cost')->latest()->get();

        $pdf = PDF::loadView('pages.transaction.pdf', compact('transactions'));
        return $pdf->download('transaction.pdf');
    }

    public function downloadEXCEL(Request $request)
    {
        $transactions = Transaction::where('student_id', Auth::user()->student->id)
            ->whereBetween('tanggal_bayar', [$request->start, $request->end])
            ->with('cost')->latest()->get();

        return Excel::download(new TransactionExport($transactions), 'transaction.xlsx');
    }
}
