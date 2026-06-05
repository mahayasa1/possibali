<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'title'                   => 'Kompetisi Selam Bali Open 2026',
                'type'                    => 'kompetisi',
                'icon'                    => '🏆',
                'description'             => 'Turnamen selam terbuka tingkat nasional dengan berbagai kategori: freediving, scuba, dan underwater photography. Event tahunan bergengsi yang mempertemukan atlet terbaik dari seluruh Indonesia di perairan Bali yang indah.',
                'location'               => 'Pantai Sanur, Denpasar',
                'event_date'             => '2026-07-12',
                'start_time'             => '07:00:00',
                'end_time'               => '17:00:00',
                'max_participants'        => 200,
                'registered_participants' => 120,
                'status'                 => 'open',
                'is_published'           => true,
            ],
            [
                'title'                   => 'Pelatihan Selam Dasar Bersertifikat',
                'type'                    => 'pelatihan',
                'icon'                    => '🤿',
                'description'             => 'Kursus selam dasar selama 3 hari dengan instruktur bersertifikat CMAS & SSI. Termasuk teori kelautan, teknik dasar selam, keselamatan bawah air, dan praktik langsung di laut.',
                'location'               => 'Kolam Renang Tirta Yasa, Denpasar',
                'event_date'             => '2026-07-19',
                'start_time'             => '08:00:00',
                'end_time'               => '16:00:00',
                'max_participants'        => 25,
                'registered_participants' => 18,
                'status'                 => 'open',
                'is_published'           => true,
            ],
            [
                'title'                   => 'Bersih Laut Bersama — Nusa Penida',
                'type'                    => 'sosial',
                'icon'                    => '🌿',
                'description'             => 'Aksi nyata menjaga kebersihan perairan Nusa Penida bersama ratusan penyelam sukarela dan komunitas lokal. Kegiatan meliputi pembersihan sampah dasar laut, pendataan terumbu karang, dan edukasi masyarakat pesisir.',
                'location'               => 'Crystal Bay, Nusa Penida',
                'event_date'             => '2026-07-26',
                'start_time'             => '06:00:00',
                'end_time'               => '13:00:00',
                'max_participants'        => 150,
                'registered_participants' => 85,
                'status'                 => 'open',
                'is_published'           => true,
            ],
            [
                'title'                   => 'Seminar Nasional: Masa Depan Selam Indonesia',
                'type'                    => 'seminar',
                'icon'                    => '🎓',
                'description'             => 'Diskusi panel dengan pakar kelautan, pelatih nasional, dan pejabat pemerintah tentang pengembangan olahraga selam Indonesia. Tema utama: strategi meningkatkan prestasi selam di kancah internasional.',
                'location'               => 'Hotel Grand Inna Bali Beach, Sanur',
                'event_date'             => '2026-08-02',
                'start_time'             => '09:00:00',
                'end_time'               => '17:00:00',
                'max_participants'        => 100,
                'registered_participants' => 67,
                'status'                 => 'open',
                'is_published'           => true,
            ],
            [
                'title'                   => 'Pra-PON Selam 2026 — Seleksi Bali',
                'type'                    => 'kompetisi',
                'icon'                    => '🥇',
                'description'             => 'Seleksi resmi atlet selam Bali untuk Pekan Olahraga Nasional 2026. Wajib diikuti seluruh atlet binaan POSSI Bali. Penilaian meliputi freediving, fin swimming, dan underwater obstacle course.',
                'location'               => 'Pantai Kuta, Badung',
                'event_date'             => '2026-08-09',
                'start_time'             => '06:30:00',
                'end_time'               => '15:00:00',
                'max_participants'        => 40,
                'registered_participants' => 40,
                'status'                 => 'penuh',
                'is_published'           => true,
            ],
            [
                'title'                   => 'Workshop Fotografi Bawah Laut',
                'type'                    => 'pelatihan',
                'icon'                    => '📸',
                'description'             => 'Pelajari teknik underwater photography dari fotografer profesional berpengalaman. Materi mencakup penggunaan kamera underwater, pencahayaan, komposisi, dan post-processing. Peserta mendapat sertifikat dan kesempatan pameran karya.',
                'location'               => 'Tulamben, Karangasem',
                'event_date'             => '2026-08-16',
                'start_time'             => '07:00:00',
                'end_time'               => '16:00:00',
                'max_participants'        => 15,
                'registered_participants' => 12,
                'status'                 => 'hampir penuh',
                'is_published'           => true,
            ],
            [
                'title'                   => 'Festival Laut Bali 2026',
                'type'                    => 'sosial',
                'icon'                    => '🌊',
                'description'             => 'Festival tahunan merayakan kecintaan masyarakat Bali terhadap laut. Rangkaian acara meliputi lomba selam tradisional, pameran foto bawah laut, pertunjukan seni budaya bahari, dan pasar kuliner hasil laut.',
                'location'               => 'Pantai Jimbaran, Badung',
                'event_date'             => '2026-09-06',
                'start_time'             => '08:00:00',
                'end_time'               => '21:00:00',
                'max_participants'        => 500,
                'registered_participants' => 230,
                'status'                 => 'open',
                'is_published'           => true,
            ],
            [
                'title'                   => 'Pelatihan Rescue Diver Tingkat Lanjut',
                'type'                    => 'pelatihan',
                'icon'                    => '🆘',
                'description'             => 'Pelatihan intensif rescue diver untuk anggota Satgas SAR POSSI Bali dan penyelam umum yang ingin meningkatkan kemampuan penyelamatan. Materi meliputi teknik evakuasi, pertolongan pertama bawah laut, dan koordinasi tim.',
                'location'               => 'Pantai Padang Bai, Karangasem',
                'event_date'             => '2026-09-20',
                'start_time'             => '07:00:00',
                'end_time'               => '17:00:00',
                'max_participants'        => 30,
                'registered_participants' => 8,
                'status'                 => 'open',
                'is_published'           => false,
            ],
        ];

        foreach ($events as $event) {
            Event::create([
                'title'                   => $event['title'],
                'slug'                    => Str::slug($event['title']) . '-' . Str::random(4),
                'type'                    => $event['type'],
                'icon'                    => $event['icon'],
                'description'             => $event['description'],
                'location'               => $event['location'],
                'event_date'             => $event['event_date'],
                'start_time'             => $event['start_time'],
                'end_time'               => $event['end_time'],
                'max_participants'        => $event['max_participants'],
                'registered_participants' => $event['registered_participants'],
                'status'                 => $event['status'],
                'is_published'           => $event['is_published'],
            ]);
        }
    }
}