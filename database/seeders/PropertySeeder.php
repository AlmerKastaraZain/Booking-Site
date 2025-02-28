<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Scalar\MagicConst\Property;

class PropertySeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrayOfPropertyType = [
            'Apartments',
            'Hotels',
            'Guesthouses',
            'Hostels',
            'Homestays',
            'Capsule Hotels',
            'Motels',
            'Vacation Homes',
            'Bed and Breakfasts',
            'Villas',
            'Resorts',
            'Luxurty Tents',
        ];


        foreach ($arrayOfPropertyType as $item) {
            $da = new PropertyType;
            $da->type = $item;
            $da->save();
        }
    }
}
