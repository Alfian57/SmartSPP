<div class="d-flex align-items-center">
    @if ($file)
        <a class="btn btn-primary" target="_blank" href="{{ asset('storage/' . $file) }}">
            Lihat Bukti
        </a>
    @endif


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
        <div class="pt-2">
            <p class="text-primary">Tidak dapat diedit</p>
        </div>
    @endif
</div>
