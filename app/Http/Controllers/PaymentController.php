<?php

namespace App\Http\Controllers;

use App\Enums\BillStatus;
use App\Enums\PaymentStatus;
use App\Http\Requests\AcceptPaymentRequest;
use App\Http\Requests\StorePaymentRequest;
use App\Jobs\SendVerificationSuccessWhatsapp;
use App\Models\Bill;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.payments.index');
    }

    public function create()
    {
        return view('dashboard.pages.payments.create');
    }

    public function store(StorePaymentRequest $request)
    {
        $data = $request->validated();
        $data['status'] = PaymentStatus::VALIDATED->value;
        $payment = Payment::create($data);
        toast('Pembayaran berhasil ditambahkan', 'success');

        SendVerificationSuccessWhatsapp::dispatch($payment->bill->student, $request->nominal, $this->getRemainingAmount($payment->bill));

        return redirect()->route('dashboard.payments.index');
    }

    public function reject(Payment $payment)
    {
        $payment->update([
            'status' => PaymentStatus::UNVALIDATED->value,
        ]);

        if ($this->getRemainingAmount($payment->bill) > 0) {
            $payment->bill->update([
                'status' => BillStatus::NOT_PAID_OFF->value
            ]);
        }

        toast('Berhasil menolak pembayaran', 'success');

        return redirect()->route('dashboard.payments.index');
    }

    public function accept(Payment $payment)
    {
        return view('dashboard.pages.payments.accept', [
            'payment' => $payment,
        ]);
    }

    public function acceptProcess(AcceptPaymentRequest $request, Payment $payment)
    {
        $payment->update([
            'status' => PaymentStatus::VALIDATED->value,
            'nominal' => $request->nominal,
        ]);

        $this->checkBillStatus($payment->bill);

        SendVerificationSuccessWhatsapp::dispatch($payment->bill->student, $request->nominal, $this->getRemainingAmount($payment->bill));
        toast('Berhasil menyetujui pembayaran', 'success');

        return redirect()->route('dashboard.payments.index');
    }

    private function checkBillStatus(Bill $bill)
    {
        if ($this->getRemainingAmount($bill) <= 0) {
            $bill->update([
                'status' => BillStatus::PAID_OFF->value,
            ]);
        }
    }

    private function getRemainingAmount(Bill $bill): int
    {
        $totalPaid = Payment::query()
            ->where('id_tagihan', $bill->id)
            ->where('status', PaymentStatus::VALIDATED->value)
            ->sum('nominal');

        $totalPaid = (int)$totalPaid;
        return $bill->nominal - $totalPaid- $bill->diskon;
    }
}
