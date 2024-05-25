<?php

namespace App\Http\Requests;

use App\Enums\PaymentStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePaymentRequest extends FormRequest
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
        return [
            'nominal' => ['integer'],
            'transfer_file' => ['required', 'image', 'max:10240'],
            'status' => ['required', Rule::in(PaymentStatus::VALIDATED->value, PaymentStatus::UNVALIDATED->value, PaymentStatus::PENDING->value)],
            'bill_id' => ['required', 'exists:bills,id'],
        ];
    }
}
