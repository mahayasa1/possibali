<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengaduanLog extends Model
{
    protected $fillable = [
        'pengaduan_id', 'status_lama', 'status_baru', 'keterangan', 'user_id',
    ];

    public function pengaduan(): BelongsTo
    {
        return $this->belongsTo(Pengaduan::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusBaruLabelAttribute(): string
    {
        return Pengaduan::STATUS_LABELS[$this->status_baru] ?? $this->status_baru;
    }
}