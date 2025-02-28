<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrayOfType = [
            'Denied',
            'Pending',
            'Approved',
        ];


        foreach ($arrayOfType as $item) {
            $da = new Status;
            $da->status = $item;
            $da->save();
        }
    }
}
