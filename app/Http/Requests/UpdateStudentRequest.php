<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nisn' => ['required', 'size:10', Rule::unique("students", "nisn")->ignore($this->student->id)],
            'name' => ['required', 'string', 'max:100'],
            'gender' => ['required', 'in:male,female'],
            'date_of_birth' => ['required', 'date'],
            'religion' => ['required', 'in:islam,christianity,catholicism,hinduism,buddhism,confucianism'],
            'orphan_status' => ['required', 'in:orphan_both,orphan_father,orphan_mother,none'],
            'phone_number' => ['required', 'string', 'max:25'],
            'address' => ['required', 'string'],
            'classroom_id' => ['required', 'exists:classrooms,id'],
            'student_parent_id' => ['required', 'exists:student_parents,id'],
        ];
    }
}