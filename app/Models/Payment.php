<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    protected $table = 'pembayaran';

    public function bill(): BelongsTo
    {
        return $this->belongsTo(Bill::class, 'id_tagihan');
    }
}
