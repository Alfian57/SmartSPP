<?php

namespace App\Livewire;

use App\Enums\PaymentStatus;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class PaymentTable extends DataTableComponent
{
    protected $model = Payment::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchStatus(false);
        $this->setFiltersVisibilityStatus(false);
        $this->setAdditionalSelects(['pembayaran.id as id', 'bill.bulan as bulan', 'bill.tahun_ajaran as tahun_ajaran', 'pembayaran.bukti_transfer as transfer_file']);
    }

    public function filters(): array
    {
        return [
            TextFilter::make('NISN Siswa', 'student_nisn')
                ->config([
                    'placeholder' => 'Cari NISN siswa',
                    'max' => 10,
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('bill_student.nisn', 'like', '%' . $value . '%');
                }),
            TextFilter::make('Nama Siswa', 'student_name')
                ->config([
                    'placeholder' => 'Cari Nama siswa',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('bill_student.nama', 'like', '%' . $value . '%');
                }),
            SelectFilter::make('Status Pembayaran', 'payment_status')
                ->options([
                    '' => 'Pilih',
                    PaymentStatus::PENDING->value => 'Diproses',
                    PaymentStatus::VALIDATED->value => 'Diterima',
                    PaymentStatus::UNVALIDATED->value => 'Ditolak',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('pembayaran.status', $value);
                }),
            DateRangeFilter::make('Tanggal Pembayaran', 'payment_created_at')
                ->config([
                    'placeholder' => 'Tentukan tanggal pembayaran',
                ])
                ->filter(function (Builder $builder, array $dateRange) {
                    $builder
                        ->whereDate('pembayaran.created_at', '>=', $dateRange['minDate'])
                        ->whereDate('pembayaran.created_at', '<=', $dateRange['maxDate']);
                }),
        ];
    }

    public function builder(): Builder
    {
        return Payment::query()
            ->with('bill', 'bill.student')
            ->latest('pembayaran.created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('NISN', 'bill.student.nisn')
                ->sortable()
                ->secondaryHeaderFilter('student_nisn'),

            Column::make('Nama Siswa', 'bill.student.nama')
                ->sortable()
                ->secondaryHeaderFilter('student_name'),

            Column::make('Nominal', 'nominal')
                ->format(function ($value) {
                    return view('datatable.payments.nominal-column', [
                        'nominal' => $value,
                    ]);
                }),

            Column::make('Status Pembayaran', 'status')
                ->format(function ($value) {
                    return view('datatable.payments.status-column', [
                        'status' => $value,
                    ]);
                })
                ->secondaryHeaderFilter('payment_status')
                ->collapseOnTablet(),

            Column::make('Angsuran Pada')
                ->label(function ($row) {
                    return view('datatable.payments.payment-column', [
                        'month' => $row->bulan,
                        'year' => $row->tahun_ajaran,
                    ]);
                })
                ->collapseOnMobile(),

            Column::make('Tanggal Pembayaran', 'created_at')
                ->sortable()
                ->secondaryHeaderFilter('payment_created_at')
                ->collapseAlways(),

            Column::make('Bukti transfer')
                ->label(function ($row) {
                    return $row->transfer_file;
                })
                ->collapseOnMobile(),

            Column::make('Aksi')
                ->label(function ($row) {
                    return view('datatable.payments.action-column', [
                        'id' => $row->id,
                        'status' => $row->status,
                        'file' => $row->transfer_file,
                    ]);
                })
                ->collapseOnMobile(),
        ];
    }
}
