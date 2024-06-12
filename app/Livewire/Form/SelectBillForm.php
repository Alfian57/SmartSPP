<?php

namespace App\Livewire\Form;

use App\Enums\PaymentStatus;
use App\Models\Bill;
use App\Models\Student;
use Livewire\Component;

class SelectBillForm extends Component
{
    public $studentOptions;

    public $billOptions;

    public $studentId;

    public function mount()
    {
        $students = Student::select('nama', 'id', 'nisn')->get();
        foreach ($students as $student) {
            $this->studentOptions[$student->id] = $student->nama.' | '.$student->nisn;
        }
        $this->billOptions = [
            '' => 'Pilih siswa terlebih dahulu',
        ];
    }

    public function updatedStudentId($studentId)
    {
        $this->billOptions = [];

        $student = Student::findOrFail($studentId);

        $student->bills->map(function ($bill) {
            $bill = Bill::query()
                ->addSelect([
                    'total_paid' => function ($query) {
                        $query->selectRaw('SUM(nominal) as total_paid')
                            ->from('pembayaran')
                            ->whereColumn('id_tagihan', 'tagihan.id')
                            ->where('status', PaymentStatus::VALIDATED->value);
                    },
                ])
                ->where('id', $bill->id)
                ->firstOrFail();

            $label = $bill->tahun_ajaran.' | '.$bill->bulan.' | '.($bill->nominal - $bill->total_paid - $bill->diskon);
            $this->billOptions[$bill->id] = $label;
        })->toArray();
    }

    public function render()
    {
        return view('dashboard.components.shared.form.select-bill-form');
    }
}
