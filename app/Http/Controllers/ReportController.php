<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Barryvdh\DomPDF\Facade\Pdf;
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
            // Ambil data kelas
            $classroom = Classroom::with('students.bills.payments')
                ->first();

            // Inisialisasi variabel untuk menghitung total
            $totalBills = 0;
            $totalValidatedPayments = 0;
            $totalDiscounts = 0;

            // Iterasi setiap siswa dalam kelas
            foreach ($classroom->students as $student) {
                foreach ($student->bills as $bill) {
                    if ($bill->bulan === $month && substr($bill->tahun_ajaran, 0, 4) == $year) {
                        $totalBills += $bill->nominal;
                        $totalDiscounts += $bill->diskon;

                        foreach ($bill->payments as $payment) {
                            if ($payment->status === 'tervalidasi') {
                                $totalValidatedPayments += $payment->nominal;
                            }
                        }
                    }
                }
            }

            $totalRemainingBills = $totalBills - $totalValidatedPayments - $totalDiscounts;
            $paymentPercentage = $totalBills ? ($totalValidatedPayments / $totalBills) * 100 : 0;

            // Buat data laporan
            $data = [
                'month' => $month,
                'year' => $year,
                'classroom' => $classroom->nama,
                'number_of_students' => $classroom->students->count(),
                'total_bills' => $totalBills,
                'total_validated_payments' => $totalValidatedPayments,
                'total_remaining_bills' => $totalRemainingBills,
                'payment_percentage' => $paymentPercentage,
            ];

            $pdf = Pdf::loadView('pdf.bill-classroom', $data);

            return $pdf->download('laporan-tagihan-kelas-' . $classroom->nama . '-' . $month . '-' . $year . '.pdf');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
