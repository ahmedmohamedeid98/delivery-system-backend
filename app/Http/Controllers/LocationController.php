<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLocationRequest;
use App\Models\AddedDeliveryLocation;
use App\Models\AddedTargetLocation;
use App\Models\DeliveryLocation;
use App\Models\TargetLocation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    public function getTargetLocations()
    {
        $user_id = Auth::user()->id;
        $locations = AddedTargetLocation::where('user_id', $user_id)->get();
        $locations_count = count($locations);
        $location_details = [];
        for ($i = 0; $i < $locations_count; $i++) {
            array_push($location_details, TargetLocation::find($locations[$i]->target_location_id));
        }
        return $this->success('get target location successfully', $location_details);
    }

    public function getDeliveryLocations()
    {
        $user_id = Auth::user()->id;
        $locations = AddedDeliveryLocation::where('user_id', $user_id)->get();
        $locations_count = count($locations);
        $location_details = [];
        for ($i = 0; $i < $locations_count; $i++) {
            array_push($location_details, DeliveryLocation::find($locations[$i]->delivery_location_id));
        }
        return $this->success('get delivery location successfully', $location_details);
    }

    public function createDeliveryLocation(CreateLocationRequest $request)
    {
        $user_id = Auth::user()->id;
        $location = DeliveryLocation::create($request->all());
        AddedDeliveryLocation::create([
            'user_id' => $user_id,
            'delivery_location_id' => $location->id,
        ]);
        return $this->success('delivery location add successfully!', $location);
    }

    public function createTargetLocation(CreateLocationRequest $request)
    {
        $user_id = Auth::user()->id;
        $location = TargetLocation::create($request->all());
        AddedTargetLocation::create([
            'user_id' => $user_id,
            'target_location_id' => $location->id,
        ]);
        return $this->success('target location add successfully!', $location);
    }
}
