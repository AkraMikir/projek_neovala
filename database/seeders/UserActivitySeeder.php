<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\UserActivity;
use Carbon\Carbon;
use Faker\Factory as Faker;

class UserActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        
        $apartmentTypes = ['TPJ', 'TPC', 'GKL', 'PLU', 'GWC', 'PGV', 'BSR', 'GPC'];
        $pages = [
            '/' => 'Home',
            '/discover-tpj' => 'TPJ',
            '/discover-tpc' => 'TPC',
            '/discover-gkl' => 'GKL',
            '/discover-plu' => 'PLU',
            '/discover-gwc' => 'GWC',
            '/discover-pgv' => 'PGV',
            '/discover-bsr' => 'BSR',
            '/discover-gpc' => 'GPC',
            '/promotions' => 'Promo'
        ];
        
        $activities = [
            'visit' => 70, // 70% chance
            'click_book_now' => 10,
            'submit_form' => 5,
            'click_download_promo' => 5,
            'submit_comment' => 10
        ];

        // 1. Data Tahun Lalu (Last Year) - 50 data
        $this->generateData($faker, Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear()->endOfYear(), 50, $apartmentTypes, $pages, $activities);

        // 2. Data Bulan Lalu (Last Month) - 100 data
        $this->generateData($faker, Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth(), 100, $apartmentTypes, $pages, $activities);

        // 3. Data Minggu Lalu (Last Week) - 50 data
        $this->generateData($faker, Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek(), 50, $apartmentTypes, $pages, $activities);
        
        // 4. Data Hari Ini (Today) - 10 data
        $this->generateData($faker, Carbon::now()->startOfDay(), Carbon::now(), 10, $apartmentTypes, $pages, $activities);
    }

    private function generateData($faker, $startDate, $endDate, $count, $apartmentTypes, $pages, $activities)
    {
        for ($i = 0; $i < $count; $i++) {
            $activityType = $this->getRandomActivity($activities);
            $pagePath = array_rand($pages);
            $pageUrl = 'http://neovala.com' . $pagePath;
            $apartmentType = (strpos($pagePath, 'discover-') !== false) ? strtoupper(str_replace('/discover-', '', $pagePath)) : $faker->randomElement($apartmentTypes);
            
            $metadata = [];
            $targetName = null;

            if ($activityType == 'click_book_now') {
                $targetName = 'BOOK NOW';
                $metadata['apartment_type'] = $apartmentType;
            } elseif ($activityType == 'submit_form') {
                $targetName = 'Form Submission';
                $metadata['form_id'] = $faker->randomElement(['checkinForm', 'contactForm', 'bookingForm']);
                $metadata['apartment_type'] = $apartmentType;
            } elseif ($activityType == 'click_download_promo') {
                $targetName = 'promo_2025.pdf';
                $metadata['file_name'] = 'promo_2025.pdf';
            } elseif ($activityType == 'visit') {
                 if ($apartmentType) $metadata['apartment_type'] = $apartmentType;
            }

            UserActivity::create([
                'session_id' => $faker->uuid,
                'ip_address' => $faker->ipv4,
                'user_agent' => $faker->userAgent,
                'activity_type' => $activityType,
                'page_url' => $pageUrl,
                'page_path' => $pagePath,
                'apartment_type' => $apartmentType,
                'target_name' => $targetName,
                'metadata' => !empty($metadata) ? json_encode($metadata) : null,
                'created_at' => $faker->dateTimeBetween($startDate, $endDate),
                'updated_at' => $faker->dateTimeBetween($startDate, $endDate),
            ]);
        }
    }

    private function getRandomActivity($activities)
    {
        $rand = mt_rand(1, 100);
        $cumulative = 0;
        foreach ($activities as $activity => $percent) {
            $cumulative += $percent;
            if ($rand <= $cumulative) {
                return $activity;
            }
        }
        return 'visit';
    }
}
