<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Prescription Medicines',
                'slug' => 'prescription-medicines',
                'description' => 'Medicines that require a valid prescription from a licensed healthcare provider.',
                'is_active' => true,
            ],
            [
                'name' => 'Over-the-Counter (OTC)',
                'slug' => 'over-the-counter-otc',
                'description' => 'Medicines available without prescription for common ailments.',
                'is_active' => true,
            ],
            [
                'name' => 'Vitamins & Supplements',
                'slug' => 'vitamins-supplements',
                'description' => 'Nutritional supplements, vitamins, and minerals for overall health.',
                'is_active' => true,
            ],
            [
                'name' => 'First Aid & Wound Care',
                'slug' => 'first-aid-wound-care',
                'description' => 'Bandages, antiseptics, and first aid supplies.',
                'is_active' => true,
            ],
            [
                'name' => 'Personal Care',
                'slug' => 'personal-care',
                'description' => 'Hygiene and personal care products including skincare and oral care.',
                'is_active' => true,
            ],
            [
                'name' => 'Baby & Child Care',
                'slug' => 'baby-child-care',
                'description' => 'Products for babies and children including diapers, baby food, and medicines.',
                'is_active' => true,
            ],
            [
                'name' => 'Medical Equipment',
                'slug' => 'medical-equipment',
                'description' => 'Blood pressure monitors, thermometers, and other medical devices.',
                'is_active' => true,
            ],
            [
                'name' => 'Herbal & Natural',
                'slug' => 'herbal-natural',
                'description' => 'Natural and herbal remedies and supplements.',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
