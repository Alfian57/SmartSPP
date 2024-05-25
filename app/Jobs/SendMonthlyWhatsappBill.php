<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\RequestException;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendMonthlyWhatsappBill implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $phoneNumber;

    private $price;

    /**
     * Create a new job instance.
     */
    public function __construct(string $phoneNumber, $price)
    {
        $this->phoneNumber = $phoneNumber;
        $this->price = $price;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => env('FONNTE_TOKEN'),
            ])->post('https://api.fonnte.com/send', [
                'target' => $this->phoneNumber,
                'message' => 'Halo, ini adalah tagihan bulanan sekolah. Silakan segera membayar tagihan sebesar Rp. '.number_format($this->price, 2).'. Terima kasih.',
            ]);

            $response->throw();
        } catch (RequestException $e) {
            throw new \Exception('Gagal mengirim pesan: '.$e->getMessage());
        }
    }
}
