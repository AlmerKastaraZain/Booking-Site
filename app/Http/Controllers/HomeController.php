<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController
{
    function home() {
        $newest = Rental::query()->with('PropertyTypeId')->orderBy('created_at')->take(20)->get('*');
        $random = Rental::query()->orderBy(DB::raw('RAND()'))->take(20)->get('*');
        $countries = Rental::query()->orderBy('country')->take(20)->get('country');

        return view('home', compact('newest', 'random', 'countries'));
    }
}
