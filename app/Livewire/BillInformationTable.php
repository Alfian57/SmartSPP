<?php

namespace App\Livewire;

use App\Enums\PaymentStatus;
use App\Helpers\Month;
use App\Models\Bill;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class BillInformationTable extends DataTableComponent
{
    protected $model = Bill::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchStatus(false);
        $this->setFiltersVisibilityStatus(false);
        $this->setAdditionalSelects(['bills.id as id']);
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Bulan', 'month')
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
                    $builder->where('bills.month', $value);
                }),
            SelectFilter::make('Tahun Ajaran', 'school_year')
                ->options(
                    array_merge(
                        ['' => 'Pilih'],
                        Bill::query()
                            ->where('student_id', Auth::user()->accountable->id)
                            ->distinct('school_year')
                            ->pluck('school_year', 'school_year')
                            ->toArray()
                    )
                )
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('bills.school_year', $value);
                }),
        ];
    }

    public function builder(): Builder
    {
        return Bill::query()
            ->where('student_id', Auth::user()->accountable->id)
            ->addSelect([
                'total_paid' => function ($query) {
                    $query->selectRaw('SUM(nominal) as total_paid')
                        ->from('payments')
                        ->whereColumn('bill_id', 'bills.id')
                        ->where('status', PaymentStatus::VALIDATED->value);
                },
            ])
            ->latest('bills.created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Bulan', 'month')
                ->sortable()
                ->format(function ($value) {
                    return view('datatable.bill-informations.month-column', [
                        'month' => Month::translateToID($value),
                    ]);
                })
                ->secondaryHeaderFilter('month'),

            Column::make('Tahun Ajaran', 'school_year')
                ->sortable()
                ->secondaryHeaderFilter('school_year')
                ->collapseOnTablet(),

            Column::make('Total Tagihan', 'nominal')
                ->format(function ($value) {
                    return view('datatable.bill-informations.nominal-column', [
                        'nominal' => $value,
                    ]);
                })
                ->sortable()
                ->collapseOnMobile(),

            Column::make('Diskon', 'discount')
                ->format(function ($value) {
                    return view('datatable.bill-informations.discount-column', [
                        'discount' => $value,
                    ]);
                })
                ->collapseOnTablet(),

            Column::make('Nominal Dibayarkan')
                ->label(function ($row) {
                    return view('datatable.bill-informations.total-paid-column', [
                        'nominal' => $row->total_paid,
                    ]);
                })
                ->collapseOnTablet(),

            Column::make('Sisa Tagihan')
                ->label(function ($row) {
                    return view('datatable.bill-informations.remaining-bill-column', [
                        'nominal' => $row->nominal - $row->total_paid - $row->discount,
                    ]);
                }),

            Column::make('Aksi')
                ->label(function ($row) {
                    return view('datatable.bill-informations.action-column', [
                        'id' => $row->id,
                    ]);
                }),
        ];
    }
}
