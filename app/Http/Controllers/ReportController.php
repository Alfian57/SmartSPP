<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    public function index()
    {
        $year = request('year');
        $month = request('month');

        if (!$year) {
            $year = date('Y');
        }

        if (!$month) {
            $month = strtolower(date('F'));
        }

        return view('dashboard.pages.reports.index', [
            'year' => $year,
            'month' => $month,
        ]);
    }

    public function show(Classroom $classroom)
    {
        $year = request('year');
        $month = request('month');

        if (!$year) {
            $year = date('Y');
        }

        if (!$month) {
            $month = strtolower(date('F'));
        }

        return view('dashboard.pages.reports.show', compact('classroom', 'year', 'month'));
    }

    public function export()
    {
        $year = request('year');
        $month = request('month');

        if (!$year) {
            $year = date('Y');
        }

        if (!$month) {
            $month = strtolower(date('F'));
        }

        try {
            $classrooms = Classroom::query()
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
                ->whereYear('tagihan.created_at', $year)
                ->where('tagihan.bulan', $month)
                ->where('pembayaran.status', 'tervalidasi')
                ->groupBy('kelas.id', 'kelas.nama', 'kelas.harga_spp', 'kelas.updated_at', 'kelas.created_at')
                ->orderBy('kelas.nama', 'asc')
                ->get();

            $totalBillsAll = $classrooms->sum('total_tagihan');
            $totalValidatedPaymentsAll = $classrooms->sum('total_terbayar');
            $totalRemainingBillsAll = $totalBillsAll - $totalValidatedPaymentsAll;
            $totalNumberOfStudentsAll = $classrooms->sum('students_count');

            // Generate PDF untuk semua laporan kelas
            $pdf = Pdf::loadView('pdf.bill-classroom', [
                'classrooms' => $classrooms,
                'month' => $month,
                'year' => $year,
                'totalBillsAll' => $totalBillsAll,
                'totalValidatedPaymentsAll' => $totalValidatedPaymentsAll,
                'totalRemainingBillsAll' => $totalRemainingBillsAll,
                'totalNumberOfStudentsAll' => $totalNumberOfStudentsAll,
            ]);

            return $pdf->download('laporan-tagihan-semua-kelas-' . $month . '-' . $year . '.pdf');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back();
        }
    }
}
