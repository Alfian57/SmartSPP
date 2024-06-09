<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'email' => ['required', 'email', 'max:100', 'unique:akun,email'],
            'nisn' => ['required', 'size:10', 'unique:siswa,nisn'],
            'nama' => ['required', 'string', 'max:100'],
            'jenis_kelamin' => ['required', 'in:laki-laki,perempuan'],
            'tanggal_lahir' => ['required', 'date'],
            'agama' => ['required', 'in:islam,kristen,katolik,hindu,budha,konghucu'],
            'status' => ['required', 'in:yatim-piatu,yatim,piatu,none'],
            'no_telepon' => ['required', 'string', 'max:25'],
            'alamat' => ['required', 'string'],
            'id_kelas' => ['required', 'exists:kelas,id'],
            'id_orang_tua' => ['required', 'exists:orang_tua,id'],
        ];
    }
}
