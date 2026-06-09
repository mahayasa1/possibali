<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use App\Mail\PengaduanMail;
use App\Models\Pengaduan;

class PengaduanController extends Controller
{
    /**
     * Halaman utama pengaduan (form + tracking dalam satu view).
     * GET /pengaduan
     * POST /pengaduan/tracking  → redirect kembali ke sini dengan hasil
     */
    public function index(Request $request)
    {
        $pengaduan = null;
        $error     = null;

        // Jika ada hasil tracking yang di-flash dari method tracking(),
        // ambil dari session.  Ini opsional — lihat catatan di bawah.
        if (session()->has('tracking_result')) {
            $pengaduan = session('tracking_result');
        }
        if (session()->has('tracking_error')) {
            $error = session('tracking_error');
        }

        return view('pengaduan.index', compact('pengaduan', 'error'));
    }

    /* ── Submit form pengaduan ───────────────────────────── */

    public function sendPengaduan(Request $request)
    {
        $request->validate([
            'nama_pelapor'  => 'required|string|max:100',
            'email_pelapor' => 'required|email|max:150',
            'telepon'       => 'nullable|string|max:20',
            'kategori'      => 'required|in:perilaku,administrasi,fasilitas,keselamatan,lainnya',
            'judul'         => 'required|string|max:200',
            'kronologi'     => 'required|string|min:50|max:5000',
            'bukti'         => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'anonim'        => 'nullable|boolean',
        ]);

        // Rate limit: maks 2 pengaduan per IP per 30 menit
        $key = 'pengaduan:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 2)) {
            return back()->withInput()
                ->withErrors(['_ratelimit' => 'Terlalu banyak pengaduan. Coba lagi dalam '
                    . RateLimiter::availableIn($key) . ' detik.']);
        }
        RateLimiter::hit($key, 1800);

        // Upload bukti
        $buktiPath = null;
        $buktiNama = null;
        if ($request->hasFile('bukti')) {
            $file      = $request->file('bukti');
            $buktiPath = $file->store('pengaduan', 'local');
            $buktiNama = $file->getClientOriginalName();
        }

        // Simpan ke DB
        $pengaduan = Pengaduan::create([
            'nomor_tiket'   => Pengaduan::generateNomorTiket(),
            'nama_pelapor'  => $request->nama_pelapor,
            'email_pelapor' => $request->email_pelapor,
            'telepon'       => $request->telepon,
            'kategori'      => $request->kategori,
            'judul'         => $request->judul,
            'kronologi'     => $request->kronologi,
            'bukti_path'    => $buktiPath,
            'bukti_nama'    => $buktiNama,
            'anonim'        => $request->boolean('anonim'),
            'ip_address'    => $request->ip(),
            'status'        => 'diterima',
        ]);

        // Log pertama
        $pengaduan->logs()->create([
            'status_lama' => null,
            'status_baru' => 'diterima',
            'keterangan'  => 'Pengaduan diterima melalui website.',
        ]);

        // Kirim email
        $data = array_merge($pengaduan->toArray(), [
            'waktu' => now()->timezone('Asia/Makassar')->format('d M Y, H:i') . ' WITA',
            'ip'    => $request->ip(),
        ]);

        Mail::to(config('mail.pengaduan_address', 'pengaduan@possibali.org'))
            ->send(new PengaduanMail($data));

        Mail::to($pengaduan->email_pelapor)
            ->send(new PengaduanMail($data, autoReply: true));

        return back()->with(
            'success_pengaduan',
            "Pengaduan Anda diterima dengan nomor tiket <strong>{$pengaduan->nomor_tiket}</strong>. "
            . "Kami akan menindaklanjuti dalam 3–5 hari kerja. Konfirmasi dikirim ke email Anda."
        );
    }

    /* ── Tracking status pengaduan ───────────────────────── */

    /**
     * View menampilkan form tracking DAN hasilnya di halaman yang sama (index.blade.php).
     * Method ini mem-POST, lalu me-redirect kembali ke #tracking dengan data di session,
     * sehingga URL tetap bersih dan tidak ada masalah refresh-ulang POST.
     */
    public function tracking(Request $request)
{
    $request->validate([
        'nomor_tiket'   => 'required|string|max:30',
        'email_pelapor' => 'required|email|max:150',
    ]);

    $pengaduan = Pengaduan::with('logs')
        ->where('nomor_tiket', strtoupper(trim($request->nomor_tiket)))
        ->where('email_pelapor', strtolower(trim($request->email_pelapor)))
        ->first();

    if (!$pengaduan) {
        return redirect()
            ->route('pengaduan.index')
            ->withInput()
            ->with('tracking_error', 'Pengaduan tidak ditemukan.')
            ->withFragment('tracking');
    }

    return view('pengaduan.index', [
        'pengaduan' => $pengaduan,
        'error' => null,
    ]);
}
}