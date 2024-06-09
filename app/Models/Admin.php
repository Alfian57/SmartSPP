<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Storage;

class Admin extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    protected $table = 'admin';

    protected static function booted(): void
    {
        static::deleting(function (Admin $admin) {
            if ($admin->account->foto_profil) {
                Storage::delete($admin->account->foto_profil);
            }

            $admin->account()->delete();
        });
    }

    public function account(): MorphOne
    {
        return $this->morphOne(Account::class, 'accountable');
    }
}
