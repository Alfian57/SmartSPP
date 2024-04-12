<?php

namespace App\Models;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable
{
    use HasFactory, HasUuids, Notifiable;

    protected $guarded = ['id'];

    public function role(): ?string
    {
        $roleMappings = [
            'App\Models\Student' => Role::STUDENT->value,
            'App\Models\StudentParent' => Role::STUDENT_PARENT->value,
            'App\Models\Admin' => Role::ADMIN->value,
        ];

        if (array_key_exists($this->accountable_type, $roleMappings)) {
            return $roleMappings[$this->accountable_type];
        }

        return null;
    }

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function accountable(): MorphTo
    {
        return $this->morphTo();
    }
}
