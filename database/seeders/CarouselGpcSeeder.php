<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Carousel;

class CarouselGpcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if GPC carousel already exists
        $existingGpc = Carousel::where('section', 'GPC')->first();
        
        if (!$existingGpc) {
            Carousel::create([
                'section' => 'GPC',
                'image1' => 'carousel_images/GPC/slide_1.jpg',
                'image2' => 'carousel_images/GPC/slide_2.png',
                'image3' => 'carousel_images/GPC/slide_3.jpg',
                'image4' => 'carousel_images/GPC/slide_4.png',
            ]);
            
            $this->command->info('GPC carousel data created successfully!');
        } else {
            $this->command->info('GPC carousel data already exists.');
        }
    }
}