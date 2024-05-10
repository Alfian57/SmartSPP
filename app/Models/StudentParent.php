<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Storage;

class StudentParent extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    protected static function booted(): void
    {
        static::deleted(function (StudentParent $studentParent) {
            if ($studentParent->account->profile_pic) {
                Storage::delete($studentParent->account->profile_pic);
            }

            $studentParent->account()->delete();
        });
    }

    public function account(): MorphOne
    {
        return $this->morphOne(Account::class, 'accountable');
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function bills(): HasManyThrough
    {
        return $this->hasManyThrough(Bill::class, Student::class);
    }
}
