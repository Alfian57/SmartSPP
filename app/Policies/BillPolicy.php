<?php

namespace App\Policies;

use App\Helpers\Role;
use App\Models\Account;
use App\Models\Bill;

class BillPolicy
{
    public function view(Account $account, Bill $bill): bool
    {
        if (Role::check('admin')) {
            return true;
        }

        if (Role::check('student_parent')) {
            return $account->accountable->id === $bill->student->student_parent_id;
        }

        if (Role::check('student')) {
            return $account->accountable->id === $bill->student_id;
        }

        return false;
    }

    public function create(Account $account, Bill $bill): bool
    {
        if (Role::check('admin')) {
            return false;
        }

        return $account->accountable->id === $bill->student->student_parent_id;
    }

    public function edit(Account $account, Bill $bill): bool
    {
        if (Role::check('admin')) {
            return false;
        }

        return $account->accountable->id === $bill->student->student_parent_id;
    }

    public function delete(Account $account, Bill $bill): bool
    {
        if (Role::check('admin')) {
            return false;
        }

        return $account->accountable->id === $bill->student->student_parent_id;
    }
}
