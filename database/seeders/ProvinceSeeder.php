<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'province_code' => 1,
                'nepali_name' => 'कोशि प्रदेश',
                'english_name' => 'Koshi Province',
            ],
            [
                'province_code' => 2,
                'nepali_name' => 'मधेश प्रदेश',
                'english_name' => 'Madhesh',
            ],
            [
                'province_code' => 3,
                'nepali_name' => 'बााग्मती प्रदेश',
                'english_name' => 'Bagmati',
            ],
            [
                'province_code' => 4,
                'nepali_name' => 'गण्डकी प्रदेश',
                'english_name' => 'Gandaki',
            ],
            [
                'province_code' => 5,
                'nepali_name' => 'लुम्बिनि प्रदेश',
                'english_name' => 'Lumbini',
            ],
            [
                'province_code' => 6,
                'nepali_name' => 'कर्णाली प्रदेश',
                'english_name' => 'Karnali',
            ],
            [
                'province_code' => 7,
                'nepali_name' => 'सुदुरपश्चिम प्रदेश',
                'english_name' => 'Sudurpaschim',
            ]
        ];
        DB::table('provinces')->insert($rows);
    }
}
