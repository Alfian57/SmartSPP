<?php

namespace App\Livewire\Form;

use App\Models\Student;
use Livewire\Component;

class SelectBillForm extends Component
{
    public $studentOptions;

    public $billOptions;

    public $studentId;

    public function mount()
    {
        $this->studentOptions = Student::pluck('name', 'id');
        $this->billOptions = [];
    }

    public function updatedStudentId($studentId)
    {
        $this->billOptions = [];

        $student = Student::find($studentId);
        $student->bills->map(function ($bill) {
            $label = $bill->school_year.' | '.$bill->month.' | '.($bill->nominal - $bill->discount);
            $this->billOptions[$bill->id] = $label;
        })->toArray();
    }

    public function render()
    {
        return view('dashboard.components.shared.form.select-bill-form');
    }
}
