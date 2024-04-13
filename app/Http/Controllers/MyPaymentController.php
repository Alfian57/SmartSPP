<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMyPaymentRequest;
use App\Http\Requests\UpdateMyPaymentRequest;
use App\Models\Bill;
use App\Models\Payment;
use Illuminate\Support\Facades\Storage;

class MyPaymentController extends Controller
{
    public function index(Bill $bill)
    {
        $payments = Payment::query()
            ->with('bill')
            ->where('bill_id', $bill->id)
            ->latest()
            ->paginate(25);

        return view('dashboard.pages.my-payments.index', [
            'title' => 'Manajemen Pembayaran',
            'bill' => $bill,
            'payments' => $payments,
        ]);
    }

    public function create(Bill $bill)
    {
        return view('dashboard.pages.my-payments.create', [
            'title' => 'Ajuan Pembayaran',
            'bill' => $bill,
        ]);
    }

    public function store(StoreMyPaymentRequest $request, Bill $bill)
    {
        $data = $request->validated();
        $data['bill_id'] = $bill->id;
        $data['transfer_file'] = $request->file('transfer_file')->store('payments_transfer_files');

        Payment::create($data);

        toast('Pembayaran berhasil ditambahkan', 'success');

        return redirect()->route('dashboard.my-bills.payments.index', $bill->id);
    }

    public function edit(Bill $bill, Payment $payment)
    {
        return view('dashboard.pages.my-payments.edit', [
            'title' => 'Manajemen Kelas',
            'bill' => $bill,
            'payment' => $payment,
        ]);
    }

    public function update(UpdateMyPaymentRequest $request, Bill $bill, Payment $payment)
    {
        $data = $request->validated();
        $data['status'] = 'pending';
        $data['transfer_file'] = $payment->transfer_file;

        if ($request->transfer_file) {
            $data['transfer_file'] = $request->file('transfer_file')->store('payments_transfer_files');
            Storage::delete($payment->transfer_file);
        }

        $payment->update($data);

        toast('Pembayaran berhasil diperbarui', 'success');

        return redirect()->route('dashboard.my-bills.payments.index', $bill->id);
    }

    public function destroy(Bill $bill, Payment $payment)
    {
        $payment->delete();

        toast('Pembayaran berhasil dihapus', 'success');

        return redirect()->route('dashboard.my-bills.payments.index', $bill->id);
    }
}
