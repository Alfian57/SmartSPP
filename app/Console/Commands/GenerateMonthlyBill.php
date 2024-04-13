<?php

namespace App\Console\Commands;

use App\Enums\Enum\BillStatus;
use App\Models\Student;
use Illuminate\Console\Command;

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

            $student->bills()->create([
                'nominal' => config('spp.nominal'),
                'month' => now()->format('F'),
                'school_year' => $firstYear.'/'.$secondYear,
                'discount' => $student->studentParent->students->count() >= 2 ? config('spp.discount') : 0,
                'status' => BillStatus::NotPaidOff->value,
            ]);
        });
    }
}
