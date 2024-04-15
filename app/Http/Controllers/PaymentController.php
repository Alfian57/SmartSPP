<?php

namespace App\Http\Controllers;

use App\Enums\Enum\BillStatus;
use App\Enums\Enum\PaymentStatus;
use App\Models\Bill;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.payments.index', [
            'title' => 'Manajemen Pembayaran',
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

        $this->checkBillStatus($payment->bill);

        toast('Berhasil menyetujui pembayaran', 'success');

        return redirect()->route('dashboard.payments.index');
    }

    private function checkBillStatus(Bill $bill)
    {
        $totalPaid = Payment::query()
            ->where('bill_id', $bill->id)
            ->where('status', PaymentStatus::VALIDATED->value)
            ->sum('nominal');

        if ($bill->nominal - $totalPaid - $bill->discount <= 0) {
            $bill->update([
                'status' => BillStatus::PaidOff->value,
            ]);
        }
    }
}
