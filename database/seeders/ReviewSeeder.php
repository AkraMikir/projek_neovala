<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Review;
use App\Models\ReviewReply;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = ['tpj', 'tpc', 'gkl', 'plu', 'gwc', 'pgv', 'gpc', 'bsr', 'spl'];
        $contentsShort = [
            'Bagus banget, recommended!',
            'Nyaman dan bersih.',
            'Mantap, akan balik lagi.',
            'Oke sip.',
            'Lokasi strategis.',
            'Pelayanan ramah.',
            'test',
            'okeeee',
            'Test',
        ];
        $contentsLong = [
            "Pengalaman menginap sangat menyenangkan. Apartemen bersih, fasilitas lengkap, dan lokasi strategis. Staff sangat membantu. Pasti akan kembali lagi dan merekomendasikan ke teman-teman.",
            "Saya sudah beberapa kali stay di sini dan selalu puas. Kebersihan terjaga, AC dingin, air panas berfungsi baik. Harga juga bersaing untuk lokasi segini. Terima kasih Neovala!",
            "Awalnya ragu karena pertama kali booking lewat sini, tapi ternyata prosesnya mudah dan apartemennya sesuai foto. Check-in cepat, lingkungan aman. Recomended buat staycation atau kerja.",
            "Apartemennya luas dan bersih. Dapur lengkap jadi bisa masak. Parkir mudah. Cuma satu yang kurang: wifi kadang lemot. Tapi overall worth it untuk harga segini.",
            "Baru pertama kali ke sini dan langsung suka. View bagus, kamar rapi, kamar mandi bersih. Pelayanan check-in/out cepat. Next time mau coba unit lain.",
        ];

        $instagramHandles = [
            'kaehiidiisshess', 'dessarrukmanaa', 'neovala_fan', 'traveler_jkt',
            'staycation_id', 'apartment_lover', null, null, null,
        ];

        $now = Carbon::now();
        $reviews = [];

        for ($i = 0; $i < 48; $i++) {
            $location = $locations[array_rand($locations)];
            $rating = rand(1, 5);
            $hideIdentity = (bool) rand(0, 1);
            $useLong = rand(0, 1);
            $content = $useLong
                ? $contentsLong[array_rand($contentsLong)]
                : $contentsShort[array_rand($contentsShort)];

            $reviews[] = [
                'location' => $location,
                'user_source' => 'user',
                'instagram' => $hideIdentity ? null : $instagramHandles[array_rand($instagramHandles)],
                'content' => $content,
                'rating' => $rating,
                'hide_identity' => $hideIdentity,
                'status' => 'accepted',
                'is_featured' => true,
                'created_at' => $now->copy()->subDays(rand(1, 120))->subHours(rand(0, 23)),
                'updated_at' => $now,
            ];
        }

        // Sort by created_at so we can assign ids predictably; then insert in chunks
        usort($reviews, fn ($a, $b) => $a['created_at'] <=> $b['created_at']);

        foreach ($reviews as $r) {
            Review::create($r);
        }

        // Add admin replies to some reviews
        $admin = Admin::first();
        if ($admin) {
            $reviewIds = Review::inRandomOrder()->limit(12)->pluck('id');
            foreach ($reviewIds as $reviewId) {
                ReviewReply::create([
                    'review_id' => $reviewId,
                    'admin_id' => $admin->id,
                    'content' => 'Terima kasih atas ulasannya! Kami senang bisa melayani Anda. Sampai jumpa lagi.',
                ]);
            }
        }
    }
}
