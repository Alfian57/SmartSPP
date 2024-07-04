<?php

namespace App\Livewire;

use App\Models\Classroom;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ReportDetailTable extends DataTableComponent
{
    protected $model = Student::class;
    public Classroom $classroom;
    public $year, $month;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchStatus(false);
        $this->setFiltersVisibilityStatus(false);
    }


    public function builder(): Builder
    {
        return Student::query()
            ->where('id_kelas', $this->classroom->id)
            ->with('bills', 'bills.payments')
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
                'siswa.*',
                DB::raw('SUM(tagihan.nominal) as total_tagihan'),
                DB::raw('SUM(tagihan.diskon) as total_diskon'),
                DB::raw('SUM(pembayaran.nominal) as total_terbayar'),
                DB::raw('(SUM(pembayaran.nominal) / SUM(tagihan.nominal)) * 100 as presentase_terbayar')
            ])
            ->groupBy('siswa.id')
            ->latest('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make("Nama siswa")
                ->label(function ($row) {
                    return $row->nama;
                }),

            Column::make("Kelas")
                ->label(function ($row) {
                    return $this->classroom->nama;
                }),

            Column::make("Total Tagihan")
                ->label(function ($row) {
                    return "Rp " . number_format($row->total_tagihan ?? 0, 2);
                }),

            Column::make("Diskon")
                ->label(function ($row) {
                    return "Rp " . number_format($row->total_diskon ?? 0, 2);
                }),

            Column::make("Total Terbayar")
                ->label(function ($row) {
                    return "Rp " . number_format($row->total_terbayar, 2);
                }),

            Column::make("Status Pembayaran")
                ->label(function ($row) {
                    return (($row->total_tagihan ?? 0) - ($row->total_diskon ?? 0)) <= ($row->total_terbayar ?? 0) ? 'lunas' : 'belum lunas';;
                }),
        ];
    }
}
