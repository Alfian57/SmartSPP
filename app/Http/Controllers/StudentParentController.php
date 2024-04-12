<?php

namespace App\Http\Controllers;

use App\Events\OnAccountCreated;
use App\Http\Requests\StoreStudentParentRequest;
use App\Http\Requests\UpdateStudentParentRequest;
use App\Models\StudentParent;
use Illuminate\Support\Facades\DB;

class StudentParentController extends Controller
{
    public function index()
    {
        $studentParents = StudentParent::query()
            ->with('students')
            ->latest()
            ->paginate(25);

        return view('dashboard.pages.student-parents.index', [
            'title' => 'Manajemen Orang Tua',
            'studentParents' => $studentParents,
        ]);
    }

    public function create()
    {
        return view('dashboard.pages.student-parents.create', [
            'title' => 'Tambah Orang Tua',
        ]);
    }

    public function store(StoreStudentParentRequest $request)
    {
        DB::transaction(function () use ($request) {
            $studentParent = StudentParent::create($request->except('email'));
            OnAccountCreated::dispatch($request->name, $request->email, $studentParent);
        });

        toast('Orang Tua berhasil dibuat', 'success');

        return redirect()->route('dashboard.student-parents.index');
    }

    public function edit(StudentParent $studentParent)
    {
        return view('dashboard.pages.student-parents.edit', [
            'title' => 'Edit Orang Tua',
            'studentParent' => $studentParent,
        ]);
    }

    public function update(UpdateStudentParentRequest $request, StudentParent $studentParent)
    {
        $studentParent->update($request->validated());

        toast('Orang Tua berhasil diperbarui', 'success');

        return redirect()->route('dashboard.student-parents.index');
    }

    public function destroy(StudentParent $studentParent)
    {
        $studentParent->delete();

        toast('Orang Tua berhasil dihapus', 'success');

        return redirect()->route('dashboard.student-parents.index');
    }
}