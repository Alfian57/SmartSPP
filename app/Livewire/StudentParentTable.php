<?php

namespace App\Livewire;

use App\Models\StudentParent;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class StudentParentTable extends DataTableComponent
{
    protected $model = StudentParent::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchStatus(false);
        $this->setFiltersVisibilityStatus(false);
        $this->setAdditionalSelects(['student_parents.id as id']);
    }

    public function filters(): array
    {
        return [
            TextFilter::make('Nama Orang Tua', 'student_parent_name')
                ->config([
                    'placeholder' => 'Cari orang tua',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('student_parents.name', 'like', '%' . $value . '%');
                }),
            TextFilter::make('Nama Siswa', 'student_name')
                ->config([
                    'placeholder' => 'Cari siswa',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->whereRelation('students', 'name', 'like', '%' . $value . '%');
                }),
        ];
    }

    public function builder(): Builder
    {
        return StudentParent::query()
            ->with('students')
            ->latest('student_parents.created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Nama Orang Tua', 'name')
                ->sortable()
                ->secondaryHeaderFilter('student_parent_name'),

            Column::make('Email', 'account.email')
                ->sortable(),

            Column::make('Nama Anak')
                ->label(function ($row) {
                    return view('datatable.student-parents.children-column', [
                        'children' => $row->students,
                    ]);
                })
                ->secondaryHeaderFilter('student_name')
                ->collapseOnTablet(),

            Column::make('No. Telepon', 'phone_number')
                ->collapseOnMobile(),

            Column::make('Aksi')
                ->label(function ($row) {
                    return view('datatable.student-parents.action-column', [
                        'id' => $row->id,
                    ]);
                }),
        ];
    }
}
