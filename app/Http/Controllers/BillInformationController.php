<?php

namespace App\Http\Controllers;

use App\Models\Bill;

class BillInformationController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.bill-informations.index', [
            'title' => 'Informasi Tagihan',
        ]);
    }

    public function show(Bill $bill)
    {
        return view('dashboard.pages.bill-informations.show', [
            'title' => 'Detail Informasi Tagihan',
            'bill' => $bill,
        ]);
    }
}
