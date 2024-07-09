<?php

namespace App\Console\Commands;

use App\Enums\BillStatus;
use App\Enums\OrphanStatus;
use App\Jobs\SendMonthlyWhatsappBill;
use App\Mail\MonthlyBillMail;
use App\Models\Student;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class GenerateMonthlyBill extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-monthly-bill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate monthly student bills';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Student::all()->each(function ($student) {
            $firstYear = now()->format('m') <= 6 ? now()->format('Y') - 1 : now()->format('Y');
            $secondYear = now()->format('m') <= 6 ? now()->format('Y') : now()->format('Y') + 1;

            $familyDiscount = $student->studentParent->students->count() >= 2 ? config('spp.family_discount') : 0;
            $orphanDiscount = $student->status !== OrphanStatus::NONE->value ? config('spp.orphan_discount') : 0;

            $student->bills()->create([
                'nominal' => $student->classroom->harga_spp,
                'bulan' => now()->format('F'),
                'tahun_ajaran' => $firstYear . '/' . $secondYear,
                'diskon' => $familyDiscount + $orphanDiscount,
                'status' => BillStatus::NOT_PAID_OFF->value,
            ]);

            Log::info('Monthly bill generated for ' . $student->nama . ' with nominal ' . $student->classroom->harga_spp . ' and discount ' . $familyDiscount + $orphanDiscount . ' for ' . now()->format('F') . ' ' . $firstYear . '/' . $secondYear . '.');
            Log::info($familyDiscount);
            Log::info($orphanDiscount);

            $price = $student->classroom->harga_spp - $familyDiscount - $orphanDiscount;
            Mail::to($student->account->email)->queue(new MonthlyBillMail($student->nama, $price));
        });

        SendMonthlyWhatsappBill::dispatch();
    }
}
