<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMyPaymentRequest;
use App\Http\Requests\UpdateMyPaymentRequest;
use App\Models\Bill;
use App\Models\Payment;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class MyPaymentController extends Controller
{
    public function index(Bill $bill)
    {
        Gate::authorize('view', $bill);

        return view('dashboard.pages.my-payments.index', [
            'title' => 'Manajemen Pembayaran',
            'bill' => $bill,
        ]);
    }

    public function create(Bill $bill)
    {
        Gate::authorize('create', $bill);

        return view('dashboard.pages.my-payments.create', [
            'title' => 'Ajuan Pembayaran',
            'bill' => $bill,
        ]);
    }

    public function store(StoreMyPaymentRequest $request, Bill $bill)
    {
        Gate::authorize('create', $bill);

        $data = $request->validated();
        $data['bill_id'] = $bill->id;
        $data['transfer_file'] = $request->file('transfer_file')->store('payments_transfer_files');

        Payment::create($data);
        toast('Pembayaran berhasil ditambahkan', 'success');

        return redirect()->route('dashboard.my-bills.payments.index', $bill->id);
    }

    public function edit(Bill $bill, Payment $payment)
    {
        Gate::authorize('edit', $bill);
        Gate::authorize('edit', $payment);

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
        Gate::authorize('delete', $bill);
        Gate::authorize('delete', $payment);

        $payment->delete();
        toast('Pembayaran berhasil dihapus', 'success');

        return redirect()->route('dashboard.my-bills.payments.index', $bill->id);
    }
}
