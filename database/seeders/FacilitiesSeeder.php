<?php

namespace Database\Seeders;

use App\Models\FacilitiesFeature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrayOfPropertyType = [
            'Free parking',
            'Restaurant',
            'Pet friendly',
            '24-hour front desk',
            'Fitness center',
            'Non-smoking rooms',
            'Airport shuttle',
            'Family rooms',
            'Spa',
            'Electric vehicle charging station',
            'Wheelchair accessible',
            'Swimming pool',
        ];


        foreach ($arrayOfPropertyType as $item) {
            $da = new FacilitiesFeature;
            $da->facility = $item;
            $da->save();
        }
    }
}
