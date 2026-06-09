<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengaduan extends Model
{
    protected $fillable = [
        'nomor_tiket', 'nama_pelapor', 'email_pelapor', 'telepon',
        'kategori', 'judul', 'kronologi', 'bukti_path', 'bukti_nama',
        'anonim', 'ip_address', 'status', 'catatan_admin',
        'balasan_pelapor', 'diverifikasi_at', 'diproses_at',
        'selesai_at', 'handled_by',
    ];

    protected $casts = [
        'anonim'          => 'boolean',
        'diverifikasi_at' => 'datetime',
        'diproses_at'     => 'datetime',
        'selesai_at'      => 'datetime',
    ];

    /* ── Status config ──────────────────────────────────── */

    const STATUS_LABELS = [
        'diterima'    => 'Diterima',
        'diverifikasi'=> 'Diverifikasi',
        'diproses'    => 'Diproses',
        'selesai'     => 'Selesai',
        'ditolak'     => 'Ditolak',
    ];

    const STATUS_COLORS = [
        'diterima'    => 'ocean-bright',
        'diverifikasi'=> 'ocean-gold',
        'diproses'    => 'ocean-foam',
        'selesai'     => 'green',
        'ditolak'     => 'ocean-coral',
    ];

    // Urutan step untuk progress tracker (kecuali ditolak)
    const STATUS_STEPS = ['diterima', 'diverifikasi', 'diproses', 'selesai'];

    /* ── Relations ──────────────────────────────────────── */

    public function logs(): HasMany
    {
        return $this->hasMany(PengaduanLog::class)->latest();
    }

    public function handler(): BelongsTo
    {
        return $this->belongsTo(User::class, 'handled_by');
    }

    /* ── Helpers ────────────────────────────────────────── */

    public function getStatusLabelAttribute(): string
    {
        return self::STATUS_LABELS[$this->status] ?? $this->status;
    }

    /** Step index (0-based) untuk progress bar, -1 jika ditolak */
    public function getStatusStepAttribute(): int
    {
        return array_search($this->status, self::STATUS_STEPS) ?: 0;
    }

    public function isSelesai(): bool
    {
        return in_array($this->status, ['selesai', 'ditolak']);
    }

    /** Update status + catat log */
    public function updateStatus(string $statusBaru, string $keterangan = null, int $userId = null): void
    {
        $statusLama = $this->status;
        $timestamps = [
            'diverifikasi' => 'diverifikasi_at',
            'diproses'     => 'diproses_at',
            'selesai'      => 'selesai_at',
        ];

        $updateData = ['status' => $statusBaru];
        if (isset($timestamps[$statusBaru])) {
            $updateData[$timestamps[$statusBaru]] = now();
        }
        $this->update($updateData);

        $this->logs()->create([
            'status_lama' => $statusLama,
            'status_baru' => $statusBaru,
            'keterangan'  => $keterangan,
            'user_id'     => $userId,
        ]);
    }

    /* ── Generate nomor tiket unik ──────────────────────── */

    public static function generateNomorTiket(): string
    {
        do {
            $nomor = 'ADU-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -5));
        } while (self::where('nomor_tiket', $nomor)->exists());

        return $nomor;
    }
}