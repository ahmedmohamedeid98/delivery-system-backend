<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\Request;

class StaticDataController extends Controller
{
    public function getGovernorate()
    {
        return Governorate::with('cities')->get();
    }
}
