<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class ReportTable extends DataTableComponent
{
    protected $model = Classroom::class;
    public $year, $month;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchStatus(false);
        $this->setFiltersVisibilityStatus(false);
    }

    public function builder(): Builder
    {
        return Classroom::query()
            ->withCount('students')
            ->leftJoin('siswa', 'kelas.id', '=', 'siswa.id_kelas')
            ->leftJoin('tagihan', function ($join) {
                $join->on('siswa.id', '=', 'tagihan.id_siswa')
                    ->whereYear('tagihan.created_at', '=', $this->year)
                    ->where('tagihan.bulan', '=', $this->month);
            })
            ->leftJoin('pembayaran', function ($join) {
                $join->on('tagihan.id', '=', 'pembayaran.id_tagihan')
                    ->where('pembayaran.status', '=', 'tervalidasi')
                    ->whereYear('pembayaran.created_at', '=', $this->year)
                    ->where('pembayaran.created_at', '=', $this->month);
            })
            ->addSelect([
                'kelas.*',
                DB::raw('SUM(tagihan.nominal) as total_tagihan'),
                DB::raw('SUM(tagihan.diskon) as total_diskon'),
                DB::raw('SUM(pembayaran.nominal) as total_terbayar'),
                DB::raw('(SUM(pembayaran.nominal) / SUM(tagihan.nominal)) * 100 as presentase_terbayar')
            ])
            ->groupBy('kelas.id')
            ->latest('kelas.created_at');
    }

    public function filters(): array
    {
        return [
            TextFilter::make('Nama Kelas', 'classroom_name')
                ->config([
                    'placeholder' => 'Cari kelas',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('kelas.nama', 'like', '%' . $value . '%');
                }),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make("Nama Kelas")
                ->label(function ($row) {
                    return $row->nama;
                })
                ->secondaryHeaderFilter('classroom_name'),

            Column::make("Jumlah Siswa")
                ->label(function ($row) {
                    return $row->students_count . " Siswa";
                }),

            Column::make("Total Tagihan (Rp)")
                ->label(function ($row) {
                    return "Rp " . number_format($row->total_tagihan, 2);
                }),

            Column::make("Total Diskon (Rp)")
                ->label(function ($row) {
                    return "Rp " . number_format($row->total_diskon, 2);
                }),

            Column::make("Total Terbayar (Rp)")
                ->label(function ($row) {
                    return "Rp " . number_format($row->total_terbayar, 2);
                }),

            Column::make("Presentase Terbayar (%)")
                ->label(function ($row) {
                    return number_format($row->presentase_terbayar, 2) . " %";
                }),

            Column::make('Aksi')
                ->label(function ($row) {
                    return view('datatable.reports.action-column', [
                        'id' => $row->id,
                    ]);
                }),
        ];
    }
}
