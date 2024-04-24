<?php

namespace App\Http\Requests;

use App\Enums\PaymentStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class StoreMyPaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $payments = DB::table('payments')
            ->selectRaw('SUM(payments.nominal) as total_paid')
            ->join('bills', 'payments.bill_id', '=', 'bills.id')
            ->where('bills.id', $this->bill->id)
            ->where('payments.status', PaymentStatus::VALIDATED->value)
            ->value("total_paid");

        // dd($payments);
        $payments = (int) $payments ?? 0;

        $maxBill = $this->bill->nominal - $payments - $this->bill->discount;
        return [
            'nominal' => ['required', 'numeric', 'max:' . $maxBill],
            'transfer_file' => ['required', 'file', 'image', 'max:10240'],
        ];
    }
}
