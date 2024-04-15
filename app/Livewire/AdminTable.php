<?php

namespace App\Livewire;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class AdminTable extends DataTableComponent
{
    protected $model = Admin::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchStatus(false);
        $this->setFiltersVisibilityStatus(false);
        $this->setAdditionalSelects(['admins.id as id']);
    }

    public function filters(): array
    {
        return [
            TextFilter::make('Nama Admin', 'admin_name')
                ->config([
                    'placeholder' => 'Cari admin',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('admins.name', 'like', '%'.$value.'%');
                }),
        ];
    }

    public function builder(): Builder
    {
        return Admin::query()
            ->latest();
    }

    public function columns(): array
    {
        return [
            Column::make('Nama Admin', 'name')
                ->sortable()
                ->secondaryHeaderFilter('admin_name'),

            Column::make('Aksi')
                ->label(function ($row) {
                    return view('datatable.admins.action-column', [
                        'id' => $row->id,
                    ]);
                }),
        ];
    }
}
