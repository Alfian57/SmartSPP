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
            // Ambil semua data kelas
            $classrooms = Classroom::with('students.bills.payments')->get();
            $reports = [];

            // Inisialisasi variabel untuk total keseluruhan
            $totalBillsAll = 0;
            $totalValidatedPaymentsAll = 0;
            $totalNumberOfStudentsAll = 0;

            // Iterasi setiap kelas
            foreach ($classrooms as $classroom) {
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

                // Tambahkan ke total keseluruhan
                $totalBillsAll += $totalBills;
                $totalValidatedPaymentsAll += $totalValidatedPayments;
                $totalNumberOfStudentsAll += $classroom->students->count();

                // Buat data laporan untuk kelas ini
                $data = [
                    'classroom' => $classroom->nama,
                    'number_of_students' => $classroom->students->count(),
                    'total_bills' => $totalBills,
                    'total_validated_payments' => $totalValidatedPayments,
                    'total_remaining_bills' => $totalRemainingBills,
                    'payment_percentage' => $paymentPercentage,
                ];

                $reports[] = $data;
            }

            // Generate PDF untuk semua laporan kelas
            $pdf = Pdf::loadView('pdf.bill-classroom', [
                'reports' => $reports,
                'month' => $month,
                'year' => $year,
                'totalBillsAll' => $totalBillsAll,
                'totalValidatedPaymentsAll' => $totalValidatedPaymentsAll,
                'totalNumberOfStudentsAll' => $totalNumberOfStudentsAll,
            ]);

            return $pdf->download('laporan-tagihan-semua-kelas-' . $month . '-' . $year . '.pdf');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back();
        }
    }
}
