<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Student;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index(Student $student)
    {
        $bills = Bill::query()
            ->where('student_id', $student->id)
            ->latest()
            ->paginate(25);

        return view('dashboard.pages.bills.index', [
            'title' => 'Riwayat Pembayaran',
            'student' => $student,
            'bills' => $bills,
            'pendingPayment' => 0,
            'unverifiedPayments' => 0,
        ]);
    }
}