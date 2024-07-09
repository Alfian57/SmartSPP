<?php

namespace App\Http\Controllers;

use App\Enums\BillStatus;
use App\Enums\OrphanStatus;
use App\Events\OnAccountCreated;
use App\Exports\StudentBillsExport;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Mail\MonthlyBillMail;
use App\Models\Bill;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\StudentParent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.students.index');
    }

    public function create()
    {
        $classrooms = Classroom::pluck('nama', 'id');
        $studentParents = StudentParent::pluck('nama', 'id');

        return view('dashboard.pages.students.create', [
            'classrooms' => $classrooms,
            'studentParents' => $studentParents,
        ]);
    }

    public function store(StoreStudentRequest $request)
    {
        DB::transaction(function () use ($request) {
            $student = Student::create($request->except('email'));
            OnAccountCreated::dispatch($request->nama, $request->email, $student);


            // create bill
            $firstYear = now()->format('m') <= 6 ? now()->format('Y') - 1 : now()->format('Y');
            $secondYear = now()->format('m') <= 6 ? now()->format('Y') : now()->format('Y') + 1;

            $familyDiscount = $student->studentParent->students->count() >= 2 ? config('spp.family_discount') : 0;
            $orphanDiscount = $student->studentParent->status !== OrphanStatus::NONE->value ? config('spp.orphan_discount') : 0;

            $student->bills()->create([
                'nominal' => $student->classroom->spp_price,
                'bulan' => now()->format('F'),
                'tahun_ajaran' => $firstYear . '/' . $secondYear,
                'diskon' => $familyDiscount + $orphanDiscount,
                'status' => BillStatus::NOT_PAID_OFF->value,
            ]);

            $price = $student->classroom->spp_price - $familyDiscount - $orphanDiscount;
            Mail::to($student->account->email)->queue(new MonthlyBillMail($student->nama, $price));
        });

        toast('Siswa berhasil dibuat', 'success');

        return redirect()->route('dashboard.students.index');
    }

    public function edit(Student $student)
    {
        $classrooms = Classroom::pluck('nama', 'id');
        $studentParents = StudentParent::pluck('nama', 'id');

        return view('dashboard.pages.students.edit', [
            'student' => $student,
            'classrooms' => $classrooms,
            'studentParents' => $studentParents,
        ]);
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->validated());

        toast('Siswa berhasil diperbarui', 'success');

        return redirect()->route('dashboard.students.index');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        toast('Siswa berhasil dihapus', 'success');

        return redirect()->route('dashboard.students.index');
    }

    public function export(Student $student)
    {
        $fileName = date('Y-m-d_H:i:s') . '_tagihan_' . $student->nama . '.xlsx';

        return Excel::download(new StudentBillsExport($student), $fileName);
    }
}
