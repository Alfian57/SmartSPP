<?php

namespace App\Livewire;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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

    public array $bulkActions = [
        'deleteSelected' => 'Hapus',
    ];

    public function deleteSelected()
    {
        Admin::whereIn('id', $this->getSelected())->get()->each(function ($admin) {
            if ($admin->account->profile_pic) {
                Storage::delete($admin->account->profile_pic);
            }
        });

        Admin::whereIn('id', $this->getSelected())->whereNot('id', Auth::user()->accountable->id)->delete();
    }

    public function builder(): Builder
    {
        return Admin::query()
            ->latest('admins.created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Nama Admin', 'name')
                ->sortable()
                ->secondaryHeaderFilter('admin_name'),

            Column::make('Email', 'account.email')
                ->sortable(),

            Column::make('Aksi')
                ->label(function ($row) {
                    return view('datatable.admins.action-column', [
                        'id' => $row->id,
                    ]);
                }),
        ];
    }
}
