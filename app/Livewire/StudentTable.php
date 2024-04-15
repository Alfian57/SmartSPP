<?php

namespace App\Livewire;

use App\Enums\Enum\Gender;
use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class StudentTable extends DataTableComponent
{
    protected $model = Student::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchStatus(false);
        $this->setFiltersVisibilityStatus(false);
        $this->setAdditionalSelects(['students.id as id']);
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
                    $builder->where('students.nisn', 'like', '%'.$value.'%');
                }),
            TextFilter::make('Nama Siswa', 'student_name')
                ->config([
                    'placeholder' => 'Cari siswa',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('students.name', 'like', '%'.$value.'%');
                }),
            TextFilter::make('Nama Kelas', 'classroom_name')
                ->config([
                    'placeholder' => 'Cari kelas',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('classrooms.name', 'like', '%'.$value.'%');
                }),
            SelectFilter::make('Jenis Kelamin', 'gender')
                ->options([
                    '' => 'Pilih',
                    Gender::MALE->value => 'Laki-laki',
                    Gender::FEMALE->value => 'Perempuan',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('gender', $value);
                }),
        ];
    }

    public function builder(): Builder
    {
        return Student::query()
            ->with('classroom');
    }

    public function columns(): array
    {
        return [
            Column::make('NISN', 'nisn')
                ->sortable()
                ->secondaryHeaderFilter('student_nisn'),

            Column::make('Nama Siswa', 'name')
                ->sortable()
                ->secondaryHeaderFilter('student_name'),

            Column::make('Nama Kelas', 'classroom.name')
                ->sortable()
                ->secondaryHeaderFilter('classroom_name'),

            Column::make('Jenis Kelamin', 'gender')
                ->format(function ($value) {
                    return view('datatable.students.gender-column', [
                        'gender' => $value,
                    ]);
                })
                ->secondaryHeaderFilter('gender'),

            Column::make('Aksi')
                ->label(function ($row) {
                    return view('datatable.students.action-column', [
                        'id' => $row->id,
                    ]);
                }),
        ];
    }
}
