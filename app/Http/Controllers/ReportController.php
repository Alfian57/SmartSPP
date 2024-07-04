<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $year = request('year');
        $month = request('month');

        if (!$year) {
            $year = date('Y');
        }

        if (!$month) {
            $month = strtolower(date('F'));
        }

        return view('dashboard.pages.reports.index', [
            'year' => $year,
            'month' => $month,
        ]);
    }

    public function show(Classroom $classroom)
    {
        $year = request('year');
        $month = request('month');

        if (!$year) {
            $year = date('Y');
        }

        if (!$month) {
            $month = strtolower(date('F'));
        }

        return view('dashboard.pages.reports.show', compact('classroom', 'year', 'month'));
    }

    public function classroomExport()
    {
        // 
    }

    public function studentExport()
    {
        // 
    }
}
