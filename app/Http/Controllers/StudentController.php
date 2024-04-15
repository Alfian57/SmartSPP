<?php

namespace App\Http\Controllers;

use App\Events\OnAccountCreated;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\StudentParent;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.students.index', [
            'title' => 'Manajemen Siswa',
        ]);
    }

    public function create()
    {
        $classrooms = Classroom::pluck('name', 'id');
        $studentParents = StudentParent::pluck('name', 'id');

        return view('dashboard.pages.students.create', [
            'title' => 'Tambah Siswa',
            'classrooms' => $classrooms,
            'studentParents' => $studentParents,
        ]);
    }

    public function store(StoreStudentRequest $request)
    {
        DB::transaction(function () use ($request) {
            $student = Student::create($request->except('email'));
            OnAccountCreated::dispatch($request->name, $request->email, $student);
        });

        toast('Siswa berhasil dibuat', 'success');

        return redirect()->route('dashboard.students.index');
    }

    public function edit(Student $student)
    {
        $classrooms = Classroom::pluck('name', 'id');
        $studentParents = StudentParent::pluck('name', 'id');

        return view('dashboard.pages.students.edit', [
            'title' => 'Edit Siswa',
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
}
