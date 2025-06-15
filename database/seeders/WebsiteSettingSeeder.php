<?php

namespace Database\Seeders;

use App\Models\WebsiteSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WebsiteSetting::updateOrCreate(
            ['id' => 1], // Always use ID 1 for single record
            [
                'site_name' => 'Astacita.co',
                'site_tagline' => 'Portal Berita Terpercaya Indonesia',
                'about_description' => '<p>Astacita.co adalah portal berita digital yang berkomitmen menyajikan informasi terkini, akurat, dan terpercaya untuk masyarakat Indonesia. Kami hadir untuk memberikan perspektif yang berimbang dalam setiap pemberitaan.</p>',
                'visi' => '<p>Menjadi portal berita digital terdepan yang memberikan informasi berkualitas tinggi dan terpercaya bagi masyarakat Indonesia.</p>',
                'misi' => '<ul><li>Menyajikan berita yang akurat, berimbang, dan objektif</li><li>Memberikan analisis mendalam terhadap isu-isu penting</li><li>Mendorong partisipasi masyarakat dalam diskusi publik</li><li>Mempertahankan standar jurnalistik yang tinggi</li></ul>',
                'about_short_description' => 'Portal berita digital Indonesia yang menyajikan informasi terkini, akurat, dan terpercaya dengan perspektif yang berimbang.',
                'year_established' => 2020,
                'editorial_team' => [
                    [
                        'name' => 'Ahmad Sutrisno',
                        'position' => 'Pemimpin Redaksi',
                        'email' => 'pemred@astacita.co',
                        'bio' => 'Berpengalaman lebih dari 15 tahun di bidang jurnalistik. Pernah bekerja di berbagai media nasional sebelum bergabung dengan Astacita.co.',
                        'photo' => null
                    ],
                    [
                        'name' => 'Sari Indrawati',
                        'position' => 'Redaktur Senior',
                        'email' => 'sari@astacita.co',
                        'bio' => 'Spesialis liputan politik dan ekonomi dengan pengalaman 10 tahun di media mainstream.',
                        'photo' => null
                    ],
                    [
                        'name' => 'Budi Prasetyo',
                        'position' => 'Reporter Senior',
                        'email' => 'budi@astacita.co',
                        'bio' => 'Fokus pada liputan investigasi dan isu-isu sosial kemasyarakatan.',
                        'photo' => null
                    ]
                ],
                'editorial_statement' => '<p>Tim redaksi Astacita.co berkomitmen untuk menjunjung tinggi kode etik jurnalistik dan menyajikan berita yang faktual, berimbang, serta bermanfaat bagi masyarakat. Kami selalu mengutamakan akurasi dan objektivitas dalam setiap pemberitaan.</p>',
                'ethics_code' => '<h2>Kode Etik Jurnalistik Astacita.co</h2>
                <h3>1. Independensi</h3>
                <p>Wartawan harus independen, bebas dari konflik kepentingan, dan tidak terpengaruh oleh pihak manapun.</p>
                <h3>2. Akurasi dan Keadilan</h3>
                <p>Wartawan wajib menyajikan berita yang akurat, berimbang, dan adil tanpa prasangka.</p>
                <h3>3. Profesionalisme</h3>
                <p>Wartawan harus bertindak profesional dalam menjalankan tugas jurnalistik.</p>
                <h3>4. Tanggung Jawab</h3>
                <p>Wartawan bertanggung jawab atas berita yang ditulis dan dampaknya terhadap masyarakat.</p>',
                'ethics_last_updated' => now()->toDateString(),
                'cyber_media_guidelines' => '<h2>Pedoman Media Cyber Astacita.co</h2>
                <h3>1. Verifikasi Konten</h3>
                <p>Setiap konten harus diverifikasi dari sumber yang kredibel sebelum dipublikasikan.</p>
                <h3>2. Koreksi dan Klarifikasi</h3>
                <p>Kesalahan harus segera dikoreksi dan dikomunikasikan kepada pembaca.</p>
                <h3>3. Interaksi dengan Pembaca</h3>
                <p>Moderasi komentar dilakukan untuk menjaga diskusi yang sehat dan konstruktif.</p>
                <h3>4. Privasi dan Data</h3>
                <p>Privasi pengguna dilindungi sesuai dengan peraturan yang berlaku.</p>',
                'guidelines_last_updated' => now()->toDateString(),
                'guidelines_reference' => 'Dewan Pers Republik Indonesia',
                'contact_email' => 'redaksi@astacita.co',
                'contact_phone' => '+62-21-1234-5678',
                'contact_address' => 'Jl. Merdeka No. 123, Jakarta Pusat 10110, DKI Jakarta, Indonesia',
                'maps_embed_code' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.8195613!3d-6.1944491!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5d2e764b12d%3A0x3d2ad6e1e0e9bcc8!2sMonas!5e0!3m2!1sen!2sid!4v1234567890" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
                'social_facebook' => 'https://facebook.com/astacita.co',
                'social_twitter' => 'https://twitter.com/astacitaco',
                'social_instagram' => 'https://instagram.com/astacita.co',
                'social_youtube' => 'https://youtube.com/c/astacitaco',
                'social_linkedin' => 'https://linkedin.com/company/astacita-co',
            ]
        );
    }
}