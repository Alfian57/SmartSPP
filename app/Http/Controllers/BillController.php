<?php

namespace App\Http\Controllers;

use App\Models\Student;

class BillController extends Controller
{
    public function index(Student $student)
    {
        return view('dashboard.pages.bills.index', [
            'title' => 'Riwayat Pembayaran',
            'student' => $student,
            'pendingPayment' => 0,
            'unverifiedPayments' => 0,
        ]);
    }
}
