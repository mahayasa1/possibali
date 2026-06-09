<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_tiket', 30)->unique();    // ADU-20240601-AB12C
            $table->string('nama_pelapor', 100);
            $table->string('email_pelapor', 150);
            $table->string('telepon', 20)->nullable();
            $table->enum('kategori', ['perilaku','administrasi','fasilitas','keselamatan','lainnya']);
            $table->string('judul', 200);
            $table->text('kronologi');
            $table->string('bukti_path')->nullable();
            $table->string('bukti_nama')->nullable();
            $table->boolean('anonim')->default(false);
            $table->string('ip_address', 45)->nullable();

            // Status tracking
            $table->enum('status', [
                'diterima',      // baru masuk
                'diverifikasi',  // sudah dicek admin
                'diproses',      // sedang ditangani
                'selesai',       // selesai ditangani
                'ditolak',       // tidak valid / duplikat
            ])->default('diterima');

            $table->text('catatan_admin')->nullable();  // catatan internal admin
            $table->text('balasan_pelapor')->nullable(); // respons resmi ke pelapor
            $table->timestamp('diverifikasi_at')->nullable();
            $table->timestamp('diproses_at')->nullable();
            $table->timestamp('selesai_at')->nullable();
            $table->foreignId('handled_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
            $table->index(['nomor_tiket', 'email_pelapor']);
            $table->index('status');
        });

        Schema::create('pengaduan_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengaduan_id')->constrained()->cascadeOnDelete();
            $table->string('status_lama', 30)->nullable();
            $table->string('status_baru', 30);
            $table->text('keterangan')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // admin yg ubah
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduan_logs');
        Schema::dropIfExists('pengaduans');
    }
};