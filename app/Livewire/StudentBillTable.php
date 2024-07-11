<?php

namespace App\Livewire;

use App\Enums\PaymentStatus;
use App\Helpers\Month;
use App\Models\Bill;
use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class StudentBillTable extends DataTableComponent
{
    protected $model = Bill::class;

    public Student $student;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchStatus(false);
        $this->setFiltersVisibilityStatus(false);
        $this->setAdditionalSelects(['tagihan.id as id']);
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Bulan', 'bulan')
                ->options([
                    '' => 'Pilih',
                    'january' => 'Januari',
                    'february' => 'Februari',
                    'march' => 'Maret',
                    'april' => 'April',
                    'may' => 'Mei',
                    'june' => 'Juni',
                    'july' => 'Juli',
                    'august' => 'Agustus',
                    'september' => 'September',
                    'october' => 'Oktober',
                    'november' => 'November',
                    'december' => 'Desember',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('tagihan.bulan', $value);
                }),
            SelectFilter::make('Tahun Ajaran', 'tahun_ajaran')
                ->options(
                    array_merge(
                        ['' => 'Pilih'],
                        Bill::query()
                            ->where('id_siswa', $this->student->id)
                            ->distinct('tahun_ajaran')
                            ->pluck('tahun_ajaran', 'tahun_ajaran')
                            ->toArray()
                    )
                )
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('tagihan.tahun_ajaran', $value);
                }),
        ];
    }

    public function builder(): Builder
    {
        return Bill::query()
            ->where('id_siswa', $this->student->id)
            ->addSelect([
                'total_paid' => function ($query) {
                    $query->selectRaw('SUM(nominal) as total_paid')
                        ->from('pembayaran')
                        ->whereColumn('id_tagihan', 'tagihan.id')
                        ->where('status', PaymentStatus::VALIDATED->value);
                },
            ])
            ->latest('tagihan.created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Bulan', 'bulan')
                ->sortable()
                ->format(function ($value) {
                    return view('datatable.bills.month-column', [
                        'month' => Month::translateToID($value),
                    ]);
                })
                ->secondaryHeaderFilter('bulan'),

            Column::make('Tahun Ajaran', 'tahun_ajaran')
                ->sortable()
                ->secondaryHeaderFilter('tahun_ajaran')
                ->collapseOnMobile(),

            Column::make('Total Tagihan', 'nominal')
                ->format(function ($value) {
                    return view('datatable.bills.nominal-column', [
                        'nominal' => $value,
                    ]);
                })
                ->sortable()
                ->collapseOnMobile(),

            Column::make('Diskon', 'diskon')
                ->format(function ($value) {
                    return view('datatable.bills.discount-column', [
                        'discount' => $value,
                    ]);
                })
                ->collapseOnTablet(),

            Column::make('Nominal Dibayarkan')
                ->label(function ($row) {
                    return view('datatable.bills.total-paid-column', [
                        'nominal' => $row->total_paid,
                    ]);
                })
                ->collapseOnTablet(),

            Column::make('Sisa Tagihan')
                ->label(function ($row) {
                    return view('datatable.bills.remaining-bill-column', [
                        'nominal' => $row->nominal - $row->total_paid - $row->diskon,
                    ]);
                }),

            Column::make('Aksi')
                ->label(function ($row) {
                    return view('datatable.bills.action-column', [
                        'billId' => $row->id,
                        'studentId' => $this->student->id,
                    ]);
                }),
        ];
    }
}
