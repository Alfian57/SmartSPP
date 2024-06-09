<?php

namespace Database\Factories;

use App\Enums\BillStatus;
use App\Enums\PaymentStatus;
use App\Models\Bill;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bill>
 */
class BillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nominal' => config('spp.nominal'),
            'bulan' => $this->faker->randomElement(['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december']),
            'tahun_ajaran' => $this->faker->randomElement(['2018/2019', '2019/2020', '2020/2021', '2021/2022', '2022/2023']),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Bill $bill) {
            Payment::factory(5)->create([
                'id_tagihan' => $bill->id,
            ]);

            if ($bill->payments->where('status', PaymentStatus::VALIDATED->value)->sum('nominal') >= $bill->nominal) {
                $bill->update([
                    'status' => BillStatus::PAID_OFF->value,
                ]);
            }
        });
    }
}
