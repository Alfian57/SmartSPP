<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class MyBillController extends Controller
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

        return view('dashboard.pages.my-bills.index', [
            'title' => 'Tagihan Saya',
            'children' => $children,
            'student' => $student,
        ]);
    }
}
