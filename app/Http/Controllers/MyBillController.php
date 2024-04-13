<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class MyBillController extends Controller
{
    public function index()
    {
        /** @var \App\Models\Account $user * */
        $user = Auth::user();

        $children = Student::query()
            ->where('student_parent_id', $user->accountable->id)
            ->get();

        if (! $children->isEmpty() && ! request('student')) {
            return redirect()->route('dashboard.my-bills.index', ['student' => $children->first()->id]);
        }

        $student = Student::query()
            ->when(request('student'), function ($query) {
                $query->where('id', request('student'));
            })
            ->with('bills', 'bills.payments')
            ->first();

        return view('dashboard.pages.my-bills.index', [
            'title' => 'Tagihan Saya',
            'children' => $children,
            'student' => $student,
        ]);
    }
}
