<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Models\Bill;
use App\Models\Student;

class BillController extends Controller
{
    public function index(Student $student)
    {
        $totalBill = 0;
        $student->bills()->addSelect([
            'total_paid' => function ($query) {
                $query->selectRaw('SUM(nominal) as total_paid')
                    ->from('payments')
                    ->whereColumn('bill_id', 'bills.id')
                    ->where('status', PaymentStatus::VALIDATED->value);
            },
        ])
            ->get()
            ->each(function ($bill) use (&$totalBill) {
                $totalBill += $bill->nominal - $bill->total_paid - $bill->discount;
            });

        return view('dashboard.pages.bills.index', [
            'title' => 'Riwayat Tagihan',
            'student' => $student,
            'pendingPayment' => $student->payments->where('status', PaymentStatus::PENDING->value)->count(),
            'unvalidatedPayments' => $student->payments->where('status', PaymentStatus::UNVALIDATED->value)->count(),
            'totalBill' => $totalBill,
        ]);
    }

    public function show(Student $student, Bill $bill)
    {
        return view('dashboard.pages.bills.show', [
            'title' => 'Riwayat Pembayaran',
            'bill' => $bill,
        ]);
    }
}
