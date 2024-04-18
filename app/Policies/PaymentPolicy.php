<?php

namespace App\Policies;

use App\Enums\PaymentStatus;
use App\Enums\Role;
use App\Models\Account;
use App\Models\Payment;
use Illuminate\Auth\Access\Response;

class PaymentPolicy
{
    public function edit(Account $account, Payment $payment): bool
    {
        if ($payment->status === PaymentStatus::PENDING->value) {
            return true;
        }

        return false;
    }

    public function delete(Account $account, Payment $payment): bool
    {
        if ($payment->status === PaymentStatus::PENDING->value) {
            return true;
        }

        return false;
    }
}
