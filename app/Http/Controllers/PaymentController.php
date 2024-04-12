<?php

namespace App\Http\Controllers;

use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::query()
            ->with('bill', 'bill.student')
            ->latest()
            ->paginate(25);

        return view('dashboard.pages.payments.index', [
            'title' => 'Manajemen Pembayaran',
            'payments' => $payments,
        ]);
    }

    public function reject(Payment $payment)
    {
        $payment->update([
            'status' => 'unvalidated',
        ]);

        toast('Berhasil menolak pembayaran', 'success');

        return redirect()->route('dashboard.payments.index');
    }

    public function accept(Payment $payment)
    {
        $payment->update([
            'status' => 'validated',
        ]);

        toast('Berhasil menyetujui pembayaran', 'success');

        return redirect()->route('dashboard.payments.index');
    }
}
