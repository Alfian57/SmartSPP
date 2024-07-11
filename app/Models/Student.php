<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Storage;

class Student extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    protected $table = 'siswa';

    protected static function booted(): void
    {
        static::deleting(function (Student $student) {
            if ($student->account?->foto_profil) {
                Storage::delete($student->account->foto_profil);
            }

            $student->account()->delete();
        });
    }

    public function account(): MorphOne
    {
        return $this->morphOne(Account::class, 'accountable');
    }

    public function studentParent(): BelongsTo
    {
        return $this->belongsTo(StudentParent::class, 'id_orang_tua');
    }

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class, 'id_kelas');
    }

    public function bills(): HasMany
    {
        return $this->hasMany(Bill::class, 'id_siswa');
    }

    public function payments(): HasManyThrough
    {
        return $this->hasManyThrough(Payment::class, Bill::class, 'id_siswa', 'id_tagihan');
    }
}
