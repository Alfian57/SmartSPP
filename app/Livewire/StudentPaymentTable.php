<?php

namespace App\Livewire;

use App\Enums\PaymentStatus;
use App\Models\Bill;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class StudentPaymentTable extends DataTableComponent
{
    protected $model = Payment::class;

    public Bill $bill;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchStatus(false);
        $this->setFiltersVisibilityStatus(false);
        $this->setAdditionalSelects(['payments.id as id', 'payments.transfer_file as transfer_file']);
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Status Pembayaran', 'payment_status')
                ->options([
                    '' => 'Pilih',
                    PaymentStatus::PENDING->value => 'Diproses',
                    PaymentStatus::VALIDATED->value => 'Diterima',
                    PaymentStatus::UNVALIDATED->value => 'Ditolak',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('payments.status', $value);
                }),
            DateRangeFilter::make('Tanggal Pembayaran', 'payment_created_at')
                ->config([
                    'placeholder' => 'Tentukan tanggal pembayaran',
                ])
                ->filter(function (Builder $builder, array $dateRange) {
                    $builder
                        ->whereDate('payments.created_at', '>=', $dateRange['minDate'])
                        ->whereDate('payments.created_at', '<=', $dateRange['maxDate']);
                }),
        ];
    }

    public function builder(): Builder
    {
        return Payment::query()
            ->where('bill_id', $this->bill->id)
            ->latest('payments.created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Nominal', 'nominal')
                ->format(function ($value) {
                    return view('datatable.payments.nominal-column', [
                        'nominal' => $value,
                    ]);
                }),

            ImageColumn::make('Bukti Trasfer', 'transfer_file')
                ->location(
                    fn ($row) => asset('storage/'.$row->transfer_file)
                )
                ->attributes(fn ($row) => [
                    'class' => 'text-danger font-weight-bold',
                    'alt' => 'Bukti rusak. Silahkan minta pihak terkait untuk upload ulang',
                    'style' => 'width: 50px;',
                ]),

            Column::make('Status Pembayaran', 'status')
                ->format(function ($value) {
                    return view('datatable.payments.status-column', [
                        'status' => $value,
                    ]);
                })
                ->secondaryHeaderFilter('payment_status'),

            Column::make('Tanggal Pembayaran', 'created_at')
                ->sortable()
                ->secondaryHeaderFilter('payment_created_at'),
        ];
    }
}