<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\products>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomChoice = rand(1, 20); // Adjust the range for product possibilities

        $iphoneSuffixes = [" - ", " Pro - ", " Pro Max - ", " Plus - ", " Max - "];
        $samsungSuffixes = [" - ", "+ 5G - ", " Ultra 5G - ", " 5G - ", " FE - "];
        $xiaomiSuffixes = [" - ", "T Pro - ", " Pro - ", " T - "];
        $oppoSuffixes = [" 5G - ", " Pro 5G - ", " Pro - "];
        $pixelSuffixes = [" Pro - ", " Pro XL - ", " - "];
        $macSuffixes = [" Air M1 - ", " Air M2 - ", " Air M3 - ", " M3 - ", " M2 - ", " M1 - ", " Pro M3 - ", " Pro M2 - ", " Pro M1 - "];
        $lenovoSuffixes = [" Thinkpad X1 - ", " LOQ 15 - ", " Yoga Pro 7 - ", " Yoga Slim 7 - ", " Legion Slim 5 - ", " Thinkpad T14 - ", " Legion 7 - ", " Ideapad Pro - ", " Yoga 7 2in1 - "];
        $hpSuffixes = [" Spectre x360 - ", " Envy x360 - ", " Victus Gaming 7 - ", " Pavilion Plus - ",];
        $ipadSuffixes = [" Pro M4 13-inch  - ", " Pro M4 11-inch - ", " Air M4 11-inch - ", " Air M4 13-inch - "];
        $galaxytabSuffixes = [" Ultra - ", " + Wi-Fi - ", " - ", " Wi-Fi - ", " FE+ - "];
        $huaweiSuffixes = [" Pro - ", " Pro WiFi - ", " Air - ", " Papermatte - ",];
        $psSuffixes = [" Slim Edition [Disc Edition]", " Slim Edition [Digital Edition]",];

        $productName = match($randomChoice) {
            1 => "Apple iPhone " . rand(12, 15) . $iphoneSuffixes[array_rand($iphoneSuffixes)] . fake()->colorName(), 
            2 => "Samsung Galaxy S" . rand(20, 24) . $samsungSuffixes[array_rand($samsungSuffixes)] . fake()->colorName(),
            3 => "Xiaomi " . rand(12, 14) . $xiaomiSuffixes[array_rand($xiaomiSuffixes)] . fake()->colorName(),
            4 => "Oppo Reno" . rand(10, 12) . $oppoSuffixes[array_rand($oppoSuffixes)] . fake()->colorName(),
            5 => "Google Pixel " . rand(7, 9) . $pixelSuffixes[array_rand($pixelSuffixes)] . fake()->colorName(),
            6 => "Apple MacBook" . $macSuffixes[array_rand($macSuffixes)] . fake()->colorName(),
            7 => "Asus ROG Zephyrus G" . rand(13, 16) . " - " . fake()->colorName(),
            8 => "Lenovo" . $lenovoSuffixes[array_rand($lenovoSuffixes)] . fake()->colorName(), 
            9 => "Microsoft Surface Pro " . rand(9, 11) . " - " . fake()->colorName(), 
            10 => "HP" . $hpSuffixes[array_rand($hpSuffixes)] . fake()->colorName(),
            11 => "Apple Watch SE"  . rand(1, 3) . " - " . fake()->colorName(),
            12 => "Samsung Galaxy Watch " . rand(5, 7) . " - " . fake()->colorName(),
            13 => "Samsung Galaxy Fit " . rand(1, 3) . " - " . fake()->colorName(),
            14 => "Apple Watch Series "  . rand(7, 10) . " - " . fake()->colorName(),
            15 => "Apple Watch Ultra "  . rand(1, 2) . " - " . fake()->colorName(),
            16 => "Apple Ipad" . $ipadSuffixes[array_rand($ipadSuffixes)] . fake()->colorName(),
            17 => "Samsung Galaxy Tab S" . rand(8, 10) . $galaxytabSuffixes[array_rand($galaxytabSuffixes)] . fake()->colorName(),
            18 => "Huawei Matepad" . $huaweiSuffixes[array_rand($huaweiSuffixes)] . fake()->colorName(),
            19 => "PlayStation®5" . $psSuffixes[array_rand($psSuffixes)],
            20 => "Microsoft Xbox Series X"
        };

        $productCategory = match ($randomChoice) {
            1, 2, 3, 4, 5 => 1, // handphone
            6, 7, 8, 9, 10 => 2, // laptop
            11, 12, 13, 14, 15 => 3, // smartwatch
            16, 17, 18 => 4, // tablet
            19, 20 => 5 // console
        };
        
        $priceCategory = match ($randomChoice) {
            1, 2, 5 => round(rand(10000000, 23000000), 1000),
            3, 4 => round(rand(7500000, 12000000), 1000),
            6, 7, 8, 9, 10 => round(rand(10000000, 30000000), 1000),
            11 => round(rand(2500000, 4500000), 1000),
            12 => round(rand(3000000, 5000000), 1000),
            13 => round(rand(750000, 1000000), 1000),
            14 => round(rand(5000000, 7500000), 1000),
            15 => round(rand(12000000, 15000000), 1000),
            16 => round(rand(14500000, 46000000), 1000),
            17 => round(rand(10000000, 20000000), 1000),
            18 => round(rand(6000000, 15500000), 1000),
            19 => round(rand(8000000, 10000000), 1000),
            20 => round(rand(5500000, 7500000), 1000)
        };

        $storageSuffixes = [" 128GB of SSD Storage,", " 256GB of SSD Storage,", " 512GB of SSD Storage,", " 1TB of SSD Storage,", " 64GB of SSD Storage,"];
        $ramSuffixes = [" 4GB of RAM,", " 6GB of RAM,", " 8GB of RAM,", " 12GB of RAM,", " 16GB of RAM,"];
        $battSuffixes = [" Up To 6 Hours of battery life,", " Up To 8 Hours of battery life,", " Up To 12 Hours of battery life,", " Up To 24 Hours of battery life,",];
        $description = $productName . " with features of " . $storageSuffixes[array_rand($storageSuffixes)] . $ramSuffixes[array_rand($ramSuffixes)] . $battSuffixes[array_rand($battSuffixes)] . " and many more features!";
        
        $imagePath = match ($randomChoice) {
            1, 2, 3, 4 ,5 ,6 ,7 , 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, => "storage/dummy_{$productCategory}.png",
            19 => "storage/dummy_{$productCategory}_1.png",
            20 => "storage/dummy_{$productCategory}_2.png",
        }; 

        return [
            'name'=> $productName,
            'slug' => Str::limit(Str::slug($productName), 25, '') . "-" . uniqid(),
            'description' => $description,
            'price' => $priceCategory,
            'image_path' => $imagePath,
            'star_rating' => fake()->randomFloat(2, 0, 5),
            'count_rating' => fake()->numberBetween(0, 150000),
            'user_id' => User::factory(),
            'category_id' => $productCategory,
        ];
    }
}
