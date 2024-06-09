<?php

namespace App\Livewire;

use App\Models\StudentParent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
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
        $this->setAdditionalSelects(['orang_tua.id as id']);
    }

    public function filters(): array
    {
        return [
            TextFilter::make('Nama Orang Tua', 'student_parent_name')
                ->config([
                    'placeholder' => 'Cari orang tua',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('orang_tua.nama', 'like', '%'.$value.'%');
                }),
            TextFilter::make('Nama Siswa', 'student_name')
                ->config([
                    'placeholder' => 'Cari siswa',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->whereRelation('students', 'nama', 'like', '%'.$value.'%');
                }),
        ];
    }

    public array $bulkActions = [
        'deleteSelected' => 'Hapus',
    ];

    public function deleteSelected()
    {
        StudentParent::whereIn('id', $this->getSelected())->get()->each(function ($student) {
            if ($student->account->foto_profil) {
                Storage::delete($student->account->foto_profil);
            }
        });

        StudentParent::whereIn('id', $this->getSelected())->delete();
    }

    public function builder(): Builder
    {
        return StudentParent::query()
            ->with('students')
            ->latest('orang_tua.created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Nama Orang Tua', 'nama')
                ->secondaryHeaderFilter('student_parent_name'),

            Column::make('Email', 'account.email'),

            Column::make('Nama Anak')
                ->label(function ($row) {
                    return view('datatable.student-parents.children-column', [
                        'children' => $row->students,
                    ]);
                })
                ->secondaryHeaderFilter('student_name')
                ->collapseOnTablet(),

            Column::make('No. Telepon', 'no_telepon')
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
