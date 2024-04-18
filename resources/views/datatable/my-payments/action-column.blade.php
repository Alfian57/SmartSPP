<div class="d-flex align-items-center">
    <a class="btn btn-primary" target="_blank" href="{{ asset('storage/' . $file) }}">
        Lihat Bukti
    </a>

    @if ($status != \App\Enums\PaymentStatus::VALIDATED->value)
        <div class="mx-1">
            <x-datatable::shared.edit-action-button
                href="{{ route('dashboard.my-bills.payments.edit', [$billId, $paymentId]) }}" />
        </div>
        <div class="mx-1">
            <x-datatable::shared.delete-action-button
                href="{{ route('dashboard.my-bills.payments.destroy', [$billId, $paymentId]) }}" />
        </div>
    @else
        <p class="text-primary">Tidak dapat diedit</p>
    @endif
</div>
