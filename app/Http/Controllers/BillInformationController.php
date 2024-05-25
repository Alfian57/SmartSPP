<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BillInformationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $children = Student::where('student_parent_id', $user->accountable->id)->get();

        if ($children->isEmpty() || request('student')) {
            $student = Student::where('id', request('student'))->firstOrFail();

            if ($student->student_parent_id !== $user->accountable->id) {
                abort(403);
            }
        } else {
            $student = $children->first();
        }

        return view('dashboard.pages.bill-informations.index', [
            'children' => $children,
            'student' => $student,
        ]);
    }

    public function show(Bill $bill)
    {
        Gate::authorize('view', $bill);

        return view('dashboard.pages.bill-informations.show', [
            'title' => 'Detail Informasi Tagihan',
            'bill' => $bill,
        ]);
    }
}
