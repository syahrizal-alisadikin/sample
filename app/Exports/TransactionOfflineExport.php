<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransactionOfflineExport implements FromView
{
    public function __construct($data)
    {
        $this->data = $data;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $transactions = $this->data;
        return view('transaction-offlines.excel', compact('transactions'));
    }
}
