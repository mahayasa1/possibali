<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PengaduanMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;
    public bool $autoReply;

    public function __construct(array $data, bool $autoReply = false)
    {
        $this->data      = $data;
        $this->autoReply = $autoReply;
    }

    public function envelope(): Envelope
    {
        $subject = $this->autoReply
            ? "Tiket Pengaduan {$this->data['nomor_tiket']} Diterima — POSSI Bali"
            : "[POSSI Bali] Pengaduan Baru [{$this->data['nomor_tiket']}]: " . $this->data['judul'];

        return new Envelope(
            subject: $subject,
            replyTo: $this->autoReply ? [] : [new \Illuminate\Mail\Mailables\Address($this->data['email_pelapor'], $this->data['nama_pelapor'])],
        );
    }

    public function content(): Content
    {
        $view = $this->autoReply
            ? 'emails.pengaduan-autoreply'
            : 'emails.pengaduan-admin';

        return new Content(
            view: $view,
            with: ['data' => $this->data],
        );
    }
}