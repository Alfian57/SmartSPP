<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMyPaymentRequest;
use App\Http\Requests\UpdateMyPaymentRequest;
use App\Jobs\SendPaymentBIllWhatsapp;
use App\Models\Bill;
use App\Models\Payment;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class MyPaymentController extends Controller
{
    public function index(Bill $bill)
    {
        return view('dashboard.pages.my-payments.index', [
            'title' => 'Manajemen Pembayaran',
            'bill' => $bill,
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
        $data['id_tagihan'] = $bill->id;
        $data['bukti_transfer'] = $request->file('bukti_transfer')->store('payments_transfer_files');

        $payment = Payment::create($data);
        SendPaymentBIllWhatsapp::dispatch($payment->bill->student, $request->nominal);
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
        Gate::authorize('edit', $bill);
        Gate::authorize('edit', $payment);

        $data = $request->validated();
        $data['status'] = 'menunggu-validasi';
        $data['bukti_transfer'] = $payment->bukti_transfer;

        if ($request->bukti_transfer) {
            $data['bukti_transfer'] = $request->file('bukti_transfer')->store('payments_transfer_files');
            Storage::delete($payment->bukti_transfer);
        }

        $payment->update($data);
        toast('Pembayaran berhasil diperbarui', 'success');

        return redirect()->route('dashboard.my-bills.payments.index', $bill->id);
    }

    public function destroy(Bill $bill, Payment $payment)
    {
        Gate::authorize('delete', $bill);
        Gate::authorize('delete', $payment);

        if ($payment->bukti_transfer) {
            Storage::delete($payment->bukti_transfer);
        }
        $payment->delete();
        toast('Pembayaran berhasil dihapus', 'success');

        return redirect()->route('dashboard.my-bills.payments.index', $bill->id);
    }
}
