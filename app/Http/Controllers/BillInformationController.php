<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Support\Facades\Gate;

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
        Gate::authorize('view', $bill);

        return view('dashboard.pages.bill-informations.show', [
            'title' => 'Detail Informasi Tagihan',
            'bill' => $bill,
        ]);
    }
}
