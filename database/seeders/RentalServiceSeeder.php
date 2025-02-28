<?php

namespace Database\Seeders;

use App\Models\RentalServicesFeature;
use App\Models\RoomServicesFeature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentalServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrayOfType = [
            'Wifi',
            'Breakfast',
            'Room service',
        ];


        foreach ($arrayOfType as $item) {
            $da = new RoomServicesFeature;
            $da->rental_service = $item;
            $da->save();
        }
    }
}
