<div class="font-weight-bold text-capitalize">
    @if ($status == \App\Enums\PaymentStatus::PENDING->value)
        <p class="text-primary">Diproses</p>
    @elseif($status == \App\Enums\PaymentStatus::VALIDATED->value)
        <p class="text-success">Diterima</p>
    @else
        <p class="text-danger">Ditolak</p>
    @endif
</div>
