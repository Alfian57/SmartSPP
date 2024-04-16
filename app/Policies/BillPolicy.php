<?php

namespace App\Policies;

use App\Helpers\Role;
use App\Models\Account;
use App\Models\Bill;

class BillPolicy
{
    public function viewPayment(Account $account, Bill $bill): bool
    {
        if (Role::check('admin')) {
            return true;
        }



        return $account->accountable->id === $bill->student_id;
    }

    public function createPayment(Account $account, Bill $bill): bool
    {
        if (Role::check('admin')) {
            return false;
        }



        return $account->accountable->id === $bill->student_id;
    }

    public function editPayment(Account $account, Bill $bill): bool
    {
        if (Role::check('admin')) {
            return false;
        }



        return $account->accountable->id === $bill->student_id;
    }

    public function deletePayment(Account $account, Bill $bill): bool
    {
        if (Role::check('admin')) {
            return false;
        }



        return $account->accountable->id === $bill->student_id;
    }
}
