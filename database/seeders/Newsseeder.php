<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $adminId = User::where('is_admin', true)->first()?->id ?? 1;

        $newsItems = [
            [
                'category'     => 'prestasi',
                'icon'         => '🏆',
                'title'        => 'Atlet Selam POSSI Bali Raih 3 Medali Emas di Kejuaraan Nasional Selam 2026',
                'excerpt'      => 'Tim selam POSSI Bali tampil gemilang di Kejuaraan Nasional Selam yang digelar di Manado.',
                'content'      => 'Tim selam POSSI Bali tampil gemilang di Kejuaraan Nasional Selam yang digelar di Manado. Tiga atlet andalan berhasil menorehkan prestasi terbaik sepanjang sejarah organisasi, membawa pulang tiga medali emas sekaligus mengukuhkan Bali sebagai kekuatan selam nasional. Pencapaian luar biasa ini merupakan hasil dari program latihan intensif selama enam bulan yang dirancang oleh pelatih kepala POSSI Bali. Para atlet berlatih setiap hari dengan standar internasional, mempersiapkan diri untuk kompetisi bergengsi ini. Ke depan, POSSI Bali berkomitmen untuk terus meningkatkan kualitas pembinaan atlet demi mengharumkan nama Indonesia di kancah internasional.',
                'read_time'    => 5,
                'is_featured'  => true,
                'is_published' => true,
            ],
            [
                'category'     => 'organisasi',
                'icon'         => '🌊',
                'title'        => 'Rapat Koordinasi POSSI Bali Kuartal II 2026',
                'excerpt'      => 'Pembahasan program kerja semester dua dan evaluasi pencapaian target organisasi bersama seluruh pengurus cabang.',
                'content'      => 'POSSI Bali menggelar rapat koordinasi kuartal II 2026 yang dihadiri seluruh pengurus cabang dari sembilan kabupaten/kota di Bali. Agenda utama meliputi evaluasi program kerja semester pertama dan penyusunan rencana kegiatan semester kedua. Dalam rapat tersebut, disepakati beberapa program prioritas antara lain peningkatan jumlah atlet bersertifikat, pengembangan infrastruktur latihan, dan perluasan program edukasi selam ke sekolah-sekolah. Ketua POSSI Bali menegaskan komitmen organisasi untuk terus berinovasi demi kemajuan olahraga selam di Bali.',
                'read_time'    => 3,
                'is_featured'  => false,
                'is_published' => true,
            ],
            [
                'category'     => 'edukasi',
                'icon'         => '🤿',
                'title'        => 'Program Sertifikasi Selam Gratis untuk Pelajar Bali',
                'excerpt'      => 'POSSI Bali meluncurkan program beasiswa sertifikasi selam internasional bagi 50 pelajar SMA se-Bali tahun ini.',
                'content'      => 'Dalam rangka meningkatkan minat generasi muda terhadap olahraga selam, POSSI Bali meluncurkan program sertifikasi selam gratis untuk 50 pelajar SMA terpilih se-Bali. Program ini mencakup pelatihan teori kelautan, teknik selam dasar, keselamatan bawah air, dan ujian sertifikasi internasional berstandar CMAS. Peserta terpilih akan mendapatkan fasilitas lengkap termasuk peralatan selam, biaya pelatihan, dan akomodasi selama program berlangsung. Pendaftaran dibuka mulai 1 Juli 2026 melalui website resmi POSSI Bali.',
                'read_time'    => 4,
                'is_featured'  => false,
                'is_published' => true,
            ],
            [
                'category'     => 'lingkungan',
                'icon'         => '🐠',
                'title'        => 'Aksi Bersih Laut Bersama 200 Penyelam di Nusa Penida',
                'excerpt'      => 'Ratusan penyelam sukarela dari berbagai club bergabung dalam misi pembersihan sampah plastik di perairan Nusa Penida.',
                'content'      => 'Sebanyak 200 penyelam dari berbagai club selam di Bali berpartisipasi dalam aksi bersih laut di perairan Nusa Penida. Kegiatan yang berlangsung selama dua hari ini berhasil mengumpulkan lebih dari 500 kilogram sampah plastik dari dasar laut. Selain pembersihan sampah, kegiatan ini juga dimanfaatkan untuk pendataan kondisi terumbu karang dan populasi ikan di kawasan tersebut. POSSI Bali berencana menjadikan kegiatan ini sebagai agenda rutin triwulanan sebagai bentuk nyata kepedulian komunitas selam terhadap kelestarian ekosistem laut Bali.',
                'read_time'    => 3,
                'is_featured'  => false,
                'is_published' => true,
            ],
            [
                'category'     => 'prestasi',
                'icon'         => '🎖️',
                'title'        => 'POSSI Bali Terima Penghargaan Organisasi Selam Terbaik',
                'excerpt'      => 'Penghargaan diberikan oleh POSSI Pusat atas konsistensi dalam pembinaan atlet dan kegiatan pelestarian laut.',
                'content'      => 'POSSI Bali menerima penghargaan sebagai Organisasi Selam Terbaik tingkat provinsi dari POSSI Pusat dalam acara Munas POSSI 2026 di Jakarta. Penghargaan ini diberikan atas konsistensi POSSI Bali dalam pembinaan atlet berprestasi, penyelenggaraan event berkualitas, serta program pelestarian ekosistem laut yang berkelanjutan. Ketua POSSI Bali menyampaikan rasa terima kasih kepada seluruh pengurus, pelatih, atlet, dan anggota yang telah bekerja keras selama ini. Penghargaan ini menjadi motivasi untuk terus meningkatkan kualitas dan kontribusi POSSI Bali bagi olahraga selam nasional.',
                'read_time'    => 2,
                'is_featured'  => false,
                'is_published' => true,
            ],
            [
                'category'     => 'organisasi',
                'icon'         => '📋',
                'title'        => 'Musyawarah Daerah POSSI Bali: Pemilihan Pengurus Baru',
                'excerpt'      => 'Musda POSSI Bali 2026 berlangsung sukses dengan terpilihnya kepengurusan baru periode 2026–2030.',
                'content'      => 'Musyawarah Daerah (Musda) POSSI Bali 2026 resmi digelar di Hotel Grand Inna Bali Beach, Sanur. Acara yang dihadiri perwakilan dari seluruh club selam se-Bali ini menghasilkan kepengurusan baru POSSI Bali periode 2026–2030. Ketua terpilih memaparkan visi dan misi untuk membawa POSSI Bali ke level lebih tinggi, termasuk target mengirimkan atlet ke SEA Games 2027 dan meningkatkan jumlah club selam bersertifikat di seluruh Bali. Musda juga menyepakati program kerja prioritas dan anggaran organisasi untuk empat tahun ke depan.',
                'read_time'    => 4,
                'is_featured'  => false,
                'is_published' => true,
            ],
            [
                'category'     => 'lingkungan',
                'icon'         => '🌿',
                'title'        => 'Transplantasi Terumbu Karang di Perairan Amed Bali',
                'excerpt'      => 'Kolaborasi POSSI Bali dengan Dinas Kelautan menanam 500 fragmen terumbu karang di lokasi yang mengalami kerusakan.',
                'content'      => 'POSSI Bali bersama Dinas Kelautan dan Perikanan Provinsi Bali berhasil melaksanakan program transplantasi terumbu karang di perairan Amed, Karangasem. Sebanyak 500 fragmen terumbu karang dari berbagai spesies ditanam di area seluas 200 meter persegi yang sebelumnya mengalami kerusakan akibat pemutihan karang. Tim penyelam dari Satgas Konservasi POSSI Bali bekerja selama tiga hari penuh untuk mempersiapkan substrat dan menanam fragmen karang dengan teknik yang tepat. Hasil monitoring akan dilakukan secara berkala setiap tiga bulan untuk memastikan pertumbuhan terumbu karang yang optimal.',
                'read_time'    => 5,
                'is_featured'  => false,
                'is_published' => true,
            ],
            [
                'category'     => 'edukasi',
                'icon'         => '📚',
                'title'        => 'POSSI Bali Luncurkan Modul Edukasi Selam untuk SD dan SMP',
                'excerpt'      => 'Modul pembelajaran berbasis kurikulum lokal tentang ekosistem laut dan dasar-dasar keselamatan selam.',
                'content'      => 'POSSI Bali bekerja sama dengan Dinas Pendidikan Provinsi Bali meluncurkan modul edukasi selam yang dirancang khusus untuk siswa SD dan SMP. Modul ini mencakup materi pengenalan ekosistem laut, biodiversitas perairan Bali, dasar-dasar keselamatan selam, dan pentingnya menjaga kelestarian laut. Sebanyak 50 sekolah di seluruh Bali akan menerima modul ini secara gratis pada tahun ajaran 2026/2027. Program ini diharapkan dapat menumbuhkan kecintaan generasi muda terhadap laut sekaligus mempersiapkan calon-calon atlet selam berbakat dari usia dini.',
                'read_time'    => 3,
                'is_featured'  => false,
                'is_published' => false,
            ],
        ];

        foreach ($newsItems as $item) {
            News::create([
                'user_id'      => $adminId,
                'title'        => $item['title'],
                'slug'         => Str::slug($item['title']) . '-' . Str::random(4),
                'category'     => $item['category'],
                'icon'         => $item['icon'],
                'excerpt'      => $item['excerpt'],
                'content'      => $item['content'],
                'read_time'    => $item['read_time'],
                'is_featured'  => $item['is_featured'],
                'is_published' => $item['is_published'],
            ]);
        }
    }
}