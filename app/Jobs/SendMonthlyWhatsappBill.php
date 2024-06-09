<?php

namespace App\Jobs;

use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMonthlyWhatsappBill implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $phones;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $students = Student::pluck('no_telepon')->toArray();
        $this->phones = implode(',', $students);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $message = <<<'EOT'
            REMINDER 🌟
            
            Halo! Ini adalah pengingat ramah. Kami ingin mengingatkan Anda bahwa pembayaran SPP bulanan untuk bulan ini sudah bisa dibayarkan.
            
            📅 Waktu Pembayaran: 1 Bulan 
            💳 Cara Pembayaran: Transfer Bank dan Gopay
            
            Pastikan pembayaran dilakukan tepat waktu untuk menjaga kelancaran proses belajar mengajar. Jika Anda membutuhkan bantuan atau informasi lebih lanjut, jangan ragu untuk menghubungi admin kami.
            Terima kasih atas perhatian dan kerjasamanya.
            
            Salam hangat,
            Tim Administrasi
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
                'target' => $this->phones,
                'message' => $message,
                'delay' => '10',
                'countryCode' => '62',
            ],
            CURLOPT_HTTPHEADER => [
                'Authorization: '.env('FONNTE_TOKEN'),
            ],
        ]);

        curl_exec($curl);
        curl_close($curl);
    }
}
