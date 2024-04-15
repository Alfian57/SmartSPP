<?php

namespace App\Livewire;

use App\Enums\Enum\PaymentStatus;
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
                            ->where('student_id', $this->student->id)
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
            ->where('student_id', $this->student->id)
            ->addSelect([
                'total_paid' => function ($query) {
                    $query->selectRaw('SUM(nominal) as total_paid')
                        ->from('payments')
                        ->whereColumn('bill_id', 'bills.id')
                        ->where('status', PaymentStatus::VALIDATED->value);
                },
            ]);
    }

    public function columns(): array
    {
        return [
            Column::make('Bulan', 'month')
                ->sortable()
                ->format(function ($value) {
                    return view('datatable.bills.month-column', [
                        'month' => Month::translateToID($value),
                    ]);
                })
                ->secondaryHeaderFilter('month'),

            Column::make('Tahun Ajaran', 'school_year')
                ->sortable()
                ->secondaryHeaderFilter('school_year'),

            Column::make('Total Tagihan', 'nominal')
                ->format(function ($value) {
                    return view('datatable.bills.nominal-column', [
                        'nominal' => $value,
                    ]);
                })
                ->sortable(),

            Column::make('Diskon', 'discount')
                ->format(function ($value) {
                    return view('datatable.bills.discount-column', [
                        'discount' => $value,
                    ]);
                }),

            Column::make('Nominal Dibayarkan')
                ->label(function ($row) {
                    return view('datatable.bills.total-paid-column', [
                        'nominal' => $row->total_paid,
                    ]);
                }),

            Column::make('Sisa Tagihan')
                ->label(function ($row) {
                    return view('datatable.bills.remaining-bill-column', [
                        'nominal' => $row->nominal - $row->total_paid - $row->discount,
                    ]);
                }),

            Column::make('Aksi', 'id'),
        ];
    }
}
