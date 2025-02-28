<?php

namespace Database\Seeders;

use App\Models\RentalFacilitiesFeature;
use App\Models\RoomFacilitiesFeature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentalFacilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrayOfType = [
            'Kitchen',
            'Air conditioning',
            'Private pool',
            'Balcony',
            'Washing machine',
            'View',
            'Bathtub',
            'Hottub',
            'Heating',
            'Refrigerator',
            'TV',
            'Shower',
            'Toilet paper',
            'Hair dryer',
            'Coffee Maker',
            'Toaster',
            'Sofa',
            'Toilet',
        ];


        foreach ($arrayOfType as $item) {
            $da = new RoomFacilitiesFeature;
            $da->rental_facility = $item;
            $da->save();
        }
    }
}
