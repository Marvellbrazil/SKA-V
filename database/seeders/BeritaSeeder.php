<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $beritas = [
            [
                'title' => 'Pembaruan Sistem Akademik Semester Genap',
                'slug' => 'pembaruan-sistem-akademik-semester-genap',
                'deskripsi' => 'Informasi mengenai pemeliharaan rutin sistem akademik.',
                'content' => 'Sistem akan mengalami downtime pada hari Sabtu pukul 22:00 WIB untuk optimasi database.',
                'gambar' => '',
                'views' => 105,
                'type' => 'PENGUMUMAN'
            ],
            [
                'title' => 'Seminar Nasional Teknologi AI 2026',
                'slug' => 'seminar-nasional-teknologi-ai-2026',
                'deskripsi' => 'Menghadirkan pakar industri dari berbagai perusahaan teknologi.',
                'content' => 'Acara ini akan membahas implementasi generative AI di sektor manufaktur dan pendidikan.',
                'gambar' => '',
                'views' => 450,
                'type' => 'ACARA'
            ],
            [
                'title' => 'Bakti Sosial Mahasiswa di Desa Pelosok',
                'slug' => 'bakti-sosial-mahasiswa-desa-pelosok',
                'deskripsi' => 'Kegiatan rutin tahunan Himpunan Mahasiswa.',
                'content' => 'Fokus utama kegiatan adalah edukasi sanitasi dan pemberian bantuan alat tulis.',
                'gambar' => '',
                'views' => 210,
                'type' => 'KEGIATAN'
            ],
            [
                'title' => 'Penerimaan Beasiswa Prestasi Gelombang 2',
                'slug' => 'penerimaan-beasiswa-prestasi-gelombang-2',
                'deskripsi' => 'Pendaftaran dibuka bagi mahasiswa dengan IPK di atas 3.75.',
                'content' => 'Segera siapkan berkas administrasi dan sertifikat pendukung sebelum akhir bulan.',
                'gambar' => '',
                'views' => 890,
                'type' => 'PENGUMUMAN'
            ],
            [
                'title' => 'Workshop UI/UX Design for Mobile',
                'slug' => 'workshop-ui-ux-design-for-mobile',
                'deskripsi' => 'Belajar fundamental desain aplikasi mobile menggunakan Figma.',
                'content' => 'Materi mencakup wireframing, prototyping, hingga usability testing.',
                'gambar' => '',
                'views' => 320,
                'type' => 'ACARA'
            ],
            [
                'title' => 'Lomba Inovasi Teknologi Tepat Guna',
                'slug' => 'lomba-inovasi-teknologi-tepat-guna',
                'deskripsi' => 'Ajang kompetisi ide kreatif untuk solusi masyarakat.',
                'content' => 'Peserta diharapkan membawa prototipe fisik untuk dipresentasikan di depan dewan juri.',
                'gambar' => '',
                'views' => 150,
                'type' => 'KEGIATAN'
            ],
            [
                'title' => 'Perubahan Jadwal Ujian Tengah Semester',
                'slug' => 'perubahan-jadwal-ujian-tengah-semester',
                'deskripsi' => 'Revisi jadwal untuk mata kuliah umum.',
                'content' => 'Harap periksa kembali dashboard masing-masing karena ada pergeseran jam ujian.',
                'gambar' => '',
                'views' => 1200,
                'type' => 'PENGUMUMAN'
            ],
            [
                'title' => 'Webinar Karir: Persiapan Kerja di Startup',
                'slug' => 'webinar-karir-persiapan-kerja-startup',
                'deskripsi' => 'Tips interview dan penyusunan CV ATS-friendly.',
                'content' => 'Menghadirkan HRD dari Tech Unicorn untuk membagikan rahasia dapur rekrutmen.',
                'gambar' => '',
                'views' => 560,
                'type' => 'ACARA'
            ],
            [
                'title' => 'Pelatihan Penulisan Jurnal Ilmiah',
                'slug' => 'pelatihan-penulisan-jurnal-ilmiah',
                'deskripsi' => 'Meningkatkan sitasi dan kualitas publikasi dosen.',
                'content' => 'Teknik penggunaan Mendeley dan pemilihan publisher terindeks Scopus.',
                'gambar' => '',
                'views' => 180,
                'type' => 'KEGIATAN'
            ],
            [
                'title' => 'Pengumuman Libur Hari Raya',
                'slug' => 'pengumuman-libur-hari-raya',
                'deskripsi' => 'Penyesuaian operasional kantor selama masa libur.',
                'content' => 'Seluruh layanan administrasi akan tutup sementara dan buka kembali pada H+7.',
                'gambar' => '',
                'views' => 2000,
                'type' => 'PENGUMUMAN'
            ],
            [
                'title' => 'Turnamen E-Sport Kampus 2026',
                'slug' => 'turnamen-e-sport-kampus-2026',
                'deskripsi' => 'Kompetisi persahabatan Mobile Legends dan Valorant.',
                'content' => 'Pendaftaran tim dibuka hingga jumat depan dengan total hadiah jutaan rupiah.',
                'gambar' => '',
                'views' => 740,
                'type' => 'ACARA'
            ],
            [
                'title' => 'Workshop Cybersecurity Awareness',
                'slug' => 'workshop-cybersecurity-awareness',
                'deskripsi' => 'Cara melindungi data pribadi di era digital.',
                'content' => 'Demo langsung mengenai serangan phishing dan cara pencegahannya secara teknis.',
                'gambar' => '',
                'views' => 410,
                'type' => 'KEGIATAN'
            ],
        ];

        foreach ($beritas as $berita) {
            Berita::create($berita);
        }
    }
}
