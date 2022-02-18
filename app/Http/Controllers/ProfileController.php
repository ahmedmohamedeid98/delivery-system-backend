<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\UserAddressResource;
use App\Http\Resources\UserResource;
use App\Models\City;
use App\Models\Governorate;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show()
    {
        $id = Auth::user()->id;
        $profile = Profile::find($id);
        $user = User::find($id);
        // $profile = Profile::with('user')->where('user_id', $id)->get()->first();
        // return $profile;
        $data = [];
        if ($profile) {
            $data[] = new ProfileResource($profile);
        } else {
            $data[] = null;
        }
        if ($user) {
            $data[] = new UserResource($user);
        } else {
            $data[] = null;
        }

        return $data;
    }
    public function edit(Request $req)
    {
        $user = User::find(Auth::user()->id);
        $profile = Profile::find(Auth::user()->id);
        if (!$profile) {
            try {
                $profile = Profile::create([
                    'about' => $req->about,
                    'gender' => $req->gender,
                    'country' => $req->country,
                    'state' => $req->state,
                    'city' => $req->city,
                    'phone' => $req->phone,
                ]);
            } catch (Exception $e) {
                return $this->failure([$e->getMessage()]);
            }
            return [new ProfileResource($profile), new UserResource($user)];
        } else {
            try {
                DB::transaction(function () use ($profile, $user, $req) {
                    $profile->gender = $req->gender;
                    $profile->state = $req->state;
                    $profile->city = $req->city;
                    $profile->country = $req->country;
                    $profile->phone = $req->phone;
                    $profile->about = $req->about;
                    $user->name = $req->name;
                    $profile->save();
                    $user->save();
                });
                return [new ProfileResource($profile), new UserResource($user)];
            } catch (Exception $e) {
                return $this->failure([$e->getMessage()]);
            }
        }
    }

    public function showAnotherUser(ProfileRequest $req)
    {
        $user_id = $req->query('id');


        $post = Profile::with('user')->where('user_id', $user_id)->get()->first();
        $user = User::where('id', $user_id)->get()->first();

        return [new ProfileResource($post), new UserResource($user)];
    }

    public function getAddress()
    {
        $user_id = Auth::user()->id;
        try {
            $profile = Profile::find($user_id);
            if (!$profile) {
                return $this->failure(['Please complete your profile address, to enable us to find tasks nearby to your address
                ']);
            }
            return $this->success("get address successfully", new UserAddressResource($profile));
        } catch (Exception $e) {
            return $this->failure([$e->getMessage()]);
        }
    }

    public function updateAddress(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = $request->all();
        $validator = Validator::make($data, [
            "country" => ["required", 'string', Rule::in(['Egypt'])],
            "state" => ['required', 'string', function ($attr, $val, $fail) {
                if (count(Governorate::where('governorate_name_en', 'in', $val)->get()) == 0) {
                    $fail('The ' . $attr . ' is invalid.');
                }
            }],
            "city" => ['required', 'string', function ($attr, $val, $fail) {
                if (count(City::where('city_name_en', 'in', $val)->get()) == 0) {
                    $fail('The ' . $attr . ' is invalid.');
                }
            }],
        ]);

        if ($validator->failed()) {
            return $this->failure($validator->errors()->all());
        }

        // either all success or not commit the change.
        $profile = Profile::find($user_id);
        if (!$profile) {
            return $this->failure(["Please create your profile first."]);
        }
        DB::transaction(function () use ($profile, $data, $user_id) {
            $profile->country = $data['country'];
            $profile->state = $data['state'];
            $profile->city = $data['city'];
            $profile->save();
        });
        return $this->success("update address successfully", new UserAddressResource($profile));
    }
}
