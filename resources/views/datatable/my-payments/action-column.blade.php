<div class="d-flex">
    @if ($status != \App\Enums\Enum\PaymentStatus::VALIDATED->value)
        <div class="mx-1">
            <x-dashboard::ui.table.table-edit-action
                href="{{ route('dashboard.my-bills.payments.edit', [$billId, $paymentId]) }}" />
        </div>
        <div class="mx-1">
            <x-dashboard::ui.table.table-delete-action
                href="{{ route('dashboard.my-bills.payments.destroy', [$billId, $paymentId]) }}" />
        </div>
    @else
        <p class="text-primary">Tidak dapat diedit</p>
    @endif
</div>
