<?php

namespace App\Jobs;

use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendPaymentBIllWhatsapp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Student $student;

    private int $nominal;

    private int $remainingAmount;

    /**
     * Create a new job instance.
     */
    public function __construct(Student $student, int $nominal, int $remainingAmount)
    {
        $this->student = $student;
        $this->nominal = $nominal;
        $this->remainingAmount = $remainingAmount;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $formattedNominal = number_format($this->nominal, 2);
        $formattedRemainingAmount = number_format($this->remainingAmount, 2);

        $message = <<<EOT
        Halo, tagihan bulanan berhasil dibayarkan.

        Berikut adalah rincian pembayaran:
        - NISN          : {$this->student->nisn}
        - Nama          : {$this->student->name}
        - Kelas         : {$this->student->classroom->name}
        - Bulan         : {$this->student->bills->last()->month}
        - Tahun         : {$this->student->bills->last()->school_year}
        - Nominal       : Rp. {$formattedNominal}
        - Sisa Tagihan  : Rp. {$formattedRemainingAmount}

        Terima kasih.
        EOT;

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => [
                'target' => $this->student->phone_number,
                'message' => $message,
                'countryCode' => '62', //optional
            ],
            CURLOPT_HTTPHEADER => [
                'Authorization: '.env('FONNTE_TOKEN'),
            ],
        ]);

        curl_exec($curl);
        curl_close($curl);
    }
}
