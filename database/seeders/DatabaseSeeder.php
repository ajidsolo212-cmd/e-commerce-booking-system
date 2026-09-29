<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\StudioSession;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Admin Grainhaus',
            'email'    => 'admin@grainhaus.com',
            'phone'    => '0123456789',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
        ]);

        User::create([
            'name'     => 'John Doe',
            'email'    => 'user@grainhaus.com',
            'phone'    => '0112223333',
            'password' => Hash::make('user123'),
            'is_admin' => false,
        ]);

        $sessions = [
            ['title' => 'Portraits on Film', 'description' => 'A timeless 2-hour portrait session shot entirely on 35mm film. Natural light studio. Includes one developed roll and 10 scanned images.', 'duration' => '2 hours', 'price' => 280.00, 'max_slots' => 8],
            ['title' => 'Street & Documentary', 'description' => 'Half-day outdoor session capturing candid moments. Shot on medium format. Includes two rolls and full development.', 'duration' => '4 hours', 'price' => 480.00, 'max_slots' => 5],
            ['title' => 'Darkroom Experience', 'description' => 'Hands-on analog darkroom session. Learn to develop your own film and make silver gelatin prints under professional guidance.', 'duration' => '3 hours', 'price' => 350.00, 'max_slots' => 4],
            ['title' => 'Wedding & Occasions', 'description' => 'Full-day coverage on film for weddings, engagements, or special events. Multiple formats, full development included.', 'duration' => '8 hours', 'price' => 1200.00, 'max_slots' => 2],
        ];

        foreach ($sessions as $s) {
            StudioSession::create($s);
        }

        $products = [
            ['name' => 'Kodak Portra 400 (35mm)', 'description' => 'The gold standard of color negative film. Fine grain, exceptional latitude. 36 exposures.', 'price' => 32.00, 'stock' => 50, 'category' => 'film_roll'],
            ['name' => 'Ilford HP5 Plus 400 (35mm)', 'description' => 'Classic black & white film. Versatile and pushable up to ISO 3200. 36 exposures.', 'price' => 28.00, 'stock' => 40, 'category' => 'film_roll'],
            ['name' => 'Fujifilm Superia X-TRA 400', 'description' => 'Vibrant Japanese color palette. Great for everyday shooting and travel.', 'price' => 22.00, 'stock' => 35, 'category' => 'film_roll'],
            ['name' => 'Cinestill 800T (35mm)', 'description' => 'Cinema film adapted for still photography. Iconic halation effect. Perfect for night shots.', 'price' => 48.00, 'stock' => 20, 'category' => 'film_roll'],
            ['name' => 'Silver Gelatin Print 5x7"', 'description' => 'Darkroom-made silver gelatin prints on fiber-based paper. Each print is unique and handcrafted.', 'price' => 65.00, 'stock' => 100, 'category' => 'print'],
            ['name' => 'Silver Gelatin Print 8x10"', 'description' => 'Large format darkroom print on archival fiber paper. Museum-quality.', 'price' => 120.00, 'stock' => 100, 'category' => 'print'],
            ['name' => 'Film Development (C-41)', 'description' => 'Professional color negative development. Includes scan at 2400dpi. Delivered digitally.', 'price' => 35.00, 'stock' => 999, 'category' => 'accessory'],
            ['name' => 'Film Development (B&W)', 'description' => 'Hand-developed black & white film. Includes contact sheet and high-res scan.', 'price' => 40.00, 'stock' => 999, 'category' => 'accessory'],
            ['name' => 'Leica M6 Film Camera (Rental)', 'description' => 'Rent a legendary Leica M6 rangefinder for your session. 7-day rental period.', 'price' => 180.00, 'stock' => 3, 'category' => 'accessory'],
        ];

        foreach ($products as $p) {
            Product::create($p);
        }
    }
}