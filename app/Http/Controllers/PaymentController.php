<?php

namespace App\Http\Controllers;

use App\Enums\BillStatus;
use App\Enums\PaymentStatus;
use App\Http\Requests\AcceptPaymentRequest;
use App\Http\Requests\StorePaymentRequest;
use App\Jobs\SendPaymentBIllWhatsapp;
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
        $validatedData = $request->validated();
        if ($request->transfer_file) {
            $validatedData['transfer_file'] = $request->file('transfer_file')->store('payments_transfer_files');
        }
        Payment::create($validatedData);
        toast('Pembayaran berhasil ditambahkan', 'success');

        return redirect()->route('dashboard.payments.index');
    }

    public function reject(Payment $payment)
    {
        $payment->update([
            'status' => PaymentStatus::UNVALIDATED->value,
        ]);

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

        SendPaymentBIllWhatsapp::dispatch($payment->bill->student, $request->nominal, $this->getRemainingAmount($payment->bill));
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
            ->where('bill_id', $bill->id)
            ->where('status', PaymentStatus::VALIDATED->value)
            ->sum('nominal');

        return $bill->nominal - $totalPaid - $bill->discount;
    }
}
