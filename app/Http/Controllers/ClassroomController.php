<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use App\Models\Classroom;

class ClassroomController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.classrooms.index');
    }

    public function create()
    {
        return view('dashboard.pages.classrooms.create');
    }

    public function store(StoreClassroomRequest $request)
    {
        Classroom::create($request->validated());

        toast('Kelas berhasil ditambahkan', 'success');

        return redirect()->route('dashboard.classrooms.index');
    }

    public function edit(Classroom $classroom)
    {
        return view('dashboard.pages.classrooms.edit', [
            'classroom' => $classroom,
        ]);
    }

    public function update(UpdateClassroomRequest $request, Classroom $classroom)
    {
        $classroom->update($request->validated());

        toast('Kelas berhasil diperbarui', 'success');

        return redirect()->route('dashboard.classrooms.index');
    }

    public function destroy(Classroom $classroom)
    {
        $classroom->delete();

        toast('Kelas berhasil dihapus', 'success');

        return redirect()->route('dashboard.classrooms.index');
    }
}
