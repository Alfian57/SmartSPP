<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class SendMonthlyWhatsappBill implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $phoneNumber;

    /**
     * Create a new job instance.
     */
    public function __construct(string $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
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
                'target' => $this->phoneNumber,
                'message' => 'Bayar woi',
            ],
            CURLOPT_HTTPHEADER => [
                'Authorization: ' . env('FONNTE_TOKEN'),
            ],
        ]);

        curl_exec($curl);
        curl_close($curl);

        // try {
        //     $response = Http::withHeaders([
        //         'Authorization' => env('FONNTE_TOKEN'),
        //     ])->post('https://api.fonnte.com/send', [
        //         'target' => $this->phoneNumber,
        //         'message' => 'Bayar woi',
        //     ]);

        //     $response->throw();
        // } catch (RequestException $e) {
        //     throw new \Exception("Gagal mengirim pesan: " . $e->getMessage());
        // }
    }
}
