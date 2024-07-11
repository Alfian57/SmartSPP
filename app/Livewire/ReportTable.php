<?php

namespace App\Livewire;

use App\Models\Classroom;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class ReportTable extends DataTableComponent
{
    protected $model = Classroom::class;

    public $year;

    public $month;

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
            ->leftJoin('tagihan', 'siswa.id', '=', 'tagihan.id_siswa')
            ->leftJoin('pembayaran', 'tagihan.id', '=', 'pembayaran.id_tagihan')
            ->addSelect([
                'kelas.*',
                DB::raw('SUM(tagihan.nominal) as total_tagihan'),
                DB::raw('SUM(tagihan.diskon) as total_diskon'),
                DB::raw('SUM(pembayaran.nominal) as total_terbayar'),
                // DB::raw('(SUM(pembayaran.nominal) / SUM(tagihan.nominal)) * 100 as presentase_terbayar'),
            ])
            ->whereYear('tagihan.created_at', $this->year)
            ->where('tagihan.bulan', $this->month)
            ->where('pembayaran.status', 'tervalidasi')
            ->groupBy('kelas.id', 'kelas.nama', 'kelas.harga_spp', 'kelas.updated_at', 'kelas.created_at')
            ->orderBy('kelas.nama', 'asc');
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
            Column::make('Nama Kelas')
                ->label(function ($row) {
                    return $row->nama;
                })
                ->secondaryHeaderFilter('classroom_name'),

            Column::make('Jumlah Siswa')
                ->label(function ($row) {
                    // dd($row);
                    return $row->students_count . ' Siswa';
                }),

            Column::make('Total Tagihan (Rp)')
                ->label(function ($row) {
                    return 'Rp ' . number_format($row->total_tagihan, 2);
                }),

            Column::make('Total Diskon (Rp)')
                ->label(function ($row) {
                    return 'Rp ' . number_format($row->total_diskon, 2);
                }),

            Column::make('Total Terbayar (Rp)')
                ->label(function ($row) {
                    return 'Rp ' . number_format($row->total_terbayar, 2);
                }),

            Column::make('Sisa Tagihan (Rp)')
                ->label(function ($row) {
                    $sisa_tagihan = $row->total_tagihan - ($row->total_terbayar + $row->total_diskon);
                    return 'Rp ' . number_format($sisa_tagihan, 2);
                }),

            Column::make('Presentase Pembayaran (%)')
                ->label(function ($row) {
                    $presentase = (($row->total_terbayar + $row->total_diskon) / $row->total_tagihan) * 100;
                    return number_format($presentase, 2) . ' %';
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
