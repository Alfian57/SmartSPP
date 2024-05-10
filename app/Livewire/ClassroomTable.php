<?php

namespace App\Livewire;

use App\Models\Classroom;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class ClassroomTable extends DataTableComponent
{
    protected $model = Classroom::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchStatus(false);
        $this->setFiltersVisibilityStatus(false);
        $this->setAdditionalSelects(['classrooms.id as id']);
    }

    public function filters(): array
    {
        return [
            TextFilter::make('Nama Kelas', 'classroom_name')
                ->config([
                    'placeholder' => 'Cari kelas',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('classrooms.name', 'like', '%'.$value.'%');
                }),
        ];
    }

    public array $bulkActions = [
        'deleteSelected' => 'Hapus',
    ];

    public function deleteSelected()
    {
        Classroom::whereIn('id', $this->getSelected())->delete();
    }

    public function builder(): Builder
    {
        return Classroom::query()
            ->withCount('students')
            ->latest('classrooms.created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Nama Kelas', 'name')
                ->sortable()
                ->secondaryHeaderFilter('classroom_name'),

            Column::make('Jumlah Siswa')
                ->sortable()
                ->label(function ($row) {
                    return view('datatable.classrooms.student-count-column', [
                        'count' => $row->students_count,
                    ]);
                }),

            Column::make('Aksi')
                ->label(function ($row) {
                    return view('datatable.classrooms.action-column', [
                        'id' => $row->id,
                    ]);
                }),
        ];
    }
}
